<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\RequestHistoryResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    // public function __construct($resource, $historyOrder = null)
    // {
    //     parent::__construct($resource);
    //     $this->historyOrder = $historyOrder;
    // }

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'basketball_field_id' => $this->basketball_field_id,
            'image' => env('APP_URL', 'localhost:8000') . $this->image,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'history_order' => new RequestHistoryResource($this->whenLoaded('historyOrder')),
            'venue' => new BasketballFieldResource($this->whenLoaded('venue')),
        ];
    }
}
