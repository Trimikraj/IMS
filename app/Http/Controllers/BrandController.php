<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Http\Requests\BrandFormRequest;
use Illuminate\Http\Request;

class BrandController extends AuthController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $brands=null;
        if($request->has('q')){
            $param='%'.$request->input('q').'%';
            $brands=Brand::where('name','like',$param)
                ->orWhere('code','like',$param)->get();
        }else{
            $brands=Brand::all();
        }
        
        return view('brand.index',[
            'page_title'=>'Brands',
            'brands'=>$brands
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('brand.create',[
            'page_title'=>'Add Brand'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandFormRequest $request)
    {
        $logo='na.jpg';
        if($request->hasFile('logo')){
            $logo=$request->file('logo')->store('public/brands');
        }
        $brand=new Brand();
        $brand->name=$request->input('name');
        $brand->code=$request->input('code');
        $brand->logo=$logo;
        $brand->status=$request->has('status');
        $brand->save();
        return redirect('/brands');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('brand.edit',[
            'page_title'=>'Edit Brand',
            'brand'=>Brand::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        
        if($request->hasFile('logo')){
            $brand->logo=$request->file('logo')->store('public/brands');
        }
        
        $brand->name=$request->input('name');
        $brand->code=$request->input('code');
        $brand->status=$request->has('status');
        $brand->save();
        return redirect('/brands');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $brand->delete_flag=1;
        $brand->save();
        return redirect('/brands');
    }

    public function changeStatus(Request $request){
        return $this->updateStatus($request,Brand::class);
    }
}
