<?php

namespace App\Http\Middleware;

use Closure;

class HloginMiddleware
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
        if ($request->session()->has('user')) {
            return $next($request); //执行下一次请求 通过
        }else{
            // 跳转到登录页面
            return redirect('/home/user/login') -> back() -> withErrors('您还未登录 请先去登录');
    }
}
