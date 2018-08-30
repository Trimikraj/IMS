<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemPhoto extends Model
{
    protected $table='item_photos';
    public function item(){
        return $this->belongsTo('App\Item','item_id');
    }
}
