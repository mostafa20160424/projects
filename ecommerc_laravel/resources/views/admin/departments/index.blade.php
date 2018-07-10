@extends('admin.index')
@section('content')
  @push('js')
    <script type="text/javascript">
      $(function () {
          $(".show-button").addClass('hidden');
          $('#jsTree').jstree({
              "core" : {
                  'data' : {!! load_dep(old('parent_id')) !!},
                  'themes':{
                      'variant':"large"
                  }
              },
              "checkbox" : {
                  "keep_selected_style" : false
              },
              "plugins" : [ "wholerow" ]
          });
          $('#jsTree').on('changed.jstree',function (e,data) {
              var i,j = [];
              var r=[];
              for (i=0 , j=data.selected.length ; i < j ; i++)
              {
                  r.push(data.instance.get_node(data.selected[i]).id)
              }
              //then will add all selected nodes id in r array when select or remove select
              $(".parent_id").val(r.join(','))
              //then input value will have all selected nodes id seperate with ,
              if(r.join(',')!=''){
                  $(".show-button").removeClass('hidden');
                  $(".edit").attr('href','{{ aurl('departments/') }}'+'/'+r.join(',')+'/edit');
                  $(".delete-form").attr('action','{{ aurl('departments/') }}'+'/'+r.join(','));
              }else {
                  $(".show-button").addClass('hidden');
              }
          });

      })
    </script>

  @endpush
  <div class="box">

      <div class="box-header">

      <h3 class="box-title">Department</h3>

      </div>

      <div class="box-body">
          <div class="show-button">
          <a class="btn btn-info edit"><i class="fa fa-edit"></i> {{ trans('admin.edit') }}</a>
              <button type="button" class="btn btn-danger " data-toggle="modal" data-target="#myModal">
                  <i class="fa fa-trash"></i>
              </button>
          </div>
          <input type="hidden" name="parent_id" class="parent_id" value="{{ old('parent_id') }}">
        <div id="jsTree"></div>
      </div>
  </div>
  <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Modal Header</h4>
              </div>
              <form class="delete-form" action="" method="post">
                  <?php //action="{{aurl('admin'."/".$id)}}" ?>
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="_method" value="DELETE">
                  <div class="modal-body">
                      Delete this
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="submit" name="button" class="btn btn-danger">I'Sure</button>
                  </div>
          </div>

          </form>
      </div>
  </div>


@endsection
