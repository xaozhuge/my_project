<?php
$var_info = file_get_contents('.sensitive_var');
$var_list = explode(PHP_EOL, $var_info);
foreach ($var_list as $v) {
    $temp     = explode('=', $v);
    $var_map[$temp[0]] = $temp[1];
}
$db_host = isset($var_map['db_host']) ? $var_map['db_host'] : '';
$db_user = isset($var_map['db_user']) ? $var_map['db_user'] : '';
$db_pwd  = isset($var_map['db_pwd']) ? $var_map['db_pwd'] : '';
$db_port = isset($var_map['db_port']) ? $var_map['db_port'] : '';
$db_name = isset($var_map['db_name']) ? $var_map['db_name'] : '';

$config	=	 array(
    //数据库默认配置
    'db_type' => 'mysql',
    'db_host' => $db_host,
    'db_user' => $db_user,
    'db_pwd'  => $db_pwd,
    'db_port' => $db_port,
    'db_name' => $db_name,
    'db_charset' => 'utf8mb4',
);

return $config;