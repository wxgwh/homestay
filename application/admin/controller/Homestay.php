<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db;

class Homestay extends Controller
{

    public $code;
    public $validate;
    public function __construct(Request $request = null ){
        parent::__construct($request);
        $this->code=config('code');
        $this->validate = validate('Homestay');
    }

    //权限验证
    public function _initialize(){
        parent::_initialize();
        // echo 'hello';
        checkToken();
    }

    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $data=$this->request->get();
        //分页
        if(isset($data['page']) && !empty($data['page'])){
             $page=$data['page'];
        }else{
            $page=1;
        }

        if(isset($data['limit']) && !empty($data['limit'])){
            $limit=$data['limit'];
        }else{
           $limit=10;
        }

        //处理搜索条件
        $where=[];
        if(isset($data['scity']) && !empty($data['scity'])){
            $where['scity']=$data['scity'];
        }
        //模糊查询
        if(isset($data['sname']) && !empty($data['sname'])){
            $where['sname']=['like','%'.$data['sname'].'%'];
        }
        $result=Db::table('homestay')->field('sid,sname,sdesc,sprice,stag,sthumb,sprovince,scity,sarea,ctime',)->where($where)->paginate($limit,false,['page'=>$page]);
        $homestay=$result->items();
        $total=$result->total();
        if($homestay && $total){
            return json([
                'code'=>200,
                'msg'=>'数据获取成功',
                'data'=>$homestay,
                'total'=>$total
            ]);
        }else{
            return json([
                'code'=>200,
                'msg'=>'暂时还没有数据'
            ]);
        }
        // return 'index';
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
        $data=$this->request->post();
        // $this->validate->scene()->check();
        $sname = $data['sname'];
        $isExist=Db::table('homestay')->where('sname',$sname)->count();
        if($isExist){
            return json([
                'code'=> $this->code['success'],
                'msg'=>"该名称已存在"
            ]);
        }
        $data['ctime']=time();
        $result = Db::table("homestay")->insert($data);
        if($result){
            return json([
                'code'=>$this->code['success'],
                'msg'=>'数据添加成功'
            ]);
        }else{
            return json([
                'code'=>$this->code['fail'],
                'msg'=>'数据添加失败'
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
        $data=Db::table("homestay")->where('sid',$id)->find();
        if($data){
            $data['sbanner1']=\explode(',',$data['sbanner']);
            return json([
                'code'=> $this->code['success'],
                'msg'=>'数据获取成功',
                'data'=>$data
            ]);
        }else{
            return json([
                'code'=>$this->code['success'],
                'msg'=>'暂无数据'
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
        $data= $this->request->put();
        $result=Db::name('homestay')->where('sid',$data['sid'])->update(['sname'=>$data['sname'],'sdesc'=>$data['sdesc'],'cid'=>$data['cid'],'saddress'=>$data['saddress'],'sarea'=>$data['sarea'],'sbanner'=>$data['sbanner'],'scity'=>$data['scity'],'score'=>$data['score'],'sdetail'=>$data['sdetail'],'snotice'=>$data['snotice'],'sprice'=>$data['sprice'],'sprovince'=>$data['sprovince'],'stag'=>$data['stag'],'status'=>$data['status'],'sthumb'=>$data['sthumb']]);
        if($result){
            return json([
                'code' => 200,
                'msg' => '数据更新成功',
            ]);
        }else{
            return json([
                'code' => 400,
                'msg' => '意料之外的问题'
            ]);
        }
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
