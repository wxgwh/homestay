<?php

namespace app\index\model;
use think\Model;

class Homestay extends Model{
    public function edit($data,$where){
        return $this->allowField(true)->isUpdate(true)->where($where)->save($data);
    }
}
