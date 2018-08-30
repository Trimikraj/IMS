<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Staff extends Model
{
    protected $table='staffs';

    public function addToStore($staffId,$storeId){
        return DB::table('store_staffs')->insert([
            'store_id'=>$storeId,
            'staff_id'=>$staffId
        ]);
    }
}
