@extends('layouts.master')
@section('page_title','Item Fields')

@section('content')

<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">
                <a href="{{url('items/fields/create')}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span></a>
                <a href="{{url('fields')}}" class="btn btn-danger">Clear</a>
              </h3>
              
              <div class="box-tools">
              {!!Form::open(['url'=>'fields','method'=>'GET'])!!}
                <div class="input-group input-group-sm" style="width: 150px;">
                    
                  <input type="text" name="q" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                  
                  {{Form::token()}}
                  
                </div>
                {{Form::close()}}
              </div>
              
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  
                  <th>Action</th>
                </tr>
                @foreach($fields as $field)
                <tr>
                  <td>{{$field->id}}</td>
                  <td>{{$field->field_name}}</td>
                  <td>
                    
                    {!!Form::open(['url'=>'items/fields/'.$field->id,'method'=>'DELETE'])!!}
                    <a href="{{url('items/fields/'.$field->id .'/edit')}}" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span></a>
                        <button type="submit" class="btn btn-danger">
                            <span class="glyphicon glyphicon-trash"/>
                        </button>
                    {{Form::token()}}

                    {{Form::close()}}
                  </td>
                </tr>
                @endforeach
                
              </table>
            </div>
            <!-- /.box-body -->
          </div>

@endsection