<?php

namespace App\Http\Middleware;

use App\Enums\UserTypes;
use Closure;
use Illuminate\Http\Request;

class IsAdmin
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
        if (auth()->user()->user_type == UserTypes::Admin){
            return $next($request);
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }
}
