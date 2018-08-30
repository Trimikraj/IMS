@extends('layouts.master')
@section('title','Edit Store')

@section('content')
<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {!!Form::open(['url'=>'staffs/'.$staff->id,'method'=>'PUT','files'=>true])!!}
              <div class="box-body">
                <div class="form-group">
                  <label for="first_name">First Name</label>
                  <input type="text" name="first_name" class="form-control" value="{{$staff->first_name}}"/>
                </div>
                <div class="form-group">
                  <label for="last_name">Last Name</label>
                  <input type="text" name="last_name" class="form-control" value="{{$staff->last_name}}"/>
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" class="form-control" value="{{$staff->email}}"/>
                </div>
                <div class="form-group">
                  <label for="contact_no">Contact No</label>
                  <input type="text" name="contact_no" class="form-control" value="{{$staff->contact_no}}"/>
                </div>
                <div class="form-group">
                  <label for="address">Address</label>
                  <input type="text" name="address" class="form-control" value="{{$staff->address}}"/>
                </div>
                <div class="form-group">
                  <label>Photo</label>
                  {{Form::file('photo')}}
                  <p class="help-block">Upload Allowed (jpg,gif,png)</p>
                  <img src="{{Storage::url($staff->photo)}}" style="height:100px;width:100px"  alt="No image available" />
                </div>
                  
                </div>                
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="status" @if($staff->status) checked="checked" @endif > Is Active
                  </label>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{url('/staffs')}}" class="btn btn-danger">Cancel</a>
              </div>
              {{Form::token()}}
            {{Form::close()}}
          </div
@endsection