<?php
namespace app\controller;

use app\BaseController;

use think\facade\Db;

use app\model\Auth;
class Index extends BaseController
{
	protected $middleware=['userstatus'];
	 /**
     * 首页
     *
     * @return \think\Response
     */
    public function index()
    {
    	$Auth=new Auth();
    	$auth=$Auth->getAuthByRole();
    	$generatetree=$Auth->generateTree($auth);
        return view('index',['generatetree'=>$generatetree]);
    }

    public function hello($name = 'ThinkPHP6')
    {
        return 'hello,' . $name;
    }
}
