<?php
/**
 * Created by singwa
 * User: singwa
 * motto: 现在的努力是为了小时候吹过的牛逼！
 * Time: 07:09
 */
namespace app\common\service;

use app\common\model\mysql\Demo as DemoModel;
class Demo {

    /**
     * business 层通过getDemoDataByCategoryId来获取数据
     * @param $categoryId
     * @param int $limit
     * @return array
     */
    public function getDemoDataByCategoryId($categoryId, $limit = 10) {
        $model = new DemoModel();
        $results = $model->getDemoDataByCategoryId($categoryId, $limit);
        if(empty($results)) {
            return [];
        }
        $cagegorys = config("category");
        foreach($results as $key => $result) {
            $results[$key]['categoryName'] = $cagegorys[$result["category_id"]] ?? "其他";
            // isset($cagegorys[$result["category_id"]]) ? $cagegorys[$result["category_id"]] : "其他";
        }

        return $results;
    }
}