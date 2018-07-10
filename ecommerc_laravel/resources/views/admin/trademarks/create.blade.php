@extends('admin.index')
@section('content')
  <div class="box">

    <div class="box-header">

    <h3 class="box-title">Create</h3>

    </div>

    <div class="box-body">
        {!! Form::open(['url'=>aurl('trademarks'),'files'=>true]) !!}
          <div class="form-group">
            {!! Form::label('trademark_name_ar',"trademark Name in Arabic:") !!}
            {!! Form::text('trademark_name_ar',old('trademark_name_ar'),['class'=>"form-control"]) !!}
          </div>
          <div class="form-group">
            {!! Form::label('trademark_name_en',"trademark Name in English:") !!}
            {!! Form::text('trademark_name_en',old('trademark_name_en'),['class'=>"form-control"]) !!}
          </div>
          <div class="form-group">
            {!! Form::label('logo',"Logo:") !!}
            {!! Form::file('logo',['class'=>"form-control"]) !!}
          </div>
            {!! Form::submit('Create',["class"=>"btn btn-primary"]) !!}
            <?php
            /*
              Note:in laravel collective parameter must put by this order

              {!!
               Form::select('name',
               [opions in select box put here as "name"=>"value"],
               old('level'),
               ['class'=>"form-control",'id'=>"5","placeholder"=>"another option vakue","id"=>""])
                !!}
                {!! Form::label('for',"value") !!}
                {!! Form::input type('name',old('email'),['class'=>"form-control",attr like id]) !!}
                {!! Form::submit('value',["class"=>"btn btn-primary",attr]) !!}
            */
             ?>

        {!! Form::close() !!}
    </div>
  </div>




@endsection
