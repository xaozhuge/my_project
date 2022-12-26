<?php

$var_info = file_get_contents(PROJECT_PATH.'/.sensitive_var');
$var_list = explode(PHP_EOL, $var_info);
foreach ($var_list as $v) {
    $temp     = explode('=', $v);
    $var_map[$temp[0]] = $temp[1];
}

return array(

	'DB_HOST' => checkIsSet($var_map, 'db_host'),
	'DB_USER' => checkIsSet($var_map, 'db_user'),
	'DB_PWD' => checkIsSet($var_map, 'db_pwd'),
	'DB_PORT' => checkIsSet($var_map, 'db_port'),
	'DB_NAME' => checkIsSet($var_map, 'db_name'),
	'SMTPUSERMAIL' => checkIsSet($var_map, 'smtpusermail'),
	'SMTPPASS' => checkIsSet($var_map, 'smtppass'),
	'QYWECHAT_KEY' => checkIsSet($var_map, 'qywechat_key'),
	'MY_EAML' => checkIsSet($var_map, 'my_email'),
	
);
