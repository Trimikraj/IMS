<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table="mst_units";

    public function items(){
    	return $this->hasMany('App\Item');
    }
}
