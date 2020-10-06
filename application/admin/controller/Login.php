<?php


namespace app\admin\controller;


use think\Controller;
use think\Db;
use think\JWT;

class Login extends Controller
{
    public function check(){
        $method = $this->request->method();
        // echo $method;
        if($method!='POST'){
            return json([
                'code'=>404,
                'msg'=>'请求出错'
            ]);
        }
        $data = $this->request->post();
        // var_dump($data);
        $validate=validate('Login');
        $flag = $validate->scene('login')->check($data);
        // var_dump($flag);
        if(!$flag){
            return json([
                'code'=>404,
                'msg'=>$validate->getError()
            ]);
        }
        $whereArr = ['username'=>$data['username']];
        $user=Db::table('admin')->where($whereArr)->find();
        // var_dump($user);
        if($user){
            $password = md5(crypt($data['password'],config('salt')));
            if($password === $user['password']){
                $payload=[
                    'id'=>$user['id'],
                    'username'=>$user['username'],
                    'avater'=>$user['avater']
                ];
                //会话，使用jwt
                $token=JWT::getToken($payload,config('jwtkey'));
                return json([
                    'code'=>200,
                    'msg'=>'登陆成功',
                    'token'=>$token,
                    'user'=>$payload
                ]);
            }else{
                return json([
                    'code'=>200,
                    'msg'=>'用户名或密码不正确'
                ]);
            }
        }else{
            return json([
                'code'=>404,
                'msg'=>'用户名不存在'
            ]);
        }
    }
}