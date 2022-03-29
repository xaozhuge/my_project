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
        $map_num_word = array(
            '零', '一', '二', '三', '四', '五', '六', '七', '八', '九'
        );
        $map_digit_word = array(
            '', '十', '百', '千'
        );
        $num = strval($num);
        $num_length = strlen($num);
        $num_list = str_split($num, 1);
        $num_list = array_reverse($num_list);
        foreach ($num_list as $k => $v) {
            #1. 数字转化成汉字
            $v = $map_num_word[$v];
            #2. 位数 
            $digit = $map_digit_word[$k];
            #3. 数字和位数拼接
            $v = $v. $digit;
            $word_list[] = $v;
        }
        $word_list = array_reverse($word_list);
        $res = implode('', $word_list);
        return $res;

    }

}
