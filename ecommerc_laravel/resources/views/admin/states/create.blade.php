@extends('admin.index')
@section('content')
@push('js')
  <script type="text/javascript">
    $(document).ready(function () {
        @if(old('country_id'))

        $.ajax({
            url:"{{ aurl('states/create') }}",
            type:'get',
            dataType:'html',
            data:{country_id:"{{old('country_id')}}" , select:"{{old('city_id')}}"},
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

    <h3 class="box-title">Create</h3>

    </div>

    <div class="box-body">
        {!! Form::open(['url'=>aurl('states'),'files'=>true]) !!}
          <div class="form-group">
            {!! Form::label('state_name_ar',"state Name in Arabic:") !!}
            {!! Form::text('state_name_ar',old('state_name_ar'),['class'=>"form-control"]) !!}
          </div>
          <div class="form-group">
            {!! Form::label('state_name_en',"state Name in English:") !!}
            {!! Form::text('state_name_en',old('state_name_en'),['class'=>"form-control"]) !!}
          </div>
          <div class="form-group">
            {!! Form::label('country_id',"Country Name in English:") !!}
            {!! Form::select('country_id',App\Country::pluck('country_name_ar','id'),old('country_id'),['class'=>"form-control country_id" , 'placeholder'=>"....."]) !!}
          </div>
        <div class="form-group">
            {!! Form::label('city_id',"City Name in English:") !!}
            <span class="city"></span>
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
