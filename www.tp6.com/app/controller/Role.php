<?php

namespace app\controller;

use think\Request;

class Role
{
    protected $middleware=['userstatus','userauth'];
    /**
     * 角色列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
    }

    /**
     * 角色增加
     *
     * @return \think\Response
     */
    public function add()
    {
        //
    }


    /**
     * 角色修改
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }


    /**
     * 角色删除
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
