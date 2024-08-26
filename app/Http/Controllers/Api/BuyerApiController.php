<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Community;
use App\Models\Payment;
use App\Models\RequestHistory;
use App\Http\Resources\CommunityResource;
use App\Http\Resources\PaymentResource;
use App\Http\Resources\BasketballFieldResource;
use App\Http\Resources\RequestHistoryResource;
use App\Models\BasketballField;
use App\Models\RequestField;
use Illuminate\Support\Facades\Auth;

class BuyerApiController extends Controller
{
    public function buyerDashboard()
    {
        $basketBallField = new BasketballField();
        // $basketBallField = $basketBallField->where('user_id', auth()->user()->id);

        if (request()->query('search')) {
            $search = request()->query('search');
            $basketBallField = $basketBallField->where('title', 'like', "%$search%");
        }

        $basketBallField = $basketBallField->paginate(request()->query('size'));
        return BasketballFieldResource::collection($basketBallField);
    }

    public function BasketballFieldDetail($id)
    {
        $basketBallFieldDetail = BasketballField::findOrFail($id);
        return response()->json([
            'success' => true,
            'message' => "Get Basketball Field Data with API Resource successfully",
            'data'    => new BasketballFieldResource($basketBallFieldDetail),
        ], 200);
    }

    public function communityPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'image'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'address' => 'required',
            'desc' => 'required|max:255',
            'phone' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $image = $request->file('image');
        $image->storeAs('', $image->hashName());

        $community = Community::create([
            ...$request->except('image'),
            'image' => "/images/{$image->hashName()}",
            'user_id' => Auth::user()->id
        ]);

        return new CommunityResource($community);
    }
    public function community()
    {
        $communities = Community::paginate(request()->size);
        return CommunityResource::collection($communities);
    }

    public function BasketballFieldPayment($id)
    {
        $basketballField = BasketballField::findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => 'Basketball Field Payment Details',
            'data' => [
                'basketball_field' => $basketballField,
                'payment_form' => [
                    'image' => '',
                ]
            ]
        ], 200);
    }

    public function BasketballFieldPaymentPost(Request $request)
    {
        $request->validate([
            'basketball_field_id' => 'required',
            'date' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = $request->file('image');
        $image->storeAs('', $image->hashName());

        $payment = Payment::create([
            'basketball_field_id' => $request->basketball_field_id,
            'image' => "/images/{$image->hashName()}",
        ]);

        RequestHistory::create([
            'user_id' => auth()->user()->id,
            'payment_id' => $payment->id,
        ]);

        RequestField::create([
            'user_id' => auth()->user()->id,
            'date' => $request->date,
            'basketball_field_id' => $request->basketball_field_id,
        ]);

        return new PaymentResource($payment);
    }

    public function orderHistory()
    {
        $historyOrder = RequestHistory::where('user_id', auth()->user()->id)->with('payment.venue')->get();
        return RequestHistoryResource::collection($historyOrder);
    }

    public function sellerOrderHistory()
    {
        $historyOrder = RequestHistory::with(
            [
                'payment' => [
                    'venue' => fn ($q) => $q->where('user_id', 3)
                ],
            ])
            ->get();
        return RequestHistoryResource::collection($historyOrder);
    }

    public function orderHistoryDetail($id)
    {
        $historyOrderDetail = RequestHistory::with('payment.venue.requestField')->find($id);
        return new RequestHistoryResource($historyOrderDetail);
    }
}
