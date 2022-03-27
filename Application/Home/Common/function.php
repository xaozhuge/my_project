<?php

/**
 * [p 打印输出]
 * @author zzz
 * @DateTime 2020-05-21T17:17:58+0800
 */
function p($data){
    if($data === true){
        echo 'true';
    }elseif($data === false){
        echo 'false';
    }elseif($data === NULL){
        echo 'NULL';
    }elseif($data === ''){
        echo '空字符串';
    }else{
        echo print_r($data, true);
    }
    echo PHP_EOL;
    die;
}

function checkIsSet($info, $key){
    return isset($info[$key]) ? $info[$key] : '';
}

function dv($value,$toValue=''){
    return empty($value) ? $toValue : $value;
}

/**
 * [fillZero 补0]
 * @author zzz
 * @DateTime 2021-05-08T17:26:54+0800
 */
function fillZero($num, $lmit_length = 4){
    $num_length = strlen($num);
    $res = str_repeat(0, $lmit_length - $num_length). $num;
    return $res;
}

/**
 * [returnJson 返回json]
 * @author zzz
 * @DateTime 2021-12-22T18:14:37+0800
 */
function returnJson($list){
    return json_encode($list, JSON_UNESCAPED_UNICODE);
}

/**
 * [pp print para 打印参数]
 * @author zzz
 * @DateTime 2019-03-27T10:33:15+0800
 */
function pp(){
    print_r(func_get_args());die;
}

/**
 * [logs 输出日志]
 * @author zzz
 * @DateTime 2022-03-27T20:37:01+0800
 */
function logs($data, $name='log'){
    #1. 获取文件存储路径
    $dir_name = dirname($_SERVER['SCRIPT_FILENAME']);
    #2. 拼接输出内容
    $data = date('Y-m-d H:i:s').':'.$data."\n";
    #3. 文件名
    $file_name = $dir_name. '/'. $name. '-'. date('Y-m-d'). '.log';
    #4. 写入文件
    file_put_contents($file_name, $data, FILE_APPEND);
}

/**
 * [pr 输出到文件]
 * @author zzz
 * @DateTime 2022-03-27T19:51:53+0800
 */
function pr($data, $save_name = ''){
    #1. 获取文件存储路径
    $root      = $_SERVER['DOCUMENT_ROOT'];
    $root      = dirname($_SERVER['SCRIPT_FILENAME']);
    #2. 获取默认文件名
    $temp_name = explode('/', INTERFACE_NAME)[1];
    $save_name = dv($save_name, $temp_name);
    #3. 拼接绝对路径
    $file_name = $root. '/'. $save_name;
    $content   = print_r($data, true);
    file_put_contents($file_name, date('Y-m-d H:i:s'). "\n". $content. "\n", FILE_APPEND);
}
