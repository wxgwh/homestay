<?php

namespace app\admin\validate;

use think\Validate;

class Category extends Validate{
    protected $rule = [
        'cid'=>'require|number',
        'cname'=>'require|chsAlphaNum',
        'cdesc'=>'require|chsAlphaNum'
    ];
    protected $message = [
        'cid.require'=>'cid必须填写',
        'cid.number'=>'cid必须是数字',
        'cname.require'=>'分类标题必须填写',
        'cname.chsAlphaNum'=>'分类标题只能包含汉字字母和数字',
        'cdesc.require'=>'描述内容必须填写',
        'cdesc.chsAlphaNum'=>'描述内容只能包含汉字字母和数字'
    ];

    //设置验证场景
    protected $scene = [
        'add'=>'cname,adesc',
        'read'=>'cid'
    ];
}