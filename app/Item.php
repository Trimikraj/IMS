<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Item extends Model
{
    public function unit(){
   	  return $this->belongsTo('App\Unit','unit_id');
   }

    public function brand(){
   		return $this->belongsTo('App\Brand','brand_id');
   }

    public function photos(){
        return $this->hasMany('App\ItemPhoto');
    }

   	public function addToPhotos($itemId,$itemPhoto){
        return DB::table('item_photos')->insertGetId([
            'item_id'=>$itemId,
            'photo'=>$itemPhoto
        ]);
    }

    // public function imagePhoto($itemId){
    //   return DB::table('item_photos')
    //   ->where('item_id', '=', $itemId);
    // }

   	// public function editToPhotos($itemId,$itemPhoto){
    //     return DB::table('item_photos')
    //     ->where('item_id', '=', $itemId)
    //     ->update([
    //         'photo'=>$itemPhoto
    //     ]);
    // }
}
