<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateBasketballField;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\BasketballField;
use App\Http\Resources\BasketballFieldResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SellerApiController extends Controller
{
    public function sellerDashboard()
    {
        $basketBallFieldList = BasketballField::where('user_id', Auth::user()->id)->get();
        return BasketballFieldResource::collection($basketBallFieldList);
    }

    public function BasketballFieldPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'   => 'required',
            'image'   => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price'   => 'required',
            'address' => 'required',
            'desc'    => 'required',
            'date'    => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $image = $request->file('image');
        $image->storeAs('', $image->hashName());

        $basketBallField = BasketballField::create([
            'user_id'  =>  auth()->user()->id,
            'title'    => $request->title,
            'image'    => "/images/{$image->hashName()}",
            'price'    => $request->price,
            'address'  => $request->address,
            'desc'     => $request->desc,
            'date'     => $request->date,
            'start_time'     => $request->start_time,
            'end_time'     => $request->end_time,
        ]);

        return new BasketballFieldResource($basketBallField);
    }
    public function basketballFieldEdit($id)
    {
        $basketballDetail = BasketballField::find($id);
        return response()->json([
            'success' => true,
            'message' => "Get edit venue with API Resource successfully",
            'data'    => new BasketballFieldResource($basketballDetail),
        ], 200);
    }

    public function basketballFieldUpdate(UpdateBasketballField $request, $id)
    {
        $basketballField = BasketballField::find($id);

        if ($request->hasFile('image')) {
            if ($basketballField->image) {
                Storage::delete(str_replace('/images/', '', $basketballField->image));
            }
            $image = $request->file('image');
            $image->storeAs('', $image->hashName());
            $basketballField->image = "/images/{$image->hashName()}";
        }

        BasketballField::find($id)->update([
            'title' => $request->title,
            'price' => $request->price,
            'desc' => $request->desc,
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'address' => $request->address,
        ]);

        return BasketballField::find($id);
        return new BasketballFieldResource($basketballField->refresh());
    }

    public function deleteBasketballField($id)
    {
        $deleteBasketballField = BasketballField::find($id);

        $deleteBasketballField->delete();

        return response()->json([
            'success' => true,
            'message' => "Venue deleted successfully",
            'data'    => new BasketballFieldResource($deleteBasketballField),
        ], 200);
    }
}
