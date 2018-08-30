@extends('layouts.master')
@section('title','Add Item Field')
@section('content')


@if($errors->any())
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-ban"></i> Alert!</h4>
    <ul>
    @foreach($errors->all() as $error)
      <li>{{$error}}</li>
    @endforeach
    </ul>
</div>
  
   
@endif
<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {!!Form::open(['url'=>'items/fields/'.$field->id,'method'=>'PUT'])!!}
              <div class="box-body">
                <div class="form-group">
                  <label for="field_name">Field Name</label>
                  <input type="text" name="field_name" class="form-control" value="{{$field->field_name}}"/>
                </div>
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{url('items/fields')}}" class="btn btn-danger">Cancel</a>
              </div>
              {{Form::token()}}
            {{Form::close()}}
          </div>
@endsection
