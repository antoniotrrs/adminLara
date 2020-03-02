<?php

namespace App\Http\Middleware;

use Closure;

class WebUser
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
      if (!isset($_SESSION['token'])){
        return redirect()->route('home');
      }
        return $next($request);
    }
}
