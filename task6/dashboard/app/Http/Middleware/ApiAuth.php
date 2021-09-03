<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\traits\generalTrait;

class ApiAuth
{
    use generalTrait;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('api')->check()) {
            return $this->returnErrorMessage(null, 'Unauthorized User', 401);
        }
        return $next($request);
    }
}