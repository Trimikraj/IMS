<?php

namespace App\Http\Controllers\Master;

use App\Size;

use App\Http\Requests\SizeFormRequest;
use Illuminate\Http\Request;

class SizeController extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sizes=null;
        if($request->has('q')){
            $param='%'.$request->input('q').'%';
            $sizes=Size::where('name','like',$param)
                ->orWhere('code','like',$param)
                ->orWhere('status','like',$param)->get();
        }else{
            $sizes=Size::all();
        }
        
        return view('size.index',[
            'page_title'=>'Size',
            'sizes'=>$sizes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('size.create',[
            'page_title'=>'Add Size'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SizeFormRequest $request)
    {
        $size=new Size();
        $size->name=$request->input('name');
        $size->code=$request->input('code');
        $size->status=$request->has('status');
        $size->save();
        return redirect('/sizes');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function show(Size $size)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('size.edit',[
            'page_title'=>'Edit Size',
             'size'=>Size::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function update(SizeFormRequest $request, Size $size)
    {
        $size->name=$request->input('name');
        $size->code=$request->input('code');
        $size->status=$request->has('status');
        $size->save();
        return redirect('/sizes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function destroy(Size $size)
    {
        $size->delete_flag=1;
        $size->save();
        return redirect('/sizes');
    }

    /**
     * 
     */
    public function changeStatus(Request $request){
        return $this->updateStatus($request,Size::class);
    }
}
