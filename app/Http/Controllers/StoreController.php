<?php

namespace App\Http\Controllers;

use App\Store;
use App\Http\Requests\StoreFormRequest;
use Illuminate\Http\Request;

class StoreController extends AuthController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $stores=null;
        if($request->has('q')){
            $param='%'.$request->input('q').'%';
            $stores=Store::where('name','like',$param)
                ->orWhere('email','like',$param)
                ->orWhere('contact_no','like',$param)->get();
        }else{
            $stores=Store::all();
        }
        
        return view('store.index',[
            'page_title'=>'Stores',
            'stores'=>$stores
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('store.create',[
            'page_title'=>'Add Store'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFormRequest $request)
    {
        
        $store=new Store();
        $store->name=$request->input('name');
        $store->email=$request->input('email');
        $store->contact_no=$request->input('contact_no');
        $store->address=$request->input('address');
       
        $store->status=$request->has('status');
        $store->save();
        return redirect('/stores');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('store.edit',[
            'page_title'=>'Edit Store',
            'store'=>Store::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Store $store)
    {
        
        if($request->hasFile('logo')){
            $store->logo=$request->file('logo')->store('public/stores');
        }
        
        $store->name=$request->input('name');
        $store->code=$request->input('name');
        $store->parent_id=0;
        $store->status=$request->has('status');
        $store->save();
        return redirect('/stores');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        $store->delete_flag=1;
        $store->save();
        return redirect('/stores');
    }

    public function changeStatus(Request $request){
        return $this->updateStatus($request,Store::class);
    }
}
