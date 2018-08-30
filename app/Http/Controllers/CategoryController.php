<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoryFormRequest;
use Illuminate\Http\Request;

class CategoryController extends AuthController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories=null;
        if($request->has('q')){
            $param='%'.$request->input('q').'%';
            $categories=Category::where('name','like',$param)
                ->orWhere('description','like',$param)->get();
        }else{
            $categories=Category::all();
        }
        
        return view('category.index',[
            'page_title'=>'Categories',
            'categories'=>$categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create',[
            'page_title'=>'Add Category'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryFormRequest $request)
    {
        $logo='na.jpg';
        if($request->hasFile('logo')){
            $logo=$request->file('logo')->store('public/categories');
        }
        $category=new Category();
        $category->name=$request->input('name');
        $category->description=$request->input('name');
        $category->logo=$logo;
        $category->parent_id=0;
        $category->status=$request->has('status');
        $category->save();
        return redirect('/categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('category.edit',[
            'page_title'=>'Edit Category',
            'category'=>Category::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        
        if($request->hasFile('logo')){
            $category->logo=$request->file('logo')->store('public/categories');
        }
        
        $category->name=$request->input('name');
        $category->description=$request->input('name');
        $category->parent_id=0;
        $category->status=$request->has('status');
        $category->save();
        return redirect('/categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete_flag=1;
        $category->save();
        return redirect('/categories');
    }

    public function changeStatus(Request $request){
        return $this->updateStatus($request,Category::class);
    }
}
