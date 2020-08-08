<?php
/**
 * Created by singwa
 * User: singwa
 * motto: 现在的努力是为了小时候吹过的牛逼！
 * Time: 17:40
 */

namespace app\common\model\mysql;
use think\Model;

class GoodsSku extends BaseModel {

    public function goods() {
        return $this->hasOne(Goods::class, "id",  "goods_id");
    }

    public function getNormalByGoodsId($goodsId = 0) {
        $where = [
            "goods_id" => $goodsId,
            "status" => config("status.mysql.table_normal"),
        ];

        return $this->where($where)->select();
    }

    public function  incStock($id, $num) {
        return $this->where("id", "=", $id)
            ->inc("stock", $num)
            ->update();
    }
}