<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
// use think\Db;

class User extends Controller
{

    public $code;
    public function __construct(Request $request = null){
        parent::__construct($request);
        $this->code=config('code');
    }
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //用户注册
        $data = $this->request->post();
        //验证规则（待补充）

        $data['password']=sercetPassword($data['password']);
        $data['nickname']='小主'.time();
        // $data['create_time']=time();
        // $data['update_time']=time();
        $model = model('User');
        $result=$model->add($data);
        if($result){
            return json([
                'code'=> $this->code['success'],
                'msg'=>'注册成功'
            ]);
        }
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
        checkToken();
        $uid = $this->request->uid;
        $model = model('User');
        $result=$model->initUserinfo($uid);
        // var_dump($result);
        // exit();
        if($result){
            $result['sextext'] = setsextext($result['sex']);
            return json([
                'code' => $this->code['success'],
                'msg' => '数据获取成功',
                'data' => $result
            ]);
        }else{
            return json([
                'code' => $this->code['success'],
                'msg' => '没有数据',
            ]);
        }
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
