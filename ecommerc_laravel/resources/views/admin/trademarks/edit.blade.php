@extends('admin.index')
@section('content')
  <div class="box">

    <div class="box-header">

    <h3 class="box-title">Edit</h3>

    </div>

    <div class="box-body">
      <form class="delete-from" action="{{aurl('trademarks')."/".$trademark->id}}" method="post">
        <?php
        //can but action="{{route('admin.update',$admin->id)}}" route take preifx.name in routelist
        //can but action="{{route('path in route list',route parameter)}}" route take preifx.name in routelist
         ?>
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="_method" value="PUT">
        <div class="form-group">
          <label for="trademark_name_ar">trademark_name_ar</label>
          <input type="text" name="trademark_name_ar" value="{{$trademark->trademark_name_ar}}" class="form-control">
        </div>
        <div class="form-group">
          <label for="trademark_name_en">trademark_name_en</label>
          <input type="text" name="trademark_name_en" value="{{$trademark->trademark_name_en}}" class="form-control">
        </div>
        <div class="form-group">
          {!! Form::label('logo',"Logo:") !!}
          {!! Form::file('logo',['class'=>"form-control"]) !!}
          @if(!empty($trademark->icon))
            <img src="{{ Storage::url($trademark->icon) }}" alt="" style="width: 100px;height: 100px;">
          @endif
        </div>
        <input type="submit" name="submit" value="submit">
      </form>
    </div>
  </div>




@endsection
