@extends('layouts.master')
@section('page_title','Categories')

@section('content')

<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">
                <a href="{{url('categories/create')}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span></a>
                <a href="{{url('categories')}}" class="btn btn-danger">Clear</a>
              </h3>
              
              <div class="box-tools">
              {!!Form::open(['url'=>'categories','method'=>'GET'])!!}
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
                  <th>Added Date</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                @foreach($categories as $category)
                <tr>
                  <td>{{$category->id}}</td>
                  <td>{{$category->name}}</td>
                  <td>{{$category->created_at}}</td>
                  <td data-id="{{$category->id}}" style="cursor:pointer">
                    @if($category->status)
                    <span class="label label-success status">Active</span>
                    @else
                    <span class="label label-danger status">Inactive</span>
                    @endif
                  </td>
                  <td>
                    
                    {!!Form::open(['url'=>'categories/'.$category->id,'method'=>'DELETE'])!!}
                    <a href="{{url('categories/'.$category->id .'/edit')}}" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span></a>
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
      $.post('{{url("categories/status")}}',{
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