<?php

namespace app\middleware;

use think\facade\Db;

use app\model\Auth;
class UserAuth
{
    public function handle($request, \Closure $next)
    {
    	//判断用户有无访问此页面的权限
    	//1.判断是否是超管
    	if(session('user.is_super')==1){
    		return $next($request);
    	}
    	//2.判断要访问页面的权限id
    	$controllername=request()->controller();
    	$actionname=request()->action();
    	$authid=Db::table('auth')->where([
    		'controllername'=>$controllername,
    		'actionname'=>$actionname
    	])->value('id');
    	//根据用户id获取其权限id
    	$Auth=new Auth();
    	$authids=$Auth->getAuthIdByUserId();
    	if(!in_array($authid,$authids)){
    		return redirect('login/noaccess');
    	}
        return $next($request);
    }
}
