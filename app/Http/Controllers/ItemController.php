<?php

namespace App\Http\Controllers;

use App\Item;
use App\User;
use App\Store;
use App\Unit;
use App\Brand;
use App\ItemPhoto;
use App\Http\Requests\ItemFormRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ItemController extends AuthController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items=null;
        if($request->has('q')){
            $param='%'.$request->input('q').'%';
            $items=Item::where('item_name','like',$param)
                ->orWhere('item_description','like',$param)->get();
        }else{
            $items=Item::all();
        }

        return view('item.index',[
            'page_title'=>'Items',
            'items'=>$items

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('item.create',[
            'page_title'=>'Add Item',
            'stores'=> Store::all(),
            'units'=>Unit::where('status',true)->get(),
            'brands'=>Brand::where('status',true)->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemFormRequest $request)
    {
        $item=new Item();
        $item->item_name=$request->input('item_name');
        $item->item_description=$request->input('item_description');
        $item->quantity=$request->input('quantity');
        $item->unit_id=$request->input('unit');
        $item->price=$request->input('price');
        $item->brand_id=$request->input('brand');
        $item->status=$request->has('status');
        $item->reorder_level=$request->input('reorder_level');
        $item->save();
        $photoId=$item->addToPhotos($item->id,$request->file('photo')->store('public/items'));
        $item->current_image=$photoId;
         $item->save();
        return redirect('/items');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('item.edit',[
            'page_title'=>'Edit Item',
            'item'=>Item::findOrFail($id),
            'units'=>Unit::where('status',1)->where('delete_flag',0)->get(),
            'brands'=>Brand::where('status',1)->where('delete_flag',0)->get(),
            'itemphotos'=>Item::find($id)->photos
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $item->item_name=$request->input('item_name');
        $item->item_description=$request->input('item_description');
        $item->quantity=$request->input('quantity');
        $item->unit_id=$request->input('unit');
        $item->price=$request->input('price');
        $item->brand_id=$request->input('brand');
        $item->status=$request->has('status');
        $item->reorder_level=$request->input('reorder_level'); 
        $item->save();
        $photoId=$item->addToPhotos($item->id,$request->file('photo')->store('public/items'));
        $item->current_image=$photoId;
         $item->save();
        return redirect('/items');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $item->delete_flag=1;
        $item->save();
        return redirect('/items');
    }

    public function changeStatus(Request $request){
        return $this->updateStatus($request,Item::class);
    }

    public function restoreItem(Request $request){
        return $this->restore($request,Item::class);
    }
}
