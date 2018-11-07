<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Model\Web;

class HomeMiddleware
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
        $web = Web::find(1);
        if($web->statu == 1){
            return $next($request);
        }else{
            return 123;
        }
    }
}
