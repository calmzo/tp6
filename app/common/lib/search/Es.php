<?php
/**
 * Es.php
 * User chenzhuo
 * Date 2020/8/31 3:34 下午
 * Description :
 */
namespace app\common\lib\search;


use Elasticsearch\ClientBuilder;
class Es
{
    private $client;
    public function __construct()
    {
        $hosts = ['120.53.21.205:9200'];
        $this->client = ClientBuilder::create()->setHosts($hosts)->build();
    }


    /**
     * 创建表
     * User: chenzhuo
     * Date: 2020/8/31 4:19 下午
     */
    public function create_index($table, $params)
    {
        $params = [
            'index' => $table,
            'body' => [
                'settings' => [
                    'number_of_shards' => 1,//当前只有一台ES，1就可以了
                    'number_of_replicas' => 0//副本0，因为只有一台ES
                ],
                'mappings' => [
                    '_source' => [
                        'enabled' => true
                    ],
                    'properties' => $params
                ]
            ]
        ];


        return $this->client->indices()->create($params);
    }




    /**
     * 删除表
     * User: chenzhuo
     * Date: 2020/8/31 4:20 下午
     */
    public function delete_index()
    {
        $deleteParams['index'] = $this->indexData['index'];
        $this->client->indices()->delete($deleteParams);
    }


    /**
     * index/type/id 方式请求一个文档信息
     * @param $id
     * @param $table
     * @return array|callable
     * User: chenzhuo
     * Date: 2020/8/31 7:51 下午
     */
    public function getById($id, $table){

        $params = [
            'index' => $table,
            'id'    => $id
        ];
        $response = $this->client->get($params);

        return $response;
    }


    /**
     * 更改现存字段，或添加新字段
     * @param $id
     * @param $table
     * @param $data
     * @return array|callable
     * User: chenzhuo
     * Date: 2020/8/31 7:53 下午
     */
    public function updateById($id, $table, $data){
        $params = [
            'index' => $table,
            'id'    => $id,
            'body'  => [
                'doc' => $data
            ]
        ];
        $response = $this->client->update($params);
        return $response;
    }


    /**
     * 通过指定文档的 /index/type/id 删除文档：
     * @param $id
     * @param $table
     * @return array|callable
     * User: chenzhuo
     * Date: 2020/8/31 7:51 下午
     */
    public function delById($id, $table){
        $params = [
            'index' => $table,
            'id'    => $id,
        ];
        $response = $this->client->delete($params);
        return $response;
    }




    //插入索引数据
    public function add_document($id, $table, $data)
    {
        $params = [
            'index' => $table,
            'id' => $id,
            'body' => $data
        ];

        $ret = $this->client->index($params);
    }


    public function bulk($params){
        $ret = $this->client->bulk($params);
        return $ret;
    }



    /**
     * 删除文档
     * @param $id 文档id
     * @return array|callable
     * User: chenzhuo
     * Date: 2020/8/31 4:13 下午
     */
    public function delete_document($id)
    {
        $deleteParams = array();
        $deleteParams['index'] = $this->indexData['index'];
        $deleteParams['type'] = $this->indexData['type'];
        $deleteParams['id'] = $id;
        $retDelete = $this->client->delete($deleteParams);
        return $retDelete;
    }

//
    public function search_doc($keywords = "",$tablle = "users",$from = 0,$size = 100) {

        $index['index'] = $tablle; //索引名称
        $index['body']['query']['range'] = array(
            'age' => array('gte' => 25,'lt' => 30),
        );
//        $index['body']['query']['match']['name'] = $keywords;
        $index['size'] = $size;
        $index['from'] = $from;

        $res = $this->client->search($index);
        return $res;
    }


//    public function search($keywords, $table){
//
//        $params = [
//            'index' => $table,
//        ];
//        $params['body']['query']['match']['content'] = $keywords;
//        $res = $this->client->search($params);
//        return $res;
//
//    }



}