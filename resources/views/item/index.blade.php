@extends('layouts.master')
@section('page_title','Items')

@section('content')

<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">
                <a href="{{url('items/create')}}" class="btn btn-primary" title="Add Items"><span class="glyphicon glyphicon-plus"></span></a>
                <a href="{{url('items')}}" class="btn btn-danger">Clear</a>
              </h3>
              <!-- Button trigger modal -->
              <div class="col-xs-3 pull-right" title="Restore Items">
              <a class="btn btn-warning" id="restore"><span class="glyphicon glyphicon-repeat"></span>
              </a></div>
              
              <div class="box-tools">

              {!!Form::open(['url'=>'items','method'=>'GET'])!!}
                <div class="input-group input-group-sm" style="width: 150px;">

                  <input type="text" name="q" class="form-control pull-right" placeholder="Search" >

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
                  <th>Description</th>
                  <th>Quantity</th>
                  <th>Unit</th>
                  <th>Brand</th>
                  <th>Price</th>
                  <th>Reorder Level</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                @foreach($items as $item)
                @if(!$item->delete_flag)
                <tr>
                  <td>{{$item->id}}</td>
                  <td>{{$item->item_name}}</td>
                  <td>{{$item->item_description}}</td>
                  <td>{{$item->quantity}}</td>
                  <td>
                      {{$item->unit->name}}
                  </td>
                  <td>{{$item->brand->name}}</td>
                  <td>{{$item->price}}</td>
                  <td>@if(!$item->reorder_level)
                      0
                      @else {{$item->reorder_level}}            
                      @endif
                  </td>
                  <td data-id="{{$item->id}}" style="cursor:pointer">
                    @if($item->status)
                    <span class="label label-success status">Active</span>
                    @else
                    <span class="label label-danger status">Inactive</span>
                    @endif
                  </td>
                  <td>

                    {!!Form::open(['url'=>'items/'.$item->id,'method'=>'DELETE'])!!}
                    <a href="{{url('items/'.$item->id .'/edit')}}" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span></a>
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure to delete?')">
                            <span class="glyphicon glyphicon-trash"/>
                        </button>
                    {{Form::token()}}

                    {{Form::close()}}
                  </td>
                </tr>
                @endif
                @endforeach

              </table>
            <!-- /.box-body -->
          </div>
        </div>
<script>
  $(function(){
    $(".status").on('click',function(){
      var $this=$(this);
      var $id=$this.parent().attr('data-id');
      $.post('{{url("items/status")}}',{
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
    $(".restore").on('click',function(){
      var $this=$(this);
      var $id=$this.attr('data-id');
      $.post('{{url("items/restore")}}',{
        'id':$id,
        '_token':'{{csrf_token()}}'
      },function(res){
        if(res.success){
          restoreItem($this);
        }else{
          alert('Error Occured');
        }
      },'json');

      loadItems();
      
    });
    $("#restore").on('click',function(){
        $("#restoreModal").modal();
    });
  });

function loadItems() {
  $("#restoreModal").modal('hide');
  window.location = "/items/";
}
</script>



<!-- Modal -->
<div class="modal fade" id="restoreModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document" style="width:60%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Restore Items</h4>
      </div>
      <div class="modal-body">
      
      <table class="table table-hover">
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Quantity</th>
                  <th>Unit</th>
                  <th>Brand</th>
                  <th>Price</th>
                  <th>Reorder Level</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                @foreach($items as $item)
                @if($item->delete_flag)
                <tr>
                  <td>{{$item->id}}</td>
                  <td>{{$item->item_name}}</td>
                  <td>{{$item->item_description}}</td>
                  <td>{{$item->quantity}}</td>
                  <td>{{$item->unit->name}}</td>
                  <td>{{$item->brand->name}}</td>
                  <td>{{$item->price}}</td>
                  <td>@if(!$item->reorder_level)
                      0
                      @else {{$item->reorder_level}}            
                      @endif
                  </td>
                  <td>
                    @if($item->status)
                    <span class="label label-success status">Active</span>
                    @else
                    <span class="label label-danger status">Inactive</span>
                    @endif
                  </td>
                  <td>
                    <a data-id="{{$item->id}}" class="btn btn-primary restore" title="Restore"><span class="glyphicon glyphicon-repeat"></span></a>
                  </td>
                </tr>
                @endif
                @endforeach

              </table>

      </div>
      <div class="modal-footer">
        <a class="btn btn-primary">Restore All</a>
      </div>
    </div>
  </div>
</div>
@endsection