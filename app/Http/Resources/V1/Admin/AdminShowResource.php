<?php

namespace App\Http\Resources\V1\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminShowResource extends JsonResource
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
            'id' => $this->resource->uuid,
            'email' => $this->resource->email,
            'mobile' => $this->resource->mobile,
            'firstname' => $this->resource->firstname,
            'lastname' => $this->resource->lastname,
            'created_at' => $this->resource->created_at->timestamp,
            'updated_at' => $this->resource->updated_at->timestamp,
        ];
    }
}
