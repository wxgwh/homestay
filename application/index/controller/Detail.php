<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Db;

class Detail extends Controller
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
        //
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
        $homestay=Db::table('homestay')->find($id);
        //tinkphp框架中不等于使用 <> ;
        $recommendWhere=['sid'=>['<>',$id]];
        $recommend=Db::table('homestay')->where($recommendWhere)->field('sid,sname,sthumb,sprice,score,scity,sarea')->order('sid','desc')->limit(0,4)->select();
        return json([
            'code'=> $this->code['success'],
            'msg'=>'数据获取成功',
            'data'=> [
                'homestay'=>$homestay,
                'recommend'=>$recommend
            ]
        ]);
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
