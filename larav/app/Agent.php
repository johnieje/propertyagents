<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    public function users(){
    	return $this->hasMany('App\User');
    }
}
