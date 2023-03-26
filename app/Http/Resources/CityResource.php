<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'country' => CityResource::make($this->whenLoaded('country')),
            'areas' => CityResource::collection($this->whenLoaded('areas')),
            'created_at' => $this->created_at->format('y-m-d'),

        ];
    }
}
