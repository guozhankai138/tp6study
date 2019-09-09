<?php

namespace app\model;

use think\Model;

use think\facade\Db;
/**
 * @mixin think\Model
 */
class Login extends Model
{
	protected $table='user';
    /**
     * 验证用户登陆信息
     *
     * @return array
     */ 
    public function login()
    {
		// 验证数据库有无此数据
		$data=Db::table('user')->where('username','=',input('username'))->find();
		// dump($data);die();
		if($data){
			
				if($data['password']==md5(input('password'))){
					session('user',$data);
					
					return 3;   //第3步，登陆成功，返回3
				}else{
					return 2;  //第2步，验证密码，无，返回2
				}
			
		}else{
			return 1;	//第一步，验证此账号，无，返回1
		}
	}
}
