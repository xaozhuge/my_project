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
 * [pp print para 打印参数]
 * @author zzz
 * @DateTime 2019-03-27T10:33:15+0800
 */
function pp(){
    print_r(func_get_args());die;
}