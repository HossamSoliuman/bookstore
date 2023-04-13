<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
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
            'title' => $this->title,
            'price' => $this->price,
            'details' => $this->details,
            'publisher' => $this->publisher,
            'description' => $this->description,
            'created_at' => Carbon::parse($this->created_at)->format('Y m d H:m A'),
            'reviews' => ReviewResource::collection($this->reviews),
        ];
    }
}
