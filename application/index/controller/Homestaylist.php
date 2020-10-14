<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Db;

class Homestaylist extends Controller
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
        $data = $this->request->get();
       
        if(isset($data['page']) && !empty($data['page'])){
            $page = $data['page'];
        }else{
            $page = 1;
        }

        if(isset($data['limit']) && !empty($data['limit'])){
            $limit = $data['limit'];
        }else{
            $limit = 10;
        }

        $where=[];
        if(isset($data['scity']) && !empty($data['scity'])){
            $where['scity']=$data['scity'];
        }
        if(isset($data['sname']) && !empty($data['sname'])){
            $where['sname'] = ['like','%'.$data['sname'].'%'];
        }
        //排序
        $orderfield='sid';
        $ordertype='desc';
        if(isset($data['field']) && !empty($data['field'])){
            $orderfield = $data['field'];
        }
        if(isset($data['type']) && !empty($data['type'])){
            $ordertype = $data['type'];
        }

        $result = Db::table('homestay')->field('sid,sname,sthumb,score,sprice,scity,sarea')->where($where)->order($orderfield,$ordertype)->paginate($limit,false,['page'=>$page]);
        // $count = Db::table('category')->where($where)->count();
        $total = $result->total();
        $items = $result->items();

        if($total && $items){
            return json([
                'code'=> $this->code['success'],
                'msg'=>'数据获取成功',
                'total'=>$total,
                'data'=>$items,
            ]);
        }else{
            return json([
                'code'=> $this->code['success'],
                'msg'=>'暂时还没有数据'
            ]);
        }
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
