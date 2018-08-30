@extends('layouts.master')
@section('title','Add Store')

@section('content')

@include('partials.error')

<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {!!Form::open(['url'=>'staffs','method'=>'POST','files'=>true])!!}
              <div class="box-body">
              <div class="form-group">
                  <label for="first_name">First Name</label>
                  <input type="text" name="first_name" class="form-control"/>
                </div>
                <div class="form-group">
                  <label for="last_name">Last Name</label>
                  <input type="text" name="last_name" class="form-control"/>
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
                  <input type="file" name="photo"/>

                  <p class="help-block">Upload Allowed (jpg,gif,png)</p>
                </div>

                <div class="form-group">
                  <label for="store">Store</label>
                  <select name="store" class="form-control">
                    <option value="">Select Store</option>
                    @foreach($stores as $store)
                    <option value="{{$store->id}}">{{$store->name}}</option>
                    @endforeach
                  </select>

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
                <a href="{{url('/staffs')}}" class="btn btn-danger">Cancel</a>
              </div>
              {{Form::token()}}
            {{Form::close()}}
          </div
@endsection