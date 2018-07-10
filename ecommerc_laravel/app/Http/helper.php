<?php
//to operate this file functions for all project go to Steps
/*
1-add to autoload object its files array in composer.json this file path will be "app/http/helper.php"
EX:    "autoload": {
        "classmap": [
            "database/seeds",
            "database/factories"
        ],
        "files":[
          "app/Http/helper.php"
        ],
        "psr-4": {
            "App\\": "app/"
        }
    },

  2-write command "composer dump-autoload"

  files is working (: (: (:
*/
if (!function_exists('aurl')) {
  function aurl($url=null)
  {
    return url('admin/'.$url);
  }
}
if (!function_exists('admin')) {
  function admin()
  {
    return auth()->guard('admin');
  }
}
if (!function_exists('setting')) {
	function setting() {
		return \App\Model\Setting::orderBy('id', 'desc')->first();
	}
}
if(! function_exists('up')){
  function up()
  {
    return new App\Http\Controllers\Uplode();
  }
}
if (!function_exists('lang')) {
  function lang()
  {
    if(session()->has('lang')){
      return session('lang');
    }
    return setting()->main_lang;
  }
}
if (!function_exists('LangDir')) {
  function LangDir()
  {
    if(session()->has('lang')){
      return session('lang')=="ar" ? "rtl": "";
    }
      return setting()->main_lang=="ar"?"rtl":"";
  }
}
if (!function_exists('active_menu')) {
  function active_menu($link)
  {
    if( preg_match('/'.$link.'/i', Request::segment(2)))
    //Request::segment(2) mean the second path after public("project path")
    {
      return ['menu-open','display:block'];
    }
    else{
      return ['',''];
    }
  }
}
if (!function_exists('v_image')) {
  function v_image($ext=null)
  {
    if($ext == null){
      return "image|mimes:jpg,jpeg,png,gif,bmp";
    }
    return "image|mimes:".$ext;
  }
}

if (!function_exists('load_dep')) {
    function load_dep($select=null , $dep_id=null)
    {

       $departments = \App\Department::selectRaw('dep_name_'.lang().' as text')->selectRaw('id as id')
           ->selectRaw('parent_id as parent')->get(['text,parent,id']);
       //$departments = "select id as id , parent_id as parent , dp_name_ar as text from departments"
        $dep_arr=[];

        foreach ($departments as $department){

                $list=[];
                $list['icon']='';
                $list['li_attr']='';
                $list['a_attr']='';
                $list['children']=[];
            if($select==$department->id && $select!=null){
                $list['state']=[
                    'opened'=>true,
                    'selected'=>true,
                    "disabled"=>false,
                ];
            }
            if($dep_id==$department->id && $dep_id!=null){
                $list['state']=[
                    'opened'=>false,
                    'selected'=>false,
                    "disabled"=>true,
                    'hidden'=>true,//to hidden this department children
                ];
            }
            $list['id']=$department->id;
            $list['parent']=$department->parent == null ? '#' : $department->parent;
            $list['text']=$department->text;
            //$dep_arr[]=$list;
            array_push($dep_arr,$list);
        }

        return json_encode($dep_arr,JSON_UNESCAPED_UNICODE);
        /*
         * will return data as
         * [
               { "id" : "ajson1", "parent" : "#", "text" : "Simple root node" },
               { "id" : "ajson2", "parent" : "#", "text" : "Root node 2" },
               { "id" : "ajson3", "parent" : "ajson2", "text" : "Child 1" },
               { "id" : "ajson4", "parent" : "ajson2", "text" : "Child 2" },
            ]
         *
         *  */
    }
}