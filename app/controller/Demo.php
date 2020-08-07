<?php
/**
 * Demo.php
 * Created on 2020/8/7 8:14 下午
 * Created by chenzhuo
 * description :
 */

namespace app\controller;
use app\BaseController;
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



}