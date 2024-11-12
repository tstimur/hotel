<?php

namespace App\Http\Resources\V1;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Route;

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
            'created' => $this->when(Route::currentRouteName() == 'guests.show', Carbon::parse($this->created_at)->format('Y-m-d H:i:s')),
            'updated' => $this->when(Route::currentRouteName() == 'guests.show',Carbon::parse($this->updated_at)->format('Y-m-d H:i:s')),
        ];
    }
}
