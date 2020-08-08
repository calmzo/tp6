<?php
/**
 * Created by singwa
 * User: singwa
 * motto: 现在的努力是为了小时候吹过的牛逼！
 * Time: 07:55
 */
namespace app\admin\controller;
use think\facade\View;

class Index extends AdminBase {
    public function index() {
        ///return redirect(url("login/index"));
        //echo "hello-admin";
        return View::fetch();

    }

    public function welcome() {
        return View::fetch();
    }
}