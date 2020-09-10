<?php
/**
 * Created by PhpStorm.
 * User: singwa
 * Date: 2019-11-26
 * Time: 07:51
 */
namespace app\common\model\mysql;

use think\Model;
class Demo extends Model {

    public function getDemoDataByCategoryId($categoryId, $limit = 10) {
        if(empty($categoryId)) {
            return [];
        }
        $results = $this->where("category_id", $categoryId)
            ->limit($limit)
            ->order("id", "desc")
            ->select()
            ->toArray();

        return $results;

    }
}