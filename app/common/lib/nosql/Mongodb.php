<?php
/**
 * Mongodb.php
 * User chenzhuo
 * Date 2020/9/9 4:41 下午
 * Description :
 */

namespace app\common\lib\nosql;
use think\facade\Db;
class Mongodb
{

    public $connection = null;

    /**
     * @var self
     */
    private static $self = null;


    /**
     * @return self
     */
    public static function getInstance()
    {
        if (self::$self == null) {
            self::$self = new self();
        }
        return self::$self;
    }


    public function __construct()
    {
        $this->connection = Db::connect("mongo");
    }

    // find查找
    public function find(string $table, $id){

        $res = $this->connection->table($table)->find($id);

        return $res;
    }


    public function findWhere(string $table, $where){

        $res = $this->connection->table($table)->where($where)->find();

        return $res;
    }


    //field 全部查询
    public function select(string $table, string $field){

        $res = $this->connection->table($table)->field($field)->paginate(1);

        return $res;
    }


    //分页
    public function paginate(string $table, string $field, int $page = 1, int $pageSize = 10){

        $res = $this->connection->table($table)->field($field)->paginate($pageSize, false, ['page' => $page]);
        return $res;
    }



    //添加
    public function insert(string $table, array $data){

        $res = $this->connection->table($table)->insert($data);

        return $res;
    }

    //修改
    public function update(string $table, array $where, array $data){

        $res = $this->connection->table($table)->where($where)->update($data);

        return $res;
    }



    // 阻止外部clone
    private function __clone()
    {

    }



}
