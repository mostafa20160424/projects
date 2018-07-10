@extends('admin.index')
@section('content')
  <div class="box">

    <div class="box-header">

    <h3 class="box-title">Create</h3>

    </div>

    <div class="box-body">
        {!! Form::open(['url'=>aurl('users')]) !!}
          <div class="form-group">
            {!! Form::label('name',"Name:") !!}
            {!! Form::text('name',old('name'),['class'=>"form-control"]) !!}
          </div>
          <div class="form-group">
            {!! Form::label('email',"Email:") !!}
            {!! Form::email('email',old('email'),['class'=>"form-control"]) !!}
          </div>
          <div class="form-group">
            {!! Form::label('password',"Password:") !!}
            {!! Form::password('password',['class'=>"form-control"]) !!}
          </div>
          <div class="form-group">
            {!! Form::label('level',"Level:") !!}
            {!!
               Form::select('level',
               ['user'=>'user',"vendor"=>'vendor',"company"=>'company'],
               old('level'),
               ['class'=>"form-control","placeholder"=>"***********"])
            !!}
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
