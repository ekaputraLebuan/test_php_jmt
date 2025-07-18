<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isApoteker
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
        if(!auth()->check() ||  (auth()->user()->level_id != 5  && Auth()->user()->level_id != 1 )) {
            abort(403);
        }
        return $next($request);
    }
}
