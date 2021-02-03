<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsGraduated
{

    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->is_graduated == 1)
        {
          return abort(401);
        }
        return $next($request);
    }
}
