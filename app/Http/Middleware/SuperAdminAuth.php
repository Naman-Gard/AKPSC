<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;

class SuperAdminAuth
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
        if(Session::has('super-admin')){
            if(Session::get('super-admin')->category===$_SERVER['HTTP_USER_AGENT'] && Session::get('super-admin')->gender===$_SERVER['REMOTE_ADDR']){
                return $next($request);
            }
            else{
                Session::forget('super-admin');
                return redirect()->route('secure-superadmin');
            }
        }
        else{
            return redirect()->route('secure-superadmin');
        }
    }
}
