<?php

namespace app\controller;

use think\Request;

use think\facade\Db;

use Firebase\JWT\JWT;

class Api
{   
    /**
     * 生成jwt
     *
     * @return json
     */
    public function login()
    {
        $param=request()->param();
        $username=$param['username'];
        $password=$param['password'];
        if(empty($username)||empty($password)){
            $return=[
                'code'=>1001,
                'msg'=>'参数不全'
            ];
            return json($return);
        }
        $user=Db::table('user')->where('username',$username)->field('id,username,password')->find();
        if(!$user){
            $return=[
                'code'=>1002,
                'msg'=>'用户名有误'
            ];
            return json($return);
        }
        if($user['password']!=md5($password)){
            $return=[
                'code'=>1003,
                'msg'=>'密码有误'
            ];
            return json($return);
        }
        //生成jwt
        $jwt=$this->createToken($user['id']);
        $return=[
            'code'=>2000,
            'msg'=>'登陆成功',
            'token'=>$jwt
        ];
        return json($return);
    }

    /**
     * 生成jwt
     *
     * @return json
     */
    public function createToken($id)
    {
        $key = md5("tp6");  //盐  salt
        $token = [
            "iss"=>"",  //签发者 
            "aud"=>"", //面象的用户
            "iat" => time(), //签发时间
            "exp" => time()+1800, //token 过期时间
            "uid" => $id //记录的userid的信息
        ];
        $jwt = JWT::encode($token,$key,"HS256"); //根据参数生成了 token
        return $jwt;
    }
    /**
     * 校验jwt
     *
     * @return json
     */
    public function checkToken()
    {
        $jwt = input("token");  //上一步中返回给用户的token
        $key = md5("tp6");  //上一个方法中的 $key
        if(empty($jwt)){
            $return=[
                'code'=>1001,
                'msg'=>'参数不全'
            ];
            return json($return);
        }
        try{
            JWT::decode($jwt,$key,["HS256"]);
        }catch(\Firebase\JWT\SignatureInvalidException $e){ //签名不正确
            $return=[
                'code'=>$e->getCode(),
                'msg'=>$e->getMessage()
            ];
            return json($return);
        }catch(\Firebase\JWT\BeforeValidException $e){ //签名在某个时间点之后生效
            $return=[
                'code'=>$e->getCode(),
                'msg'=>$e->getMessage()
            ];
            return json($return);
        }catch(\Firebase\JWT\ExpiredException $e){   //token过期
            $return=[
                'code'=>$e->getCode(),
                'msg'=>$e->getMessage()
            ];
            return json($return);
        }catch(Exception $e){   //其它异常
            $return=[
                'code'=>$e->getcode(),
                'msg'=>$e->getMessage()
            ];
            return json($return);
        }
        $info=JWT::decode($jwt,$key,["HS256"]);
        $return=[
            'code'=>2000,
            'msg'=>'token校验成功',
            'data'=>$info
        ];
        return json($return);
    }
}
