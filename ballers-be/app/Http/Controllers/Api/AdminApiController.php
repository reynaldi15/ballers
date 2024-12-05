<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminApiController extends Controller
{
    public function adminDashboard()
    {
        $user = User::all();
        return response()->json([
            'success' => true,
            'message' => "Get All User Data with API Resource successfully",
            'data'    => UserResource::collection($user),
        ], 200);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role_id'      => 'required',
            'name'      => 'required',
            'address'      => 'required',
            'phoneNumber'      => 'required|numeric',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|min:5|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create([
            'role_id'      => $request->role_id,
            'name'      => $request->name,
            'address'      => $request->address,
            'phoneNumber'      => $request->phoneNumber,
            'email'     => $request->email,
            'password'  => bcrypt($request->password)
        ]);

        if ($user) {
            return response()->json([
                'success' => true,
                'user'    => $user,
            ], 201);
        }

        return response()->json([
            'success' => false,
        ], 409);
    }

    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email'     => 'required|email',
                'password'  => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validator->errors()
                ], 401);
            }

            if (!Auth::attempt($request->only(['email', 'password']))) {
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our data',
                ], 401);
            }

            $user = User::where('email', $request->email)->first();
            if ($user) {
                return response()->json([
                    'success' => true,
                    'data'    => $user,
                    'token' => $user->createToken('API TOKEN')->plainTextToken
                ], 201);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function profile()
    {
        return response()->json([
            'success' => true,
            'message' => "Get profile data with API Resource successfully",
            'data'    => new UserResource(auth()->user()),
        ], 200);
    }

    public function detailUser($id)
    {
        $userDetail = User::with('role')->find($id);
        return new UserResource($userDetail);
    }

    public function updateUser(Request $request, $id)
    {
        // Validasi request hanya untuk field yang ada
    $validator = Validator::make($request->all(), [
        'role_id'     => 'sometimes|required',
        'name'        => 'sometimes|required',
        'address'     => 'sometimes|required',
        'phoneNumber' => 'sometimes|required',
        'email'       => 'sometimes|required|email',
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    // Cari user berdasarkan id
    $updateUser = User::find($id);

    if (!$updateUser) {
        return response()->json(['message' => 'User not found'], 404);
    }

    // Ambil semua input yang valid dari request
    $dataToUpdate = $request->only([
        'role_id',
        'name',
        'address',
        'phoneNumber',
        'email',
    ]);

    // Encrypt password jika ada dalam request
    if (array_key_exists('password', $dataToUpdate)) {
        $dataToUpdate['password'] = bcrypt($dataToUpdate['password']);
    }

    // Lakukan update
    $updateUser->update($dataToUpdate);

    return response()->json([
        'success' => true,
        'message' => "User updated successfully",
        'data'    => new UserResource($updateUser),
    ], 200);
    }

    public function deleteUser($id)
    {
        $deleteUser = User::find($id);

        $deleteUser->delete();

        return response()->json([
            'success' => true,
            'message' => "User deleted successfully",
            'data'    => new UserResource($deleteUser),
        ], 200);
    }
}
