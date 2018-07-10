<?php

namespace App\Http\Middleware;

use Closure;

class Lang
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      //first thing register the middleware in kernel.php
      //session()->has('lang')?app()->setlocale(session('lang')):app()->setlocale('en');
      //this function run on open the app or relode it or post data any reload
      app()->setlocale(lang());//lang is helper function i create in helpers.php
        return $next($request);
    }
}
