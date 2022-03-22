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

}
