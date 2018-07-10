@extends('admin.index')
@section('content')
  <div class="box">

    <div class="box-header">

    <h3 class="box-title">Edit</h3>

    </div>

    <div class="box-body">
      <form class="delete-from" action="{{aurl('cities')."/".$city->id}}" method="post">
        <?php
        //can but action="{{route('admin.update',$admin->id)}}" route take preifx.name in routelist
        //can but action="{{route('path in route list',route parameter)}}" route take preifx.name in routelist
         ?>
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="_method" value="PUT">
        <div class="form-group">
          <label for="city_name_ar">city_name_ar</label>
          <input type="text" name="city_name_ar" value="{{$city->city_name_ar}}" class="form-control">
        </div>
        <div class="form-group">
          <label for="city_name_en">city_name_en</label>
          <input type="text" name="city_name_en" value="{{$city->city_name_en}}" class="form-control">
        </div>
        <div class="form-group">
          {!! Form::label('country_id',"Country Name in English:") !!}
          {!! Form::select('country_id',App\Country::pluck('country_name_ar','id'),$city->country_id,['class'=>"form-control"]) !!}
        </div>

        <input type="submit" name="submit" value="submit">
      </form>
    </div>
  </div>




@endsection
