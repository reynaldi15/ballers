<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BasketballFieldResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'id' => $this->id,
            'user_id' => $this->user_id,
            'title' => $this->title,
            'image' => env('APP_URL', 'localhost:8000') . $this->image,
            'price' => $this->price,
            'address' => $this->address,
            'desc' => $this->desc,
            'date' => $this->date,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'request_field' => new RequestFieldResource($this->whenLoaded('requestField')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
