@extends('admin.index')
@section('content')

@if (session()->has('success'))
  <div class="alert alert-success">
    {{session('success')}}
  </div>
@elseif (session()->has('error'))
  <div class="alert alert-danger">
    {{session('error')}}
    <?php //error session create by default with laravel ?>
  </div>
@endif
  <div class="box">

    <div class="box-header">

    <h3 class="box-title">{{ $title }}</h3>

    </div>

    <div class="box-body">
      <form class="delete-from" action="{{aurl('cities/destroy/all')}}" method="post">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="_method" value="DELETE">
          {!! $dataTable->table(
            [
            'class'=>'dataTable table table-striped table-borderd table-hover',
            ],
            true // to show the filter input foreach cell in table
            ) !!}

      </form>
    </div>
  </div>


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger">
          <h1 class="ans">{{trans('admin.Delete')}} <span class="record-count">5 Records</span> </h1>
          <h1 class="ask">{{trans('admin.Ask')}}</h1>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" name="button" class="btn btn-danger delete-all">DeleteAll Countries</button>
      </div>
    </div>

  </div>
</div>

  @push('js') <?php //@push('name you write in stack @stack('name')') ?>
    {!! $dataTable->scripts() !!}<?php //scripts() to shwo inforamtion ?>
  @endpush

@endsection
