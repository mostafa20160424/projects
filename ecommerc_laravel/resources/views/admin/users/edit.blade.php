@extends('admin.index')
@section('content')
  <div class="box">

    <div class="box-header">

    <h3 class="box-title">Edit</h3>

    </div>

    <div class="box-body">
      <form class="delete-from" action="{{aurl('users')."/".$user->id}}" method="post">
        <?php
        //can but action="{{route('admin.update',$admin->id)}}" route take preifx.name in routelist
        //can but action="{{route('path in route list',route parameter)}}" route take preifx.name in routelist
         ?>
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="_method" value="PUT">
        <div class="form-group">
          <label for="name">name</label>
          <input type="text" name="name" value="{{$user->name}}" class="form-control">
        </div>
        <div class="form-group">
          <label for="email">email</label>
          <input type="text" name="email" value="{{$user->email}}" class="form-control">
        </div>
        <div class="form-group">
          <label for="password"></label>
          <input type="password" name="password" value="" class="form-control">
        </div>
        <div class="form-group">
          {!! Form::label('level',"Level:") !!}
          {!!
             Form::select('level',
             ['user'=>'user',"vendor"=>'vendor',"company"=>'company'],
             $user->level ,
             ['class'=>"form-control","placeholder"=>"***********"])
          !!}
          </div>
        <input type="submit" name="submit" value="submit">
      </form>
    </div>
  </div>




@endsection
