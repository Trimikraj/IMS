@extends('layouts.master')
@section('title','Edit Supplier')

@section('content')
<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {!!Form::open(['url'=>'suppliers/'.$supplier->id,'method'=>'PUT','files'=>true])!!}
              <div class="box-body">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" name="name" class="form-control" value="{{$supplier->name}}"/>
                </div>
                <div class="form-group">
                  <label for="code">Description</label>
                  <textarea name="description" class="form-control" style="height:150px">{{$supplier->description}}</textarea>
                </div>
                <div class="form-group">
                  <label for="file">Logo</label>
                  <input type="file" name="logo"/>

                  <p class="help-block">Upload Allowed (jpg,gif,png)</p>
                </div>                
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="status" @if($supplier->status) checked="checked" @endif > Is Active
                  </label>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{url('/suppliers')}}" class="btn btn-danger">Cancel</a>
              </div>
              {{Form::token()}}
            {{Form::close()}}
          </div
@endsection