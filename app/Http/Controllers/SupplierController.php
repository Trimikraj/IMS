<?php

namespace App\Http\Controllers;

use App\Supplier;
use App\Http\Requests\SupplierFormRequest;
use Illuminate\Http\Request;

class SupplierController extends AuthController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $suppliers=null;
        if($request->has('q')){
            $param='%'.$request->input('q').'%';
            $suppliers=Supplier::where('name','like',$param)
                ->orWhere('email','like',$param)
                ->orWhere('contact_no','like',$param)->get();
        }else{
            $suppliers=Supplier::all();
        }
        
        return view('supplier.index',[
            'page_title'=>'Suppliers',
            'suppliers'=>$suppliers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('supplier.create',[
            'page_title'=>'Add Supplier'
        ]);
    }

    /**
     * Supplier a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SupplierFormRequest $request)
    {
        $logo='na.jpg';
        if($request->hasFile('logo')){
            $logo=$request->file('logo')->store('public/suppliers');
        }
        $supplier=new Supplier();
        $supplier->name=$request->input('name');
        $supplier->email=$request->input('email');
        $supplier->contact_no=$request->input('contact_no');
        $supplier->address=$request->input('address');
        $supplier->logo=$logo;
        $supplier->status=$request->has('status');
        $supplier->save();
        return redirect('/suppliers');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('supplier.edit',[
            'page_title'=>'Edit Supplier',
            'supplier'=>Supplier::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        
        if($request->hasFile('logo')){
            $supplier->logo=$request->file('logo')->supplier('public/suppliers');
        }
        
        $supplier->name=$request->input('name');
        $supplier->email=$request->input('email');
        $supplier->contact_no=$request->input('contact_no');
        $supplier->address=$request->input('address');
        $supplier->status=$request->has('status');
        $supplier->save();
        return redirect('/suppliers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete_flag=1;
        $supplier->save();
        return redirect('/suppliers');
    }

    public function changeStatus(Request $request){
        return $this->updateStatus($request,Supplier::class);
    }
}
