<?php

$config	=	 array(
    //数据库默认配置
    'db_type' => 'mysql',
    'db_host' => C('DB_HOST'),
    'db_user' => C('DB_USER'),
    'db_pwd'  => C('DB_PWD'),
    'db_port' => C('DB_PORT'),
    'db_name' => C('DB_NAME'),
    'db_charset' => 'utf8mb4',

    //默认数据库
    'DEFAULT'=>array(
	    'db_type' => 'mysql',
	    'db_host' => C('DB_HOST'),
	    'db_user' => C('DB_USER'),
	    'db_pwd'  => C('DB_PWD'),
	    'db_port' => C('DB_PORT'),
	    'db_name' => C('DB_NAME'),
	    'db_charset' => 'utf8mb4',
    ),
);

return $config;
