<?php
namespace app\index\controller;

use think\Controller;
use think\View;

class Index extends Controller
{
    public function index()
    {
        return '<style type="text/css">*{ padding: 0; margin: 0; } .think_default_text{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p> ThinkPHP V5<br/><span style="font-size:30px">十年磨一剑 - 为API开发设计的高性能框架</span></p><span style="font-size:22px;">[ V5.0 版本由 <a href="http://www.qiniu.com" target="qiniu">七牛云</a> 独家赞助发布 ]</span></div><script type="text/javascript" src="https://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script><script type="text/javascript" src="https://e.topthink.com/Public/static/client.js"></script><think id="ad_bd568ce7058a1091"></think>';
    }

    /**
     * 加载视图
     * @return mixed
     */
    public function load(){
        //方法1.继承系统控制器
        //使用fetch方法
        //return $this->fetch();

        //方法2.使用助手函数
        //return view();

        //方法3.使用view类（不建议使用）
        $view = new View();
        return $view->fetch();


    }


    /**
     * 模板赋值
     */
    public function fuzhi(){

        //定义变量
        $name = "Alan";
        $age = "22";
        $gender = "male";

        //分配变量到页面
        //方法1：
//        $this->assign("name",$name);
//        $this->assign("age",$age);
//        $this->assign("gender",$gender);

        //方法2：通过fetch方法
//        return $this->fetch('',
//            [
//                "name"=>$name,
//                "age"=>$age,
//                "gender"=>$gender
//            ]);

        //方法3：
//        return view('',[
//                "name"=>$name,
//                "age"=>$age,
//                "gender"=>$gender
//            ]);

        //方法4：对象赋值
        $this->view->name = "Alan";
        $this->view->age = "18";
        $this->view->gender = "male";



        return view();
    }


    /**
     * 模板替换（输出）
     * 通过config.php配置文件进行全局替换
     * 通过函数进行局部替换
     */
    public function modelReplace(){
        return $this->fetch("",[],["__HOMES__"=>"/static/home"]);
    }



    /**
     * 模板标签
     */
    public function tags(){
        $hello = "hello";

        $data = [
            "name"=>"alan",
            "age"=>"22",
            "sex"=>"男"
        ];

        $pass = 123;

        $time = time();

        //分配变量
        $this->assign("hello", $hello);
        $this->assign("data", $data);
        $this->assign("pass", $pass);
        $this->assign("time", $time);
        $this->assign("status", 0);




        return $this->fetch();
    }


    /**
     * 系统变量
     */
    public function sysVatr(){

        return view();
    }

    /**
     * 包含文件
     */
    public function includeFile(){

        return view();
    }

}
