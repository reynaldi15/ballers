<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthApiController extends Controller
{
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

            $user = User::where('email', $request->email)->with('role')->first();
            if ($user) {
                return response()->json([
                    'success' => true,
                    'data'    => new UserResource($user),
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
        return new UserResource(auth()->user());
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'success' => true,
            'message' => "User logged out",
            'data'    => [],
        ], 200);
    }
}
