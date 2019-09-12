<?php
/**
 * Created by PhpStorm.
 * User: AlanLee
 * Date: 2019/8/24
 * Time: 7:29
 */

namespace app\index\controller;


use app\index\validate\MyValidate;
use think\Cache;
use think\Controller;
use think\Cookie;
use think\Request;
use think\Session;
use think\Validate;
use think\Db;

class User extends Controller
{
    public function index(){
        return view();
    }


    //普通注册步骤
    public function register(){

        $data = input('post.');
        dump($data);

        //进行验证
        //验证用户名是否为空
        if ($data["username"]){
            //验证用户名长度
            $size = strlen($data["username"]);
            if ($size >= 6 && $size <= 12){
                //验证重复密码
                if ($data["password"] == $data["repassword"]){
                    //以上验证均正确
                    //收集数据
                    $arr["username"] = $data["username"];
                    $arr["password"] = md5($data["password"]);
                    $arr["sex"] = $data["sex"];
                    $arr["create_time"] = time();

                    //将数据插入数据库
                    if (Db::table("user")->insert($arr)){
                        $this->success("注册成功");
                    }else{
                        $this->error("注册失败");
                    }


                }else{
                    $this->error("两次密码不一致");
                }
            }else{
                $this->error("用户名长度为6到12位");
            }
        }else{
            $this->error("用户名不能为空");
        }

    }

    //使用验证器的步骤
    public function register2(){
        $validate = new Validate(
            [//第一个数组：验证规则
                "username"=>"require|length:6,12",
                "password"=>"require|confirm:repassword"
            ],
            [//第二个数组：提示信息
                "username.require"=>'用户名不存在',
                "username.length"=>'用户名长度不满足',
                "password.require"=>'密码不能为空',
                "password.comfirm"=>'两次密码不一致'

            ]
        );
//        dump($validate);
        //接收数据
        $data = input('post.');
//        dump($data);

        //进行验证
        if ($validate->check($data)){
            $arr["username"] = $data["username"];
            $arr["password"] = md5($data["password"]);
            $arr["sex"] = $data["sex"];
            $arr["create_time"] = time();

            //dump($arr);
            //插入数据库
            if (Db::table("user")->insert($arr)){
                $this->success("注册成功");
            }else{
                $this->$this->error("出册失败");
            }
        }else{
            //输出错误信息
            dump($validate->getError());
        }

    }

    //编写自己的验证器
    public function register3(){
        //实例化自己的验证器
        $validate = new MyValidate();

        //接收数据
        $data = input('post.');
//        dump($data);

        //进行验证
        if ($validate->check($data)){
            $arr["username"] = $data["username"];
            $arr["password"] = md5($data["password"]);
            $arr["sex"] = $data["sex"];
            $arr["create_time"] = time();

            //dump($arr);
            //插入数据库
            if (Db::table("user")->insert($arr)){
                $this->success("注册成功");
            }else{
                $this->error("出册失败");
            }
        }else{
            //输出错误信息
            dump($validate->getError());
        }


    }

    /**
     * 使用缓存
     */
    public function useCache(){
        if ($data = cache("UserData")){
            //如果缓存中有数据
            echo "从缓存中获取的数据";

        }else{
            //缓存中没有数据，就从数据库中读取
            $data = Db::table("user")->select();
            echo "从数据库中获取的数据";
            //并设置缓存
            Cache::set("UserData",$data,10);


        }

        $this->assign("data",$data);

        return view();

    }

    /**
     * 使用session
     */

    //设置session
    public function setSession(){
        $session = Session::set("username","Alan");
        dump($session);
    }

    //获取session
    public function getSession(){
        $session = Session::get("username");
        dump($session);
    }

    //判断是否设置session
    public function hasSession(){
        dump(Session::has("username"));
    }

    //删除session
    public function delSession(){
        $session = Session::delete("username");
        dump($session);
    }

    //清空session
    public function clearSession(){
        $session = Session::clear();
        dump($session);

    }


    /**
     * 使用Cookie
     */

    //设置Cookie
    public function setCookie(){
        $Cookie = Cookie::set("username","Alan");
        dump($Cookie);
    }

    //获取session
    public function getCookie(){
        $Cookie = Cookie::get("username");
        dump($Cookie);
    }

    //判断是否设置Cookie
    public function hasCookie(){
        dump(Cookie::has("username"));
    }

    //删除Cookie
    public function delCookie(){
        $Cookie = Cookie::delete("username");
        dump($Cookie);
    }

    //清空Cookie
    public function clearCookie(){
        $Cookie = Cookie::clear();
        dump($Cookie);

    }


    /**
     * 使用分页
     */
    public function fenye(){
        //查询数据
        $data = Db::table("user")->paginate(5);

        $this->assign("data",$data);

        return view();

    }


    /**
     * 文件上传
     */

    //单文件上传
    public function add(){
        return view();

    }

    public function upload(Request $request){
        $file = $request->file("file");


        //将文件移动到指定目录
        if ($info = $file->move("./upload/")){
            dump($info->getSaveName());
        }else{
            dump($info->getError());
        }


    }


    //多文件上传
    public function adds(){
        return view();

    }

    public function uploads(){
        $files = $this->request->file("file");

        foreach ($files as $file){
            if ($info = $file->move("./upload/")){
                dump($info->getSaveName());
            }else{
                dump($info->getError());
            }
        }
    }


}