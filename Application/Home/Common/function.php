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