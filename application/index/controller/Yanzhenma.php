<?php
/**
 * Created by PhpStorm.
 * User: AlanLee
 * Date: 2019/8/24
 * Time: 10:40
 */

namespace app\index\controller;


use think\Controller;

class Yanzhenma extends Controller
{
    public function index(){
        return view();
    }

    //验证码处理方法
    public function check(){
        $code = input("post.code");
        if (captcha_check($code)){
            echo "验证成功";
        }else{
            echo "验证失败";
        }

    }
}