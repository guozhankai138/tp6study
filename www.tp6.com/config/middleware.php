<?php  
	//预定义中间件	
	return [
		//自己定义的检测用户是否登陆的中间件
		'userstatus'	=>	app\middleware\UserStatus::class,
		//用户有无访问权限的中间件
		'userauth'      =>  app\middleware\UserAuth::class
	];