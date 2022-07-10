<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
class Customer
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
        // ADM for admin, CUS for Customer, STA is staff
        
        if(Auth::check() &&  auth()->user()->utype === 'ADM' || auth()->user()->utype === 'STA' || auth()->user()->utype === 'CUS'){
            return $next($request);
        }
        else {
            return response()->view('errors.403');
        }
       
    }
}
