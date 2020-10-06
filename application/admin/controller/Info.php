<?php


namespace app\admin\controller;


use think\Controller;
use think\Db;
class Info extends Controller
{

    //权限验证
    public function _initialize(){
        parent::_initialize();
        // echo 'hello';
        checkToken();
    }

    public function editpassword(){
        if (!$this->request->isPost()) {
            return json([
                'code' => 400,
                'msg' => '请求出错'
            ]);
        }
        $data = $this->request->post();
        $validate=validate("Login");
        if(!$validate->scene("editpass")->check($data)){
            return json([
                'code'=>404,
                'msg'=>$validate->getError()
            ]);
        }
        $id=$this->request->id;
        $result=Db::table("admin")->field("password")->where("id",$id)->find();
        // var_dump($password);
        $password = $result["password"];
        $oldpass=sercetPassword($data["oldpass"]);
        $pass=sercetPassword($data["pass"]);
        if($password!=$oldpass){
            return json([
                'code' => 400,
                'msg' => '原密码错误'
            ]);
        }
        if($password==$pass){
            return json([
                'code' => 400,
                'msg' => '新密码不能与近期密码相同'
            ]);
        }
        $result = Db::table("admin")->where("id",$id)->update(["password"=>$pass]);
        if($result){
            return json([
                'code' => 200,
                'msg' => '密码修改成功',
            ]);
        }else{
            return json([
                'code' => 400,
                'msg' => '意料之外的问题'
            ]);
        }
    }
}