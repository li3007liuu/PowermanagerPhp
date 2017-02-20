<?php
/**
 * 请在下面放置任何您需要的应用配置
 */

return array(

    /**
     * 应用接口层的统一参数
     */
    'apiCommonRules' => array(
        //'sign' => array('name' => 'sign', 'require' => true),
		 //登录信息
        //'userId' => array(
        //    'name' => 'user_id', 'type' => 'int', 'default' => 0, 'require' => false,
        //),
        //'token' => array(
        //    'name' => 'token', 'type' => 'string', 'default' => '', 'require' => false,
        //),
    ),

    //Redis配置项
    'redis' => array(
        //Redis缓存配置项
        'servers'  => array(
            'host'   => '127.0.0.1',        //Redis服务器地址
            'port'   => '6379',             //Redis端口号
            'prefix' => 'developers_',      //Redis-key前缀
            'auth'   => '',                 //Redis链接密码
        ),
        // Redis分库对应关系
        'DB'       => array(
            'developers' => 1,
            'user'       => 2,
            'code'       => 3,
        ),
        //使用阻塞式读取队列时的等待时间单位/秒
        'blocking' => 5,
    ),

);
