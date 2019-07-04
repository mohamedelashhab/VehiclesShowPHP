<?php

namespace App;

use Illuminate\Database\Eloquent\Model as _Model;

class Model extends _Model
{
    protected $fillable = [
        'name',
        'make_id'
    ];
    
    public function make()
    {
        return $this->belongsTo('App\Make');
    }

    public function vehicles(){
        return $this->hasMany('App\Vehicle');
    }

}
