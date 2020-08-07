<?php
/**
 * Api模块配置
 * User chenzhuo
 * Date 2020/8/7 10:21 下午
 * Description :
 */

return [
    //api跨域设置
    'cross_domain' => [
        //是否允许跨域
        'allow'  => true,
        //header设置
        'header' => [
            'Access-Control-Allow-Origin'    => '*',
            'Access-Control-Allow-Methods'   => '*',
            'Access-Control-Allow-Headers'   => 'content-type,token',
            'Access-Control-Request-Headers' => 'Origin, content-Type, Accept, token',
        ],

    ],
];