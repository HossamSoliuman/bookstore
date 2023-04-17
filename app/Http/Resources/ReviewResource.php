<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class ReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'review' => $this->review,
            'stars' => $this->number_of_stars,
            'user' => UserResource::make($this->user),
            'created_at' => Carbon::parse($this->created_at)->format('y m d h:m A'),
            'last_update' => Carbon::parse($this->updated_at)->format('y m d h:m A'),
        ];
    }
}
