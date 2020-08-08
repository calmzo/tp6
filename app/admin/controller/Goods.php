<?php
/**
 * 9-3 提前准备好的部分代码，带小伙伴解读下。
 * 商品管理
 * User: singwa
 * motto: 现在的努力是为了小时候吹过的牛逼！
 * Time: 07:25
 */

namespace app\admin\controller;
use app\common\business\Goods as GoodsBis;
class Goods extends AdminBase {
    public function index() {
        $data = [];
        $title = input("param.title", "", "trim");
        $time = input("param.time", "", "trim");

        if(!empty($title)) {
            $data['title'] = $title;
        }
        if(!empty($time)) {
            $data['create_time'] = explode(" - ", $time);
        }

        $goods = (new GoodsBis())->getLists($data, 5);
        return view("", [
            "goods" => $goods,
        ]);
    }

    public function add() {
        return view();
    }

    /**
     * 新增逻辑 - 老师提前准备好的代码 带领小伙伴解读下这块内容
     * @return \think\response\Json
     */
    public function save() {
        // 判断是否为post请求， 也可以通过在路由中做配置支持post即可，方法有很多就看同学们喜欢哪个。。。
        if(!$this->request->isPost()) {
            return show(config('status.error'), "参数不合法");
        }
        // 预留作业1：请大家仿照老师之前讲解的validate验证机制自行验证参数, 并且严格判断数据类型。
        $data = input("param.");
        $check = $this->request->checkToken('__token__');
        if(!$check) {
            return show(config('status.error'), "非法请求");
        }
        // 数据处理 = > 基于 我们得验证成功之后
        $data['category_path_id'] = $data['category_id'];
        $result = explode(",", $data['category_path_id']);
        $data['category_id'] = end($result);

        $res = (new GoodsBis())->insertData($data);
        if(!$res) {
            return show(config('status.error'), "商品新增失败");
        }

        return show(config('status.success'), "商品新增成功");
    }

}