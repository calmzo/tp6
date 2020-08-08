<?php
/**
 * Created by singwa
 * User: singwa
 * motto: 现在的努力是为了小时候吹过的牛逼！
 * Time: 07:49
 */
namespace app\common\model\mysql;


use think\Model;

class Category extends BaseModel {

    /**
     * @param string $field
     * @return \think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getNormalCategorys($field = "*") {
        $where = [
            "status" => config("status.mysql.table_normal"),
        ];

        $order = [
            "listorder" => "desc",
            "id" => "desc"
        ];
        $result = $this->where($where)
            ->field($field)
            ->order($order)
            ->select();

        return $result;
    }

    public function getLists($where, $num = 10) {

        $order = [
            "listorder" => "desc",
            "id" => "desc"
        ];
        $result = $this->where("status", "<>", config("status.mysql.table_delete"))
            ->where($where)
            ->order($order)
            ->paginate($num);
        //echo $this->getLastSql();exit;
        return $result;
    }

    /**
     * getChildCountInPids 带同学们解读
     * @param $condition
     * @return mixed
     */
    public function getChildCountInPids($condition) {
        $where[] = ["pid", "in", $condition['pid']];
        $where[] = ["status", "<>", config("status.mysql.table_delete")];
        $res = $this->where($where)
            ->field(["pid", "count(*) as count"])
            ->group("pid")
            ->select();
        //echo $this->getLastSql();exit;
        return $res;
    }

    /**
     * getNormalByPid
     * 根据pid获取正常的分类数据
     * 提前准备好的代码，带同学们解读下这块代码 @9-5
     *
     * @param integer $pid
     * @param [type] $field
     * @return void
     */
    public function getNormalByPid($pid = 0, $field) {
        $where = [
            "pid" => $pid,
            "status" => config("status.mysql.table_normal"),
        ];
        $order = [
            "listorder" => "desc", 
            "id" => "desc"
        ];

        $res = $this->where($where)
            ->field($field)
            ->order($order)
            ->select();
        return $res;
    }

}