<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'role' => new RoleResource($this->whenLoaded('role')),
            'name' => $this->name,
            'address' => $this->address,
            'phone' => $this->phoneNumber,
            // 'opsional' => [
            //     'introduction' => $this->perkenalan(),
            //     'contact_card' => $this->contactCard(),
            // ],
            'email' => $this->email,
        ];
    }

    // public function perkenalan()
    // {
    //     $name = $this->name;
    //     $address = $this->address;
    //     $phoneNumber = $this->phoneNumber;
    //     $email = $this->email;
    //     return "Halo, nama saya $name. Saya tinggal di $address, untuk mengontak saya, silahkan kontak melalui nomor handphone saya yaitu $phoneNumber, atau bisa via email yaitu $email";
    // }

    // public function contactCard()
    // {
    //     $address = $this->address;
    //     $phoneNumber = $this->phoneNumber;
    //     return "$address-$phoneNumber";
    // }
}
