<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Db;

class Index extends Controller
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
        $banner=Db::table('homestay')->field('sid,sname,sthumb')->order('sid','desc')->limit(0,3)->select();
        $category=Db::table('category')->field('cid,cname,cdesc')->order('cid','desc')->limit(0,4)->select();
        for($i=0,$count=count($category);$i<$count;$i++){
            $cid=$category[$i]['cid'];
            $homestay = Db::table('homestay')->field('sid,sthumb,sname,sdesc,sprice,score,stag,scity,sarea')->where('cid',$cid)->order('sid','sdesc')->limit(0,4)->select();
            $category[$i]['children']=$homestay;
        }

        
        return json([
            'code'=> $this->code['success'],
            'msg'=>'数据获取成功',
            'data'=> [
                'banner'=>$banner,
                'category'=>$category
            ]
        ]);
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
