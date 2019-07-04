<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicalFeature extends Model
{
    protected $table = 'feature_vehicle';
    protected $fillable = ['vehicle_id', 'feature_id'];

    
}
