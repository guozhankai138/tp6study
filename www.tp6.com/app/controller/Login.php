<?php

namespace app\controller;

use think\Request;

use app\model\Login as LoginModel;

use think\exception\ValidateException;

class Login
{
    /**
     * 登陆
     *
     * @return \think\Response
     */
    public function login()
    {
        if(request()->isPost()){
            try {
                $data=input();
                validate('login')->check($data);
            } catch (ValidateException $e) {
                // 验证失败 输出错误信息
                halt($e->getError());
                return redirect('login')->with('error',$e->getError());
            }
            $LoginModel=new LoginModel();
            $res=$LoginModel->login();
            if($res==1||$res==2){
                return redirect('login')->with('error','用户名或密码不正确');
            }else{
                
                return redirect('index/index');
            }
        }else{
            return view('login');
        }
    }
    /**
     * 注册
     *
     * @return \think\Response
     */
    public function register()
    {
        return view('register');
    }
    /**
     * 无权访问
     *
     * @return \think\Response
     */
    public function noAccess()
    {
        return view('403');
    }
    /**
     * 退出登陆
     *
     * @return \think\Response
     */
    public function loginOut()
    {
        session(null);
        return redirect('login');
    }
}
