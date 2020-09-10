<?php
/**
 * .php
 * User chenzhuo
 * Date 2020/8/31 3:26 下午
 * Description :
 */
namespace app\index\controller;

use app\common\lib\search\Es;
use Elasticsearch\ClientBuilder;
class Search
{




    public function index(){

        $Es = new Es();
        //创建表
//        $res = $Es->delete_index();
//        $params = [
//            'name' => [
//                'type' => 'keyword'
//            ],
//            'age' => [
//                'type' => 'integer'
//            ],
//            'mobile' => [
//                'type' => 'text'
//            ],
//            'email' => [
//                'type' => 'text'
//            ],
//            'birthday' => [
//                'type' => 'date'
//            ],
//            'address' => [
//                'type' => 'text'
//            ]
//        ];
//        $res = $Es->create_index('users', $params);
//        //新增
//        $data = [
//            'name' => '小陈',
//            'age' => 25,
//            'mobile' => 13153187435,
//            'email' => '178320938@qq.com',
//            'birthday' => '1995-02-20',
//            'address' => '临沂',
//        ];
//
//        $res = $Es->add_document(1, 'users', $data);


//        $params = [];
//        for($i = 0; $i<100; $i++){
//            $params['body'][] = array(
//                'index' => array(
//                    '_index' => 'users',
//                ),
//            );
//            $params['body'][] = [
//                'name' => '小'.$i,
//                'age' => rand(20,30),
//                'mobile' => '131'.mt_rand(1000,9999).mt_rand(1000,9999),
//                'email' => mt_rand(1000,9999).'@qq.com',
//                'birthday' => time(),
//                'address' => '临沂',
//            ];
//
//        }

//        $res = $Es->bulk($params);



        //修改
//        $res = $Es->updateById(1, 'users', ['mobile' => 13153187434]);

        //获取
//        $res = $Es->getById(1, 'users');
//        $res = $Es->search_doc('陈', 'users');
        $res = $Es->search_doc('小王', 'users');
        halt($res);

    }




}