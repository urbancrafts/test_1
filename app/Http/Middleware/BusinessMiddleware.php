<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BusinessMiddleware
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
        // return $next($request);
        if (auth()->check() && auth()->user()->user_type === 'Business') {
            return $next($request);
        }
    
        //abort(403, 'Unauthorized');
        return redirect(route('index.page'));
    }
}
