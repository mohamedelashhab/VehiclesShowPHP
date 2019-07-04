<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = ['name','model_id']; 

    public function model(){
        return $this->belongsTo('App\Model');
    }

    public function features(){
        return $this->belongsToMany('App\Feature');
    }
}
