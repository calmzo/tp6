<?php
/**
 * Demo.php
 * Created on 2020/8/7 8:14 下午
 * Created by chenzhuo
 * description :
 */

namespace app\controller;
use app\BaseController;
use think\facade\Db;

class Demo extends BaseController
{
    public function show() {
        $result = [
            "status" => 200,
            "message" => "OK",
            "data" =>[
                'id' => 1,
                'name' => 'calm'
            ]
        ];
        return json($result);
    }

    public function request() {
        dump($this->request->param('name',13,'intval'));
    }

    public function database()
    {
        $article = Db::table('pc_article')
            ->where('id','>', 10)
            ->order('id','desc')
//            ->page(2,4)
//            ->select();
            ->select();
        dump($article);
//        return success($article);


    }



}