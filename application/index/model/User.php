<?php

namespace app\index\model;

use think\Model;

class User extends Model{

    //自动添加时间戳
    protected $autoWriteTimestamp = true;
    public function add($data){
        //field()用于匹配数据库字段，allowField(true)过滤post数组中的非数据表字段数据
        return $this->allowField(true)->save($data);
    }
    public function find($where){
        //field中用于写需要查询的字段
        return $this->allowField(true)->field('uid,nickname,phone,collection')->where($where)->find();
    }
    // public function collection($uid){
    //     return $this->field('collection')->where($uid)->find();
    // }
    public function updatecollection($uid,$collection){
        $collection=implode(',',$collection);
        return $this->where('uid',$uid)->update(['collection'=>$collection]);
    }

    public function initUserinfo($uid){
        return $this->field('nickname,sex,avatar,phone')->find(['uid'=>$uid]);
    }

    public function initfavorites($uid){
        return $this->field('collection')->where('uid',$uid)->find();
    }
}
?>