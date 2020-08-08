<?php
/**
 * Created by singwa
 * User: singwa
 * motto: 现在的努力是为了小时候吹过的牛逼！
 * Time: 07:40
 */
namespace app\admin\controller;

use think\captcha\facade\Captcha;

class Verify {

    public function index() {
        return Captcha::create("abc");
    }
}