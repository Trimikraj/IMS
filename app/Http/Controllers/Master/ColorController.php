<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Color;
use App\Http\Requests\ColorFormRequest;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $colors=null;
        if($request->has('q')){
            $param='%'.$request->input('q').'%';
            $colors=Color::where('name','like',$param)
                ->orWhere('code','like',$param)->get();
        }else{
            $colors=Color::all();
        }
        
        return view('color.index',[
            'page_title'=>'Color',
            'colors'=>$colors
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('color.create',[
            'page_title'=>'Add Color'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ColorFormRequest $request)
    {
        $color=new Color();
        $color->name=$request->input('name');
        $color->code=$request->input('code');
        $color->status=$request->has('status');
        $color->save();
        return redirect('/colors');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function show(Color $color)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('color.edit',[
            'page_title'=>'Edit Color',
             'color'=>Color::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function update(ColorFormRequest $request, Color $color)
    {
        $color->name=$request->input('name');
        $color->code=$request->input('code');
        $color->status=$request->has('status');
        $color->save();
        return redirect('/colors');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function destroy(Color $color)
    {
        $color->delete_flag=1;
        $color->save();
        return redirect('/colors');
    }

    public function changeStatus(Request $request){
        return $this->updateStatus($request,Color::class);
    }
}
