<?php

namespace app\controller;

use think\Request;

class Auth
{
    protected $middleware=['userstatus','userauth'];
    /**
     * 权限列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
    }

    /**
     * 权限增加
     *
     * @return \think\Response
     */
    public function add()
    {
        //
    }


    /**
     * 权限修改
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }


    /**
     * 权限删除
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
