<?php

namespace App\Http\Middleware;

use App\Constant\UserTypeConst;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAgent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->user_type_id != UserTypeConst::AGENT)
        {
            return redirect()->route('login');
        }
        return $next($request);
    }
}
