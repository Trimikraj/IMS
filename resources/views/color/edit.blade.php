@extends('layouts.master')
@section('title','Edit Color')

@section('content')
<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {!!Form::open(['url'=>'colors/'.$color->id,'method'=>'PUT'])!!}
              <div class="box-body">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" name="name" class="form-control" value="{{$color->name}}"/>
                </div>
                <div class="form-group">
                  <label for="code">Code</label>
                  <input type="text" name="code" class="form-control"  value="{{$color->code}}"/>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="status" @if($color->status) checked="checked" @endif > Is Active
                  </label>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{url('/colors')}}" class="btn btn-danger">Cancel</a>
              </div>
              {{Form::token()}}
            {{Form::close()}}
          </div
@endsection