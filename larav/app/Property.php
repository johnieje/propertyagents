<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    public function agent(){
    	return $this->belongsTo('App\Agent');
    }
}
