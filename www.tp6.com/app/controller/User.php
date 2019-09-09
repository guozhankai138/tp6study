<?php

namespace app\controller;

use think\Request;

use think\facade\Db;

use think\exception\ValidateException;

class User
{
    protected $middleware=['userstatus','userauth'];
    /**
     * 用户列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $user=Db::table('user')->alias('a')
                    ->join('userrole ar','a.id=ar.userid','LEFT')
                    ->join('role r','ar.roleid=r.id','LEFT')
                    ->where('a.delete_time',0)
                    ->field('a.*,r.rolename')
                    ->select();
        $total=Db::table('user')->count();
        return view('index',['user'=>$user,'total'=>$total]);
    }

    /**
     * 用户增加
     *
     * @return \think\Response
     */
    public function add()
    {
        $role=Db::table('role')->select();
        if(request()->isPost()){
            try {
                validate('useradd')->check(input());
            } catch (ValidateException $e) {
                // 验证失败 输出错误信息
                return redirect('add')->with('error',$e->getError());
            }
            Db::transaction(function(){
                $data=[
                    'username'=>input('username'),
                    'password'=>md5(input('password')),
                    'is_super'=>input('is_super')
                ];    
                $userid=Db::table('user')->strict(false)->insertGetId($data);
                Db::table('userrole')->save(['userid'=>$userid,'roleid'=>input('roleid')]);
            });
            return redirect('index');
        }else{
            return view('add',['role'=>$role]);
        }
    }


    /**
     * 用户修改
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit()
    {
        $role=Db::table('role')->select();
        if(request()->isPost()){
            Db::transaction(function(){
                Db::table('user')->strict(false)->save(input());
                Db::table('userrole')->where('userid',input('id'))->data(['roleid'=>input('roleid')])->update();
            });
            return redirect('index');
        }else{
            $user=Db::table('user')->alias('u')
                ->leftJoin('userrole ur','u.id=ur.userid')
                ->where('u.id',input('id'))
                ->field('u.id,u.username,u.is_super,ur.roleid')
                ->find();
            return view('edit',['role'=>$role,'user'=>$user]);
        }
    }


    /**
     * 用户删除
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete()
    {
        Db::transaction(function(){
            Db::table('user')->useSoftDelete('delete_time',time())->delete(input('id'));
            Db::table('userrole')->where('userid',input('id'))->useSoftDelete('delete_time',time())->delete();
        });
        return redirect('index');
    }
}
