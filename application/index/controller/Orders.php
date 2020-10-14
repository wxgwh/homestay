<?php

namespace app\index\controller;

use think\Controller;
use think\Request;

class Orders extends Controller
{
    public $code;
    public $model;
    //未添加验证
    public $validate;
    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->code = config('code');
        $this->model = model('Orders');
        $this->validate = validate();
    }
    public function _initialize(){
        parent::_initialize();
        checkToken();
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
        //用户 添加 未支付 订单
        $data = $this->request->post();
        // $this->validate->sence()->check();
        $data['statue']=1;
        $homestayModel = model('homestay');
        Db::startTrans();
        try{
            $orderResult = $this->model->add($data);
            $homestayResult = $homestayModel->edit(['status'=>0],$data['sid']);
            if($orderResult && $homestayResult){
                Db::commit();
            }
        }catch(Exception $exception){
            Db::rollback();
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
