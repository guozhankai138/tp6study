<?php

namespace app\controller;

use think\Request;

class Api
{
    // protected $middleware=['userstatus','userauth'];
    /**
     * 发送短信验证码
     *
     * @return json
     */
    public function sendMs()
    {
        $param=request()->param();
        $phone=$param['phone'];   //接受短信的手机号
        if(empty($phone)){
            $return=[
                'msg'=>'参数不全或为空'
            ];
            return json($return);
        }
        $smsurl='http://v.juhe.cn/sms/send'; //第三方发送短信接口

        //随机生成验证码存入redis并设置过期时间
        $mscode=rand(1,100000);
        cache()->store('redis')->set($phone.'_code',$mscode,180);
        halt(cache()->store('redis')->get($phone.'_code'));
        //curl请求发送短信接口
        //1.配置
        $smsdata=[
                'key'  => 'c18c5e58dc8daf28c53ecdce08838e68',        //你申请的appkey
                'mobile'=>$phone,    //接收短信的手机号码
                'tpl_id'=>'137641',   //你申请的短信模板id，根据实际情况修改
                'tpl_value'=>'#code#='.$mscode   //你设置的模板变量，根据实际情况修改
            ];
        //2.发送短信
        // $curl=curl_init();
        // curl_setopt($curl,CURLOPT_URL,$smsurl);
        // curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
        // curl_setopt($curl,CURLOPT_POST,true);
        // curl_setopt($curl,CURLOPT_POSTFIELDS,$smsdata);
        
        
        
        curl_exec($curl); 
        curl_close($curl);
        $return=[
            'msg'=>'短信验证码已发送'
        ]; 
        return json($return);
    }

    /**
     * 注册
     *
     * @return json
     */
    public function register()
    {
        $param=request()->param();
        $phone=$param['phone'];
        if(empty($param['mscode'])){
            $return=[
                'msg'=>'请输入验证码'
            ];
            return json($return);
        }
        $mscode=cache()->store('redis')->get($phone.'_code');
        if(!$mscode){
            $return=[
                'msg'=>'短信验证码已失效或不存在'
            ];
            return json($return);
        }
        //删除redis数据
        cache()->store('redis')->delete($phone.'_code');


        //数据表添加用户信息
        //
        //
        //
        //
        $return=[
            'msg'=>'注册成功'
        ];
        return json($return);
    }
}
