<?php

namespace App\Http\Controllers\Master;

use App\Unit;
use App\Http\Requests\UnitFormRequest;
use Illuminate\Http\Request;

class UnitController extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $units=null;
        if($request->has('q')){
            $param='%'.$request->input('q').'%';
            $units=Unit::where('name','like',$param)
                ->orWhere('code','like',$param)->get();
        }else{
            $units=Unit::all();
        }
        
        return view('unit.index',[
            'page_title'=>'Unit',
            'units'=>$units
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('unit.create',[
            'page_title'=>'Add Unit'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UnitFormRequest $request)
    {
        $unit=new Unit();
        $unit->name=$request->input('name');
        $unit->code=$request->input('code');
        $unit->status=$request->has('status');
        $unit->save();
        return redirect('/units');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('unit.edit',[
            'page_title'=>'Edit Unit',
             'unit'=>Unit::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(UnitFormRequest $request, Unit $unit)
    {
        $unit->name=$request->input('name');
        $unit->code=$request->input('code');
        $unit->status=$request->has('status');
        $unit->save();
        return redirect('/units');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit $unit)
    {
        $unit->delete_flag=1;
        $unit->save();
        return redirect('/units');
    }

    public function changeStatus(Request $request){
        return $this->updateStatus($request,Unit::class);
    }
}
