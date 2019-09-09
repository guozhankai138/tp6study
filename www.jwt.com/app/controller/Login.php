<?php

namespace app\controller;

use think\Request;

class Login
{
    /**
     * 用户登陆
     *
     * @return \think\Response
     */
    public function login()
    {
        return view('login');
    }
}
