<?php
/**
 * Created by singwa
 * User: singwa
 * motto: 现在的努力是为了小时候吹过的牛逼！
 * Time: 09:04
 */
declare (strict_types = 1);
namespace app\admin\middleware;

class Auth {

    public function handle($request, \Closure $next) {

        //dump($request->pathinfo());
        // 前置中间件
//        if(empty(session(config("admin.session_admin"))) && !preg_match("/login/", $request->pathinfo())) {
//            return redirect((string) url('login/index'));
//        }

        $response = $next($request);
        //if(empty(session(config("admin.session_admin"))) && $request->controller() != "Login") {
            /////return redirect((string) url('login/index'));
        //}

        return $response;
        // 后置中间件

    }

    /**
     * 中间件结束调度
     * @param \think\Response $response
     */
    public function end(\think\Response $response) {

    }
}