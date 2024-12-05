<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'id' => $this->when(isset($this->id), $this->id),
            'user_id' => $this->user_id,
            'role_id' => $this->role_id,
            'name' => $this->name,
        ];
    }
}
