<?php
/**
 * Created by PhpStorm.
 * User: AlanLee
 * Date: 2019/8/22
 * Time: 19:31
 */

namespace app\index\controller;
use think\Controller;
use think\Db;

class Tags extends Controller
{
    public function index(){

    }

    /**
     * 内置标签
     */

    /**
     * volist
     */
    public function volist(){

        $data = Db::table("user")->select();
//        dump($data);
        $this->assign("data",$data);
        $this->assign("data1",[]);

        return view();

    }

    /**
     * foreach
     */
    public function foreach(){

        $data = Db::table("user")->select();
//        dump($data);
        $this->assign("data",$data);

        return view();

    }


    /**
     * 比较标签
     */
    public function bijiao(){
        $a = 10;

        $b = 12;

        $this->assign("a",$a);
        $this->assign("b",$b);


        $this->assign("week",date("w"));



        return view();

    }
}