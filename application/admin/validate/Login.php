<?php


namespace app\admin\Validate;

use think\Validate;

class Login extends Validate{
    protected $rule=[
        'username'=>'require',
        'password'=>'require',
        'oldpass'=>'require',
        'pass'=>'require',
        'checkPass'=>'require|confirm:pass',
    ];
    protected $message=[
        'username'=>'用户名必须填写',
        'password'=>'密码必须填写',
        'oldpass'=>'旧密码必填',
        'pass'=>'新密码必填',
        'checkPass.require'=>'确认密码必填',
        'checkPass.confirm'=>'两次密码必须一致',
    ];

     //设置验证场景
     protected $scene = [
        'login'=>'username,password',
        'editpass'=>'oldpass,pass,checkpass'
    ];
}

