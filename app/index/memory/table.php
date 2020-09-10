<?php
/**
 * table.php
 * User chenzhuo
 * Date 2020/8/20 8:20 下午
 * Description :
 */

//创建内存表
$table = new swoole_table(1024);
//内存表增加一列
$table->column('id', $table::TYPE_INT,4);
$table->column('name', $table::TYPE_STRING,64);
$table->column('age', $table::TYPE_INT,4);
$table->create();

$table->set('calm',['id' => 1, 'name' => 'calm', 'age' => 25]);

$calm = $table->get('calm');
print_r($calm);

$table->incr('calm','age',2);
$calm = $table['calm'];

print_r($calm);



