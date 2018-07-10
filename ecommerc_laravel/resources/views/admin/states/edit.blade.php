@extends('admin.index')
@section('content')
  @push('js')
    <script type="text/javascript">
        $(document).ready(function () {
          @if($state->country_id)

          $.ajax({
              url:"{{ aurl('states/create') }}",
              type:'get',
              dataType:'html',
              data:{country_id:"{{$state->country_id}}" , select:"{{$state->city_id}}"},
              success:function (data) {
                  $(".city").html(data);
              }
          })
          @endif

          $(".country_id").on('change',function () {
              var country = $(".country_id option:selected").val()
              if(country > 0){
                  $.ajax({
                      url:"{{ aurl('states/create') }}",
                      type:'get',
                      dataType:'html',
                      data:{country_id:country , select:''},
                      success:function (data) {
                          $(".city").html(data);
                      }
                  })
              }else {
                  $(".city").html('');
              }
          })
        })
    </script>
  @endpush
  <div class="box">

    <div class="box-header">

    <h3 class="box-title">Edit</h3>

    </div>

    <div class="box-body">
      <form class="delete-from" action="{{aurl('states')."/".$state->id}}" method="post">
        <?php
        //can but action="{{route('admin.update',$admin->id)}}" route take preifx.name in routelist
        //can but action="{{route('path in route list',route parameter)}}" route take preifx.name in routelist
         ?>
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="_method" value="PUT">
        <div class="form-group">
          <label for="state_name_ar">state_name_ar</label>
          <input type="text" name="state_name_ar" value="{{$state->state_name_ar}}" class="form-control">
        </div>
        <div class="form-group">
          <label for="state_name_en">state_name_en</label>
          <input type="text" name="state_name_en" value="{{$state->state_name_en}}" class="form-control">
        </div>
        <div class="form-group">
          {!! Form::label('country_id',"Country Name in English:") !!}
          {!! Form::select('country_id',App\Country::pluck('country_name_ar','id'),$state->country_id,['class'=>"form-control"]) !!}
        </div>

          <div class="form-group">
            {!! Form::label('city_id',"City Name in English:") !!}
            <span class="city"></span>
          </div>

        <input type="submit" name="submit" value="submit" class="btn btn-primary">
      </form>
    </div>
  </div>




@endsection
