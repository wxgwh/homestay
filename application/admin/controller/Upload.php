<?php

namespace app\admin\controller;

use \think\Controller;

class Upload extends Controller{
    public function index(){
        // 获取表单上传文件 例如上传了001.jpg
        $file = $this->request->file("file");
         if($file){
            // 移动到框架应用根目录/uploads/ 目录下
            $info = $file->validate(['size'=>1024000,'ext'=>'jpg,jpeg,png,gif'])->move(ROOT_PATH.'public'.DS.'upload');
            if($info){
                // 成功上传后 获取上传信息
                // 输出 jpg
                // echo $info->getExtension();
                // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
                // echo $info->getSaveName();
                // 输出 42a79759f284b767dfcb2a0197904287.jpg
                // echo $info->getFilename(); 
                $imgpath=date('Ymd').'/'.$info->getFileName();
                return json([
                    "code"=>200,
                    "msg"=>"图片上传成功",
                    "imgpath"=>"/thinkphp/public/upload/".$imgpath
                ]);
            }else{
                return json([
                    "code"=>400,
                    "msg"=>$file->getError()
                ]);
            }
            // 上传失败获取错误信息
            //echo $file->getError();
        }else{
            return json([
                "code"=>400,
                "msg"=>"上传错误"
            ]);
        }
    }
}