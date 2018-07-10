<?php
/*
 * to uplodes the photos in public/storage folder
 * 1-set FILESYSTEM_DRIVER=public in .env file
 * 2-write command "php artisan storage:link"
 */


//before create new route file you should register it in RouteServiceProvider
Route::group(['prefix'=>'admin','namespace'=>'admin'],function(){
  //with prefix then all routes you right here will be admin/your route link
    Config::set('auth.defaults','admin');//set default model and auth() Admin

    Route::get('login','AdminController@login');

    //admin/ will go to index function admin/edit go to edit

    Route::post('login','AdminController@do_login');
    Route::any('logout','AdminController@logout');
    Route::get('forget/password','AdminController@forget_password');
    Route::post('forget/password','AdminController@sendMail');
    Route::get('lang/{lang}',function($lang){
      session()->has('lang')?session()->forget('lang'):session()->put('lang','');
      //session()->forget('session name') destroy this session
      //session()->put('session name',value);
      ($lang=="ar")?session()->put('lang','ar'):session()->put('lang','en');
      //we use this session in Lang Middleware to specify the language
      return back();
    });
    Route::group(['middleware'=>'admin:admin'],function(){
      Route::resource('admin','AdminDataController');
      Route::resource('countries','CountryController');
      Route::resource('cities','CityController');
      Route::resource('states','StateController');
      Route::resource('departments','DepartmentController');
      Route::resource('trademarks','TradeMarkController');
      Route::resource('manufactures','ManuFactureController');



        //'middleware'=>'middleware name register in kernel:guard name'
      Route::delete("admin/destroy/all","AdminDataController@multi_delete");

      Route::get('settings', 'Settings@setting');
      Route::post('settings', 'Settings@setting_save');

      Route::resource('users','UserDataController');
      //'middleware'=>'middleware name register in kernel:guard name'
      Route::delete("users/destroy/all","UserDataController@multi_delete");
      Route::delete("countries/destroy/all","CountryController@multi_delete");
      Route::delete("cities/destroy/all","CityController@multi_delete");
      Route::delete("states/destroy/all","StateController@multi_delete");
      Route::delete("trademarks/destroy/all","TradeMarkController@multi_delete");
      Route::delete("manufactures/destroy/all","ManuFactureController@multi_delete");

        //when go with method delete will active this function multi_delete can be put or patch


      Route::get('/',function(){
              return view('admin.home');
            });
        });
});
