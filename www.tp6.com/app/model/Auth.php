<?php

namespace app\model;

use think\Model;

use think\facade\Db;
/**
 * @mixin think\Model
 */
class Auth extends Model
{
    /**
     * 权限树形图
     *
     * @return array
     */
    public function generateTree($data,$id=0)
    {
    	$array=[];
    	foreach($data as $v){
    		if($v['pid']==$id){
    			foreach($data as $v2){
    				if($v2['pid']==$v['id']){
    					foreach($data as $v3){
    						if($v3['pid']==$v2['id']){
    							$v2['son'][]=$v3;
    						}
    					}
    					$v['son'][]=$v2;
    				}
    			}
    			$array[]=$v;
    		}
    	}
    	return $array;
    }
    /**
     * 根据用户角色获取权限
     *
     * @return array
     */
    public function getAuthByRole()
    {
    	$roleid=Db::table('userrole')->where('userid',session('user.id'))->value('roleid') ?? '';
    	if(empty($roleid)){
    		return $auth=[];
    	}
    	if($roleid==1){
    		$auth=Db::table('auth')
    		->where('is_menu',1)
    		->field('id,pid,authname,controllername,actionname')
    		->select();
    		return $auth;
    	}
    	$authid=Db::table('roleauth')->where('roleid',$roleid)->column('authid');
    	if(empty($authid)){
    		return $auth=[];
    	}
    	$auth=Db::table('auth')
                    ->where('id','in',$authid)
                    ->where('is_menu',1)
                    ->field('id,pid,authname,controllername,actionname')
                    ->select();
        return $auth;
    }
    /**
     * 根据用户id获取权限id
     *
     * @return array
     */
    public function getAuthIdByUserId(){
    	$authids=Db::table('roleauth')->alias('ra')
    		->leftJoin('userrole ur','ra.roleid=ur.roleid')
    		->where('ur.userid',session('user.id'))
    		->column('ra.authid');
    	return $authids;
    }
}
