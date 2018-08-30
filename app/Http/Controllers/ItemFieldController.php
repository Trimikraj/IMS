<?php

namespace App\Http\Controllers;

use App\ItemField;
use App\Http\Requests\ItemFieldFormRequest;
use Illuminate\Http\Request;

class ItemFieldController extends AuthController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $fields=null;
        if($request->has('q')){
            $param='%'.$request->input('q').'%';
            $fields=ItemField::where('field_name','like',$param)
                ->get();
        }else{
            $fields=ItemField::all();
        }
        
        return view('itemfield.index',[
            'page_title'=>'ItemFields',
            'fields'=>$fields
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('itemfield.create',[
            'page_title'=>'Add ItemField'
        ]);
    }

    /**
     * ItemField a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemFieldFormRequest $request)
    {
        
        $field=new ItemField();
        $field->field_name=$request->input('field_name');
        $field->save();
        return redirect('/items/fields');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ItemField  $field
     * @return \Illuminate\Http\Response
     */
    public function show(ItemField $field)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ItemField  $field
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('itemfield.edit',[
            'page_title'=>'Edit ItemField',
            'field'=>ItemField::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ItemField  $field
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItemField $field)
    {
        
        $field->field_name=$request->input('field_name');
        $field->save();
        return redirect('/items/fields');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ItemField  $field
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemField $field)
    {
        $field->delete_flag=1;
        $field->save();
        return redirect('/items/fields');
    }

    public function changeStatus(Request $request){
        return $this->updateStatus($request,ItemField::class);
    }
}
