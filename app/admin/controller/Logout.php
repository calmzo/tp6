<?php
/**
 * Created by singwa
 * User: singwa
 * motto: 现在的努力是为了小时候吹过的牛逼！
 * Time: 13:37
 */
namespace  app\admin\controller;

class Logout extends AdminBase {

    public function index() {
        // 清楚session
        session(config("admin.session_admin"), null);
        // 执行跳转
        return redirect(url("login/index"));

    }
}