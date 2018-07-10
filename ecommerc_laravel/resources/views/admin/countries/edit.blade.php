@extends('admin.index')
@section('content')
  <div class="box">

    <div class="box-header">

    <h3 class="box-title">Edit</h3>

    </div>

    <div class="box-body">
      <form class="delete-from" action="{{aurl('countries')."/".$country->id}}" method="post">
        <?php
        //can but action="{{route('admin.update',$admin->id)}}" route take preifx.name in routelist
        //can but action="{{route('path in route list',route parameter)}}" route take preifx.name in routelist
         ?>
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="_method" value="PUT">
        <div class="form-group">
          <label for="country_name_ar">country_name_ar</label>
          <input type="text" name="country_name_ar" value="{{$country->country_name_ar}}" class="form-control">
        </div>
        <div class="form-group">
          <label for="country_name_en">country_name_en</label>
          <input type="text" name="country_name_en" value="{{$country->country_name_en}}" class="form-control">
        </div>
        <div class="form-group">
          {!! Form::label('mob',"Mob:") !!}
          {!! Form::text('mob',$country->mob,['class'=>"form-control"]) !!}
        </div>
        <div class="form-group">
          {!! Form::label('code',"Code:") !!}
          {!! Form::text('code',$country->code,['class'=>"form-control"]) !!}
        </div>
        <div class="form-group">
          {!! Form::label('logo',"Logo:") !!}
          {!! Form::file('logo',['class'=>"form-control"]) !!}
        </div>
        <input type="submit" name="submit" value="submit">
      </form>
    </div>
  </div>




@endsection
