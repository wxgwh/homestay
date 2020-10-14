<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件


/*
    验证权限token
      1.获取token'
        1.1 GET token / POST token / header token （获取token）
      2.解析token
        2.1 JWT:verty()。  引入JWT
        2.2 成功
        2.3 失败-->退出
      3.
*/
use think\JWT;

function checkToken(){
    $get_token = request()->get('token');
    $post_token = request()->post('token');
    $header_token = request()->header('token');
    if($get_token){
        $token=$get_token;
    }else if($post_token){
        $token=$post_token;
    }else if($header_token){
        $token=$header_token;
    }else{
        json(['code'=>400,'msg'=>'token权限错误'],401)->send();
        exit();
    }
    $tokenResult = JWT::verify($token,config('jwtkey'));
    // var_dump($tokenResult);
    if(!$tokenResult){
        json(['code'=>400,'msg'=>'token权限错误'],401)->send();
        exit();
    }
    $flag=isset($tokenResult['id']);
    // exit();
    if($flag){
        request()->id = $tokenResult['id'];
    }
    $flag=isset($tokenResult['uid']);
    if($flag){
        request()->uid = $tokenResult['uid'];
    }
    $flag=isset($tokenResult['username']);
    if($flag){
        request()->uid = $tokenResult['username'];
    }
}

function sercetPassword($pass){
    return md5(crypt($pass,config('salt')));
}

function setsextext($sex){
    $sextext = '男';
    $setArr = ['未填写','男','女'];
    if(isset($setArr[$sex])){
        $sextext = $setArr[$sex]; 
    }
    return $sextext;
}