@extends('layouts.master')
@section('title','Edit Item')

@section('content')
<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {!!Form::open(['url'=>'items/'.$item->id,'method'=>'PUT','files'=>true])!!}
              <div class="box-body">

                  <div class="form-group">
                      <label for="name">Item Name</label>
                      <input type="text" name="item_name" value="{{$item->item_name}}"class="form-control"/>
                    </div>

                    <div class="form-group">
                      <label for="description">Description</label>
                      <textarea name="item_description" class="form-control"> {{$item->item_description}}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input type="text"value="{{$item->quantity}}" name="quantity" class="form-control"/>
                              </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="unit">Unit</label>
                                <select name="unit" class="form-control">
                                  <option value="">Select Unit</option>
                                  @foreach($units as $unit)
                                <option value="{{$unit->id}}"@if($item->unit_id == $unit->id) selected="selected" @endif >{{$unit->name}}</option>
                                @endforeach
                                </select>
                              </div>
                        </div>
                      </div>

                      <div class="row">
                          <div class="col-md-6">

                              <div class="form-group">
                                  <label for="price">Price</label>
                                  <input type="text" name="price" value="{{$item->price}}" class="form-control"/>
                                </div>
                          </div>

                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="brand">Brand</label>
                                  <select name="brand" class="form-control">
                                    <option value="">Select Brand</option>
                                    @foreach($brands as $brand)
                                  <option value="{{$brand->id}}"
                                      @if($item->brand_id == $brand->id) selected="selected" @endif >{{$brand->name}}</option>
                                  @endforeach
                                  </select>
                                </div>
                          </div>
                          </div>

                            <div class="form-group">
                              <label for="reorder_level">Reorder Level</label>
                              <input type="text" name="reorder_level" @if($item->reorder_level == NULL)value="0" @else value="{{$item->reorder_level}}" @endif class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label>Item Image</label>
                                {{Form::file('photo')}}
                                @foreach($itemphotos as $iphoto)
                                      <img src="{{Storage::url($iphoto->photo)}}" style="height:100px;width:100px"  alt="No image available" />
                                @endforeach
                            </div>
                            <div class="form-inline">
                              <lable><b>Status  </b> </lable>
                              <lable><input type="checkbox" name="status"@if($item->status) checked="checked" @endif />
                                  Active</lable>
                      </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{url('/items')}}" class="btn btn-danger">Cancel</a>
              </div>
              {{Form::token()}}
            {{Form::close()}}
          </div
@endsection