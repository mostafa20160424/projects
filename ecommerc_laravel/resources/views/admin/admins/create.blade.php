@extends('admin.index')
@section('content')
  <div class="box">

    <div class="box-header">

    <h3 class="box-title">Create</h3>

    </div>

    <div class="box-body">
      <form class="delete-from" action="{{aurl('admin/')}}" method="post">
        <?php  //can but action="{{route('admin.store')}}" route take preifx.name in routelist ?>
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="form-group">
          <label for="name">{{trans('admin.name')}}</label>
          <input type="text" name="name" value="" class="form-control">
        </div>
        <div class="form-group">
          <label for="email">{{trans('admin.email')}}</label>
          <input type="text" name="email" value="" class="form-control">
        </div>
        <div class="form-group">
          <label for="password">{{trans('admin.password')) }}</label>
          <input type="password" name="password" value="" class="form-control">
        </div>
        <input type="submit" name="submit" value="submit" class="btn btn-primary">
      </form>
    </div>
  </div>




@endsection
