@extends('layouts.master')
@section('page_title','Colors')

@section('content')

<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">
                <a href="{{url('colors/create')}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span></a>
                <a href="{{url('colors')}}" class="btn btn-danger">Clear</a>
              </h3>
              
              <div class="box-tools">
              {!!Form::open(['url'=>'colors','method'=>'GET'])!!}
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
                  <th>Code</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                @foreach($colors as $color)
                <tr>
                  <td>{{$color->id}}</td>
                  <td>{{$color->name}}</td>
                  <td>{{$color->code}}</td>
                  <td data-id="{{$color->id}}" style="cursor:pointer">
                    @if($color->status)
                    <span class="label label-success status">Active</span>
                    @else
                    <span class="label label-danger status">Inactive</span>
                    @endif
                  </td>
                  <td>
                    
                    {!!Form::open(['url'=>'colors/'.$color->id,'method'=>'DELETE'])!!}
                    <a href="{{url('colors/'.$color->id .'/edit')}}" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span></a>
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

  <script>
  $(function(){
    
    $(".status").on('click',function(){
      var $this=$(this);
      var $id=$this.parent().attr('data-id');
      $.post('{{url("colors/status")}}',{
        'id':$id,
        '_token':'{{csrf_token()}}'
      },function(res){
        if(res.success){
          changeStatus($this);
        }else{
          alert('Error Occured');
        }
      },'json');
      
    });
  });
</script>
@endsection