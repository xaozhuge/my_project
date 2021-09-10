<?php

namespace Home\Model;

class DateModel{
    protected $startMonday = '1';# 1表示周一为起始 0表示周日为起始

    /**
     * [getDateRange 返回日期内的所有日期]
     * @author zzz
     * @DateTime 2018-09-10T15:29:39+0800
     */
    public function getDateRange($start_date, $end_date){
        $range  = array();
        for ($i = 0; strtotime($start_date." + {$i} days") <= strtotime($end_date); $i++) { 
            $time    = strtotime($start_date." + {$i} days");
            $range[] = date('Y-m-d', $time);
        }
        return $range;
    }

    /**
     * [getNumDaysAfter 几天之后]
     * @author zzz
     * @DateTime 2021-09-11T00:58:45+0800
     */
    public function getNumDaysAfter($num, $basic_state = ''){
        if(empty($basic_state)) $basic_state = date('Y-m-d');
        return date('Y-m-d', strtotime("$basic_state +{$num} days"));
    }

}
