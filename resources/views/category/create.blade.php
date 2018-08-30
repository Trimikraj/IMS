@extends('layouts.master')
@section('title','Add Category')
<link rel="stylesheet" href="{{asset('bower_components/admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
  
@section('content')
@include('partials.error')
{!!Form::open(['url'=>'categories','method'=>'POST','files'=>true])!!}
<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
              <div class="pull-right">
              <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{url('/categories')}}" class="btn btn-danger">Cancel</a>
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
                  <label for="description">Description</label>
                  <textarea id="description" name="description" class="form-control" style="height:150px"></textarea>
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
                <a href="{{url('/categories')}}" class="btn btn-danger">Cancel</a>
              </div>
              {{Form::token()}}
            
          </div>
          {{Form::close()}}          
<script src="{{asset('bower_components/admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    //CKEDITOR.replace('description')
    //bootstrap WYSIHTML5 - text editor
    $('#description').wysihtml5()
  })
</script>          
@endsection