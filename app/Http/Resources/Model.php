<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Model extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'make_id'=>$this->make_id,
            'make'=>$this->make,
            'vehicles'=>$this->vehicles
        ];
    }
}
