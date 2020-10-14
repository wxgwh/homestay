<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Db;

class Favorites extends Controller
{
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
        checkToken();
        $uid = $this->request->uid;
        $model = model('User');
        $list = $model->initfavorites($uid);
        $list = $list['collection'];
        // $list = explode(',',$list);  
        // for($i = 0;$i<count($list);$i++){
        //     $list[$i]=intval($list[$i]);
        // }
        // var_dump($list);
        $result = Db::table('homestay')->field('sname,sprice,sthumb,stag')->where('sid','in',$list)->select();
        var_dump($result);
        exit();
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
