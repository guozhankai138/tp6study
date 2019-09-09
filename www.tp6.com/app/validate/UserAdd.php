<?php

namespace app\validate;

use think\Validate;

class UserAdd extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
	protected $rule = [
        'username'=>'require|min:2',
        'password'=>'require|min:6|max:16',
        'repassword'=>'require|confirm:password',
        'roleid'=>'require'
    ];
    
    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */	
    protected $message = [];
}
