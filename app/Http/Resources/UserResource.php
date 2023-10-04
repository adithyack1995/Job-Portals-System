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
            'firstname' => $this->name,
            'lastname' => $this->last_name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'city' => $this->city ,
            'zipcode' => $this->zipcode,
            'token' =>($request->route()->getName() === 'user.login' || $request->route()->getName() === 'admin.login') ? $this->token : null,
            'user_file' => new UserFileResource($this->whenLoaded('userFile'))
            ];
    }
}
