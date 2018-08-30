<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public function items(){
    	return $this->hasMany('App\Item');
    }

    public function countItems(){
    	return $this->hasMany('App\Item')->count();	
    }
}
