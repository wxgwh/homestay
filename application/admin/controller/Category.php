<?php


namespace app\admin\controller;


use think\Controller;
use think\Db;

class Category extends Controller
{

    //权限验证
    public function _initialize(){
        parent::_initialize();
        // echo 'hello';
        checkToken();
    }

    public function add(){
        if (!$this->request->isPost()) {
            return json([
                'code' => 400,
                'msg' => '请求出错'
            ]);
        }
        $data = $this->request->post();
        $validate = validate('Category');
        if (!$validate->scene('add')->check($data)) {
            return json([
                'code' => 400,
                'msg' => $validate->getError()
            ]);
        }
        $result = Db::table('category')->insert($data);
        if($result){
            return json([
                'code' => 200,
                'msg' => '添加成功'
            ]);
        }else{
            return json([
                'code' => 400,
                'msg' => '添加失败'
            ]);
        }
    }

    public function index(){
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
        if(isset($data['cname']) && !empty($data['cname'])){
            $where['cname'] = ['like','%'.$data['cname'].'%'];
        }


        $category = Db::table('category')->field('cid,cname,cdesc')->where($where)->page($page)->limit($limit)->select();
        $count = Db::table('category')->where($where)->count();

        // var_dump($category);
        // var_dump($count);

        if($category && $count){
            return json([
                'code'=>200,
                'msg'=>'数据获取成功',
                'data'=>$category,
                'count'=>$count
            ]);
        }else{
            return json([
                'code'=>200,
                'msg'=>'暂时还没有数据'
            ]);
        }
    }   
    
    public function indexall(){
        $categorys = Db::table('category')->field('cid,cname')->select();
        if($categorys){
            return json([
                'code'=>200,
                'msg'=>'数据获取成功',
                'data'=>$categorys,
            ]);
        }else{
            return json([
                'code'=>200,
                'msg'=>'暂时还没有数据'
            ]);
        }
    }

    public function read(){
        $data = $this->request->get();
        $validate = validate('Category');
        if(!$validate->scene('read')->check($data)){
            return json([
                'code'=>404,
                'msg'=>$validate->getError()
            ]);
        }
        $category =  Db::table('category')->where('cid',$data['cid'])->find();
        if($category){
            return json([
                'code' => 200,
                'msg' => '数据读取成功',
                'data'=>$category
            ]);
        }else{
            return json([
                'code' => 400,
                'msg' => '意料之外的问题'
            ]);
        }
    }

    public function update(){
        $data = $this->request->post();
        $validate = validate('Category');
        if(!$validate->check($data)){
            return json([
                'code'=>404,
                'msg'=>$validate->getError()
            ]);
        }
        $result=Db::name('category')->where('cid',$data["cid"])->update(['cname'=>$data['cname'],'cdesc'=>$data['cdesc']]);
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

    public function delete(){
        $data = $this->request->get();
        $validate = validate('Category');
        if(!$validate->scene('read')->check($data)){
            return json([
                'code'=>404,
                'msg'=>$validate->getError()
            ]);
        }
        $result = Db::table('category')->delete($data);
        if($result){
            return json([
                'code' => 200,
                'msg' => '数据删除成功',
            ]);
        }else{
            return json([
                'code' => 400,
                'msg' => '意料之外的问题'
            ]);
        }
    }
}