<?php
/**
 * Created by PhpStorm.
 * User: AlanLee
 * Date: 2019/8/24
 * Time: 8:56
 */

namespace app\index\validate;


use think\Validate;

class MyValidate extends Validate
{

    //验证器规则
    protected $rule = [
        "username"=>"require|length:6,12",
        "password"=>"require|confirm:repassword"
    ];


    //验证提示信息
    protected $message = [
        "username.require"=>'用户名不存在',
        "username.length"=>'用户名长度不满足',
        "password.require"=>'密码不能为空',
        "password.comfirm"=>'两次密码不一致'
    ];


}