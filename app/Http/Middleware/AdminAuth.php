<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use Session;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Session::has('admin-user')){
            if(Session::get('admin-user')->category===$_SERVER['HTTP_USER_AGENT'] && Session::get('admin-user')->gender===$_SERVER['REMOTE_ADDR']){
                return $next($request);
            }
            else{
                Session::forget('admin-user');
                return redirect()->route('secure-admin');
            }
        }
        else{
            return redirect()->route('secure-admin');
        }
    }
}
