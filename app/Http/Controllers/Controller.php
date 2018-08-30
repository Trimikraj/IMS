<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function updateStatus(Request $request,$class){
        $success=false;
        if($request->has('id')){
            $object=$class::find($request->input('id'));
            if(!is_null($object)){
                $object->status=(!$object->status);
                $object->save();
                $success=true;
            }
        }
        return [
            'success'=>$success
        ];
    }

    public function restore(Request $request,$class){
        $success=false;
        if($request->has('id')){
            $object=$class::find($request->input('id'));
            if(!is_null($object)){
                $object->delete_flag=(!$object->delete_flag);
                $object->save();
                $success=true;
            }
        }
        return [
            'success'=>$success
        ];
    }
}
