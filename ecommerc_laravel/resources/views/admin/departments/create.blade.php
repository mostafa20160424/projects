@extends('admin.index')
@section('content')

    @push('js')
        <script type="text/javascript">
            $(function () {
                $('#jsTree').jstree({
                    "core" : {
                        'data' : {!! load_dep(old('parent_id')) !!},
                        'themes':{
                            'variant':"large"
                        }
                        /*data:[
                            { "id" : "ajson1", "parent" : "#", "text" : "Simple root node" },
                            { "id" : "ajson2", "parent" : "#", "text" : "Root node 2" },
                            { "id" : "ajson3", "parent" : "ajson2", "text" : "Child 1" },
                            { "id" : "ajson4", "parent" : "ajson2", "text" : "Child 2" },
                        ]*/
                    },
                    "checkbox" : {
                        "keep_selected_style" : false
                    },
                    "plugins" : [ "wholerow" ]
                });
                $('#jsTree').on('changed.jstree',function (e,data) {
                    var i,j = [];
                    var r=[];
                    for (i=0 , j=data.selected.length ; i < j ; i++)
                    {
                        r.push(data.instance.get_node(data.selected[i]).id)
                    }
                    //then will add all selected nodes id in r array when select or remove select
                    $(".parent_id").val(r.join(','))
                    //then input value will have all selected nodes id seperate with ,
                });
            });
        </script>

    @endpush

  <div class="box">

    <div class="box-header">

    <h3 class="box-title">Create</h3>

    </div>

    <div class="box-body">
        {!! Form::open(['url'=>aurl('departments'),'files'=>true]) !!}
          <div class="form-group">
            {!! Form::label('dep_name_ar',"dep Name in Arabic:") !!}
            {!! Form::text('dep_name_ar',old('dep_name_ar'),['class'=>"form-control"]) !!}
          </div>
          <div class="form-group">
            {!! Form::label('dep_name_en',"dep Name in English:") !!}
            {!! Form::text('dep_name_en',old('dep_name_en'),['class'=>"form-control"]) !!}
          </div>
          <div class="clearflex"></div>
          <div id="jsTree"></div>
          <input type="hidden" name="parent_id" class="parent_id" value="{{ old('parent_id') }}">
          <div class="clearflex"></div>


        <div class="form-group">
            {!! Form::label('description',"description:") !!}
            {!! Form::textarea('description',old('description'),['class'=>"form-control"]) !!}
          </div>
          <div class="form-group">
            {!! Form::label('keyword',"keyword:") !!}
            {!! Form::textarea('keyword',old('keyword'),['class'=>"form-control"]) !!}
          </div>
          <div class="form-group">
            {!! Form::label('icon',"icon:") !!}
            {!! Form::file('icon',['class'=>"form-control"]) !!}
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
