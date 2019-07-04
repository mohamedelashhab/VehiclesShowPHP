<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Model as ModelResource;
use App\Http\Resources\Model as FeatureResource;

class Vehicle extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return ['id'=>$this->id,
        'name'=>$this->name,
        'model_id'=>$this->model_id,
        'model'=> new ModelResource($this->model),
        'features' =>$this->features
    ];
    }
}
