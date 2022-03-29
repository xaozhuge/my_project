<?php
namespace Home\Model;
/**
 * Created by sublime.
 * User: zzz
 * Date: 2022年03月22日16:19:29
 * desc: 数字处理 Number
 */
class NumberModel{
    
    /**
     * [keepDecimal 保留小数，规则是 四舍五入]
     * num_digit 规定多少个小数
     * is_fix 是否固定位数
     * @author zzz
     * @DateTime 2022-03-22T16:29:31+0800
     */
    public function keepDecimal($num_value, $num_digit, $is_fix = 0){
        $num_value = number_format($num_value, $num_digit);
        $num_value = str_replace(',', '', $num_value);
        if(!$is_fix) $num_value = rtrim(rtrim($num_value, '0'), '.');
        return $num_value;
    }

    /**
     * [numToWord 数字转化成汉字]
     * @author zzz
     * @DateTime 2022-03-29T10:54:44+0800
     */
    public function numToWord($num){
        $map_digit_word = array(
            '', '十', '百', '千'
        );
        $num = strval($num);
        $num_length = strlen($num);
        $num_list = str_split($num, 1);
        $num_list = array_reverse($num_list);
        foreach ($num_list as $k => $v) {
            #1. 位数 
            $digit = $map_digit_word[$k];
            #2. 数字处理
            $v = $this->numToWordFormat($num_list, $k, $v);
            if($v == '零') $digit = '';//当前值为0 为啥为空
            #3. 数字和位数拼接
            $v = $v. $digit;
            $word_list[] = $v;
        }
        //处理 100、1000 最后的零
        foreach ($word_list as $k => &$v) {
            if($k == 0 && count($word_list) > 1){
                $word_list[$k-1] == '';
            }
            if($v == '零' && $word_list[$k-1] == '' && count($word_list) > 1){
                $v = '';
            }
        }
        $word_list = array_reverse($word_list);
        $res = implode('', $word_list);
        return $res;

    }

    /**
     * [numToWordFormat 将数字转化为汉字]
     * @author zzz
     * @DateTime 2022-03-29T10:54:44+0800
     */
    public function numToWordFormat($num_list, $k, $v){
        $map_num_word = array(
            '零', '一', '二', '三', '四', '五', '六', '七', '八', '九'
        );
        //特殊处理 11 为十一，而不是 一十一
        if($k == 1 && $v == 1 && count($num_list) == 2){
            $v = '';
        }else{
            $v = $map_num_word[$v];
        }
        return $v;
    }

}
