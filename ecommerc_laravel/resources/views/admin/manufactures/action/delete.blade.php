<!-- Trigger the modal with a button -->
<button type="button" class="btn btn-danger " data-toggle="modal" data-target="#myModal{{$id}}">
  <i class="fa fa-trash"></i>
</button>

<!-- Modal -->
<div id="myModal{{$id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <form class="" action="{{route('manufactures.destroy',$id)}}" method="post">
        <?php //action="{{aurl('admin'."/".$id)}}" ?>
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="_method" value="DELETE">
      <div class="modal-body">
        <p>{{trans('admin.Delete',['name'=>$manufacture_name_ar])}}</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" name="button" class="btn btn-danger">I'Sure</button>
      </div>
    </div>

  </form>
  </div>
</div>
