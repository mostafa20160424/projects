<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;

class Admin
{
  //you must register the middleware in kernel
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next=null , $guard=null)
    {
      if (Auth::guard($guard)->check()) {
        return $next($request);
          //return redirect('admin');//if he logged in
      }else{
        return redirect('admin/login');
      }

    }
}
