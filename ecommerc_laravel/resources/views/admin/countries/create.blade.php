@extends('admin.index')
@section('content')
  <div class="box">

    <div class="box-header">

    <h3 class="box-title">Create</h3>

    </div>

    <div class="box-body">
        {!! Form::open(['url'=>aurl('countries'),'files'=>true]) !!}
          <div class="form-group">
            {!! Form::label('country_name_ar',"Country Name in Arabic:") !!}
            {!! Form::text('country_name_ar',old('country_name_ar'),['class'=>"form-control"]) !!}
          </div>
          <div class="form-group">
            {!! Form::label('country_name_en',"Country Name in English:") !!}
            {!! Form::text('country_name_en',old('country_name_en'),['class'=>"form-control"]) !!}
          </div>
          <div class="form-group">
            {!! Form::label('mob',"Mob:") !!}
            {!! Form::text('mob',old('mob'),['class'=>"form-control"]) !!}
          </div>
          <div class="form-group">
            {!! Form::label('code',"Code:") !!}
            {!! Form::text('code',old('code'),['class'=>"form-control"]) !!}
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
