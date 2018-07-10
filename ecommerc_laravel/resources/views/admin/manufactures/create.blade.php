@extends('admin.index')
@section('content')

    @push('js')
        <script type="text/javascript" src='https://maps.google.com/maps/api/js?key=AIzaSyC0UyK25PoTKCER-IKIQDMyLXW2dYwuSVs&sensor=false&libraries=places'></script>
        <script src="{{ url('design/adminlit/dist/js/locationpicker.jquery.js') }}"></script>
        <script type="text/javascript">
            $('#us1').locationpicker({
                location: {
                    latitude: 46.15242437752303,
                    longitude: 2.7470703125
                },
                radius: 300,
                markerIcon: 'http://www.iconsdb.com/icons/preview/tropical-blue/map-marker-2-xl.png',
                inputBinding: {
                    latitudeInput: $('#lat'),
                    longitudeInput: $('#lng'),
                    //radiusInput: $('#us2-radius'),
                    //locationNameInput: $('#us2-address')
                }
            });
        </script>
    @endpush
  <div class="box">

    <div class="box-header">

    <h3 class="box-title">Create</h3>

    </div>

    <div class="box-body">
        {!! Form::open(['url'=>aurl('manufactures'),'files'=>true]) !!}
          <div class="form-group">
            {!! Form::label('manufacture_name_ar',"manufacture Name in Arabic:") !!}
            {!! Form::text('manufacture_name_ar',old('manufacture_name_ar'),['class'=>"form-control"]) !!}
          </div>
          <div class="form-group">
            {!! Form::label('manufacture_name_en',"manufacture Name in English:") !!}
            {!! Form::text('manufacture_name_en',old('manufacture_name_en'),['class'=>"form-control"]) !!}
          </div>
        <div class="form-group">
            {!! Form::label('email') !!}
            {!! Form::email('email',old('email'),['class'=>"form-control"]) !!}
        </div>
        <div class="form-group">
            {!! Form::label('mobile') !!}
            {!! Form::text('mobile',old('mobile'),['class'=>"form-control"]) !!}
        </div>
        <div class="form-group">
            <div id="us1" style="width: 500px; height: 400px;"></div>
        </div>
        <div class="form-group">
            {!! Form::label('contact_me',"contact_me") !!}
            {!! Form::text('contact_me',old('contact_me'),['class'=>"form-control"]) !!}
        </div>
        <div class="form-group">
            {!! Form::label('facebook',"facebook") !!}
            {!! Form::text('facebook',old('facebook'),['class'=>"form-control"]) !!}
        </div>
        <div class="form-group">
            {!! Form::label('twitter',"twitter") !!}
            {!! Form::text('twitter',old('twitter'),['class'=>"form-control"]) !!}
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
