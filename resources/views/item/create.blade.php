@extends('layouts.master')
@section('title','Add Item')
@section('content')
@include('partials.error')

<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title"></h3>

    <!-- form start -->
    {!!Form::open(['url'=>'/items', 'method'=>'POST', 'files'=>true])!!}
    <div class="box-body">

      <div class="form-group">
        <label for="name">Item Name</label>
        <input type="text" name="item_name" class="form-control"/>
      </div>

      <div class="form-group">
        <label for="description">Description</label>
        <textarea name="item_description" class="form-control"></textarea>
      </div>

      <div class="row">
          <div class="col-md-6">

              <div class="form-group">
                  <label for="quantity">Quantity</label>
                  <input type="text" name="quantity" class="form-control"/>
                </div>
          </div>

          <div class="col-md-6">
              <div class="form-group">
                  <label for="unit">Unit</label>
                  <select name="unit" class="form-control">
                    <option value="">Select Unit</option>
                    @foreach($units as $unit)
                  <option value="{{$unit->id}}">{{$unit->name}}</option>
                  @endforeach
                  </select>
                </div>
          </div>
        </div>

        <div class="row">
            <div class="col-md-6">
  
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" name="price" class="form-control"/>
                  </div>
            </div>
  
            <div class="col-md-6">
                <div class="form-group">
                    <label for="brand">Brand</label>
                    <select name="brand" class="form-control">
                      <option value="">Select Brand</option>
                      @foreach($brands as $brand)
                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                    @endforeach
                    </select>
                  </div>
            </div>
            </div>
            <div class="form-group">
              <label for="reorder_level">Reorder Level</label>
              <input type="text" name="reorder_level" class="form-control"/>
            </div>
            <div class="form-group">
                  <label>Item Image</label>
                  <input type="file" name="photo"/>
            </div>
        <div class="form-inline">
                <lable><b>Status  </b> </lable>
                <lable><input type="checkbox" name="status"/>  Active</lable>
        </div>

        <div class="box-footer">
          <button type="submit"  class="btn btn-primary">Save</button>
        <a href="{{url('/items')}}" class="btn btn-danger">Cancel</a>
        </div> 

    {{Form::token()}}
    {{Form::Close()}}

  </div>

</div>


@endsection