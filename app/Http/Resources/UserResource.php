<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $auth_id = Auth::guard('sanctum')->user()->id;
        $has_permissions = $this->id == $auth_id ? 1 : 0;

        return [
            'name' => $this->name,
            'email' => $this->email,
            'has_permissions' => $has_permissions,
        ];
    }
}
