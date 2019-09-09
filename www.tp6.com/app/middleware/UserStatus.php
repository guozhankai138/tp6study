<?php

namespace app\middleware;

use think\facade\Db;

use app\model\Auth;
class UserStatus
{
	/**
     * 中间件判断用户状态
     *
     * @return \think\Response
     */
    public function handle($request, \Closure $next)
    {
    	//判断用户是否登陆
    	if(!session('?user')){
    		return redirect('login/login');
    	}
    	
    	return $next($request);
    }
}
