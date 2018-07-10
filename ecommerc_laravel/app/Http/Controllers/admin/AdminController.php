<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use DB;
use Carbon\Carbon;

class AdminController extends Controller
{
  public function login()
  {
    return view("admin.login");
  }

  public function do_login()
  {
    $rememberMe=request('rememberme')==1?true:false;
    if(admin()->attempt(['email'=>request('email'),'password'=>request('password')],$rememberMe)){
      //admin is helper function i create
      return redirect('admin');
    }else{
      session()->flash('error',trans('admin.invalid'));
      //      session()->flash('key',value);
      return redirect('admin/login');
    }
  }

  public function logout()
  {
    auth()->guard('admin')->logout();
    //admin()->logout();
    session()->flush();//destroy all sessions
    return redirect('admin/login');
  }

  public function forget_password()
  {
    return view('admin.forget_password');
  }

  public function sendMail()
  {

      $admin=Admin::where('email', request('email'))->first();
      //where(column name,value)->first() select the 1st row on database have email column = value request('email')
      if(!empty($admin)){
        $token=app('auth.password.broker')->createToken($admin);
        $data=DB::table('password_resets')->insert([
          'email'=>request('email'),
          'token'=>$token,
          'created_at'=>Carbon::now(),
        ]);
        return new App\Mail\AdminResetPassword(['data'=>$admin,'token'=>$token]);
      }
      return redirect('admin/login');
  }

}
