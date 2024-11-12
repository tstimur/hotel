<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GuestResource extends JsonResource
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
            'name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone' => $this->phone_number,
            'email' => $this->email,
            'country' => $this->country,
            'created' => $this->created_at,
            'updated' => $this->updated_at
        ];
    }
}
