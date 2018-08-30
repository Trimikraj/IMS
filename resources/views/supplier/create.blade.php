@extends('layouts.master')
@section('title','Add Store')

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
{!!Form::open(['url'=>'suppliers','method'=>'POST','files'=>true])!!}
<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
              <div class="pull-right">
              <button type="submit" class="btn btn-primary">
              <span class="glyphicon glyphicon-floppy-disk"></span> Save</button>
                <a href="{{url('/suppliers')}}" class="btn btn-danger">
                <span class="glyphicon glyphicon-remove"></span> Cancel</a>
              </div>
             
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
              <div class="box-body">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" name="name" class="form-control"/>
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" class="form-control"/>
                </div>
                <div class="form-group">
                  <label for="contact_no">Contact No</label>
                  <input type="text" name="contact_no" class="form-control"/>
                </div>
                <div class="form-group">
                  <label for="address">Address</label>
                  <input type="text" name="address" class="form-control"/>
                </div>
                <div class="form-group">
                  <label for="file">Logo</label>
                  <input type="file" name="logo"/>

                  <p class="help-block">Upload Allowed (jpg,gif,png)</p>
                </div>                    
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="status"> Is Active
                  </label>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{url('/suppliers')}}" class="btn btn-danger">Cancel</a>
              </div>
              {{Form::token()}}

          </div>            
  {{Form::close()}}
@endsection