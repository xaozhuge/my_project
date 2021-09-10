<?php
namespace Home\Model;
/**
 * Created by sublime.
 * User: zzz
 * Date: 2021年09月10日10:03:49
 * desc: 阳历、阴历 SolarLunar
 */
class SolarLunarModel{

    //最小年份
    protected $min_year   = 1891;

    //农历
    //array列表参数说明
    //  第一个参数代表 闰月 闰几月
    //  第二个参数代表 正月初一对应的阳历月份
    //  第三个参数代表 正月初一对应的阳历日期
    //  第四个参数代表 每个月有多少天
    protected $lunar_info = array(
        array(0, 2, 9, 21936), array(6, 1, 30, 9656), array(0, 2, 17, 9584), 
        array(0, 2, 6, 21168), array(5, 1, 26, 43344), array(0, 2, 13, 59728), 
        array(0, 2, 2, 27296), array(3, 1, 22, 44368), array(0, 2, 10, 43856), 
        array(8, 1, 30, 19304), array(0, 2, 19, 19168), array(0, 2, 8, 42352),
        array(5, 1, 29, 21096), array(0, 2, 16, 53856), array(0, 2, 4, 55632),
        array(4, 1, 25, 27304), array(0, 2, 13, 22176), array(0, 2, 2, 39632),
        array(2, 1, 22, 19176), array(0, 2, 10, 19168), array(6, 1, 30, 42200),
        array(0, 2, 18, 42192), array(0, 2, 6, 53840), array(5, 1, 26, 54568),
        array(0, 2, 14, 46400), array(0, 2, 3, 54944), array(2, 1, 23, 38608),
        array(0, 2, 11, 38320), array(7, 2, 1, 18872), array(0, 2, 20, 18800),
        array(0, 2, 8, 42160), array(5, 1, 28, 45656), array(0, 2, 16, 27216),
        array(0, 2, 5, 27968), array(4, 1, 24, 44456), array(0, 2, 13, 11104),
        array(0, 2, 2, 38256), array(2, 1, 23, 18808), array(0, 2, 10, 18800),
        array(6, 1, 30, 25776), array(0, 2, 17, 54432), array(0, 2, 6, 59984),
        array(5, 1, 26, 27976), array(0, 2, 14, 23248), array(0, 2, 4, 11104),
        array(3, 1, 24, 37744), array(0, 2, 11, 37600), array(7, 1, 31, 51560), 
        array(0, 2, 19, 51536), array(0, 2, 8, 54432), array(6, 1, 27, 55888), 
        array(0, 2, 15, 46416), array(0, 2, 5, 22176), array(4, 1, 25, 43736),
        array(0, 2, 13, 9680), array(0, 2, 2, 37584), array(2, 1, 22, 51544), 
        array(0, 2, 10, 43344), array(7, 1, 29, 46248), array(0, 2, 17, 27808),
        array(0, 2, 6, 46416), array(5, 1, 27, 21928), array(0, 2, 14, 19872), 
        array(0, 2, 3, 42416), array(3, 1, 24, 21176), array(0, 2, 12, 21168),
        array(8, 1, 31, 43344), array(0, 2, 18, 59728), array(0, 2, 8, 27296), 
        array(6, 1, 28, 44368), array(0, 2, 15, 43856), array(0, 2, 5, 19296),
        array(4, 1, 25, 42352), array(0, 2, 13, 42352), array(0, 2, 2, 21088), 
        array(3, 1, 21, 59696), array(0, 2, 9, 55632), array(7, 1, 30, 23208), 
        array(0, 2, 17, 22176), array(0, 2, 6, 38608), array(5, 1, 27, 19176), 
        array(0, 2, 15, 19152), array(0, 2, 3, 42192), array(4, 1, 23, 53864), 
        array(0, 2, 11, 53840), array(8, 1, 31, 54568), array(0, 2, 18, 46400), 
        array(0, 2, 7, 46752), array(6, 1, 28, 38608), array(0, 2, 16, 38320), 
        array(0, 2, 5, 18864), array(4, 1, 25, 42168), array(0, 2, 13, 42160), 
        array(10, 2, 2, 45656), array(0, 2, 20, 27216), array(0, 2, 9, 27968), 
        array(6, 1, 29, 44448), array(0, 2, 17, 43872), array(0, 2, 6, 38256), 
        array(5, 1, 27, 18808), array(0, 2, 15, 18800), array(0, 2, 4, 25776), 
        array(3, 1, 23, 27216), array(0, 2, 10, 59984), array(8, 1, 31, 27432), 
        array(0, 2, 19, 23232), array(0, 2, 7, 43872), array(5, 1, 28, 37736), 
        array(0, 2, 16, 37600), array(0, 2, 5, 51552), array(4, 1, 24, 54440), 
        array(0, 2, 12, 54432), array(0, 2, 1, 55888), array(2, 1, 22, 23208), 
        array(0, 2, 9, 22176), array(7, 1, 29, 43736), array(0, 2, 18, 9680), 
        array(0, 2, 7, 37584), array(5, 1, 26, 51544), array(0, 2, 14, 43344), 
        array(0, 2, 3, 46240), array(4, 1, 23, 46416), array(0, 2, 10, 44368), 
        array(9, 1, 31, 21928), array(0, 2, 19, 19360), array(0, 2, 8, 42416), 
        array(6, 1, 28, 21176), array(0, 2, 16, 21168), array(0, 2, 5, 43312), 
        array(4, 1, 25, 29864), array(0, 2, 12, 27296), array(0, 2, 1, 44368), 
        array(2, 1, 22, 19880), array(0, 2, 10, 19296), array(6, 1, 29, 42352), 
        array(0, 2, 17, 42208), array(0, 2, 6, 53856), array(5, 1, 26, 59696), 
        array(0, 2, 13, 54576), array(0, 2, 3, 23200), array(3, 1, 23, 27472), 
        array(0, 2, 11, 38608), array(11, 1, 31, 19176), array(0, 2, 19, 19152), 
        array(0, 2, 8, 42192), array(6, 1, 28, 53848), array(0, 2, 15, 53840), 
        array(0, 2, 4, 54560), array(5, 1, 24, 55968), array(0, 2, 12, 46496), 
        array(0, 2, 1, 22224), array(2, 1, 22, 19160), array(0, 2, 10, 18864), 
        array(7, 1, 30, 42168), array(0, 2, 17, 42160), array(0, 2, 6, 43600),
        array(5, 1, 26, 46376), array(0, 2, 14, 27936), array(0, 2, 2, 44448), 
        array(3, 1, 23, 21936), array(0, 2, 11, 37744), array(8, 2, 1, 18808), 
        array(0, 2, 19, 18800), array(0, 2, 8, 25776), array(6, 1, 28, 27216), 
        array(0, 2, 15, 59984), array(0, 2, 4, 27424), array(4, 1, 24, 43872), 
        array(0, 2, 12, 43744), array(0, 2, 2, 37600), array(3, 1, 21, 51568), 
        array(0, 2, 9, 51552), array(7, 1, 29, 54440), array(0, 2, 17, 54432), 
        array(0, 2, 5, 55888), array(5, 1, 26, 23208), array(0, 2, 14, 22176), 
        array(0, 2, 3, 42704), array(4, 1, 23, 21224), array(0, 2, 11, 21200), 
        array(8, 1, 31, 43352), array(0, 2, 19, 43344), array(0, 2, 7, 46240), 
        array(6, 1, 27, 46416), array(0, 2, 15, 44368), array(0, 2, 5, 21920), 
        array(4, 1, 24, 42448), array(0, 2, 12, 42416), array(0, 2, 2, 21168), 
        array(3, 1, 22, 43320), array(0, 2, 9, 26928), array(7, 1, 29, 29336), 
        array(0, 2, 17, 27296), array(0, 2, 6, 44368), array(5, 1, 26, 19880), 
        array(0, 2, 14, 19296), array(0, 2, 3, 42352), array(4, 1, 24, 21104), 
        array(0, 2, 10, 53856), array(8, 1, 30, 59696), array(0, 2, 18, 54560), 
        array(0, 2, 7, 55968), array(6, 1, 27, 27472), array(0, 2, 15, 22224), 
        array(0, 2, 5, 19168), array(4, 1, 25, 42216), array(0, 2, 12, 42192), 
        array(0, 2, 1, 53584), array(2, 1, 21, 55592), array(0, 2, 9, 54560)
    );


    /**
     * [getDaysBetweenSolar 计算2个阳历日期之间的天数]
     * lunar_month 阴历正月对应的阳历月份
     * lunar_day 阴历初一对应的阳历天数
     * @author zzz
     * @DateTime 2021-09-10T10:33:33+0800
     */
    public function getDaysBetweenSolar($solar_year, $solar_month, $solar_day, $lunar_month, $lunar_day){
        #阳历时间戳
        $solar_time = strtotime($solar_year. '-'. $solar_month. '-'. $solar_day);
        #正月初一对应阳历时间戳
        $lunar_time = strtotime($solar_year. '-'. $lunar_month. '-'. $lunar_day);
        $diff_day   = ceil(($solar_time - $lunar_time)/3600/24);
        return $diff_day;
    }

    /**
     * [getLunarMonths 获取阴历每月的天数的数组]
     * @author zzz
     * @DateTime 2021-09-10T11:16:19+0800
     */
    public function getLunarMonths($lunar_year) {
        $year_data  = $this->lunar_info[$lunar_year - $this->min_year];
        $month_data = array();
        #闰月
        $leap_month = $year_data[0];

        #十进制转化为二进制
        $bit        = decbin($year_data[3]);
        $bit_array  = str_split($bit);

        for ($k=0, $klen = 16 - count($bit_array); $k < $klen; $k++) { 
            array_unshift($bit_array, '0');
        }
        # 闰月截取十三位
        $bit_array = array_slice($bit_array, 0, ($leap_month == 0 ? 12 : 13));
        # 生成每月天数
        foreach ($bit_array as $v) {
            $v = $v + 29;
            $month_data[] = $v;
        }
        return $month_data;
    }

    /**
     * [getLunarYearMonths 获取阴历月份]
     * @author zzz
     * @DateTime 2021-09-10T11:07:00+0800
     */
    public function getLunarYearMonths($lunar_year){
        $sum        = 0;
        $res        = array();
        $month_data = $this->getLunarMonths($lunar_year);
        foreach ($month_data as $v) {
            $sum += $v;
            $res[] = $sum;
        }
        return $res;
    }

    /**
     * [getLeapMonth 获取闰月]
     * @author zzz
     * @DateTime 2021-09-10T11:47:36+0800
     */
    public function getLeapMonth($lunar_year) {
        $year_data = $this->lunar_info[$lunar_year - $this->min_year];
        return $year_data[0];
    }

    /**
    * 获取农历每年的天数
    * @param year 农历年份
    */
    public function getLunarYearDays($lunar_year) {
        $year_data   = $this->lunar_info[$lunar_year - $this->min_year];
        $month_array = $this->getLunarYearMonths($lunar_year);
        $len         = count($month_array);
        return ($month_array[$len - 1] == 0 ? $month_array[$len-2] : $month_array[$len-1]);
    }

    /**
     * [getCapitalNum 获取数字的阴历叫法]
     * @author zzz
     * @DateTime 2021-09-10T14:15:45+0800
     */
    public function getCapitalNum($num, $is_month){
        $is_month   = $is_month || false;
        $date_hash  = array(
            '0' => '', '1' => '一', '2' => '二', '3' => '三', 
            '4' => '四', '5' => '五', '6' => '六', '7'=>'七', 
            '8' => '八', '9' => '九', '10' => '十'
        );
        $month_hash = array(
            '0'  => '',     '1' => '正月', '2' => '二月', '3'   => '三月',  '4' => '四月',
             '5' => '五月', '6'  => '六月', '7' => '七月', '8'   => '八月', 
             '9' => '九月', '10' => '十月', '11' => '冬月', '12' => '腊月'
        );
        if($is_month){
            $res = $month_hash[$num];
        }else{
            if($num <= 10){
                $res = '初'. $date_hash[$num];
            }elseif($num > 10 && $num < 20){
                $res = '十'. $date_hash[$num - 10];
            }elseif($num == 20){
                $res = "二十";
            }elseif($num > 20 && $num < 30){
                $res = "廿". $date_hash[$num - 20];
            }elseif($num==30){
                $res = "三十";
            }
        }
        return $res;
    }

    /**
     * [getLunarByBetween 根据距离正月初一的天数计算阴历日期]
     * @author zzz
     * @DateTime 2021-09-10T10:45:40+0800
     */
    public function getLunarByDiffDay($solar_year, $diff_day) {
        $lunar_info = array();
        $lunar_year = $diff_day >= 0 ? $solar_year : ($solar_year - 1);
        if($diff_day == 0){
            $lunar_month = '正月';
            $lunar_day   = '初一';
        }else{
            $year_month = $this->getLunarYearMonths($lunar_year);
            $leap_month = $this->getLeapMonth($lunar_year);
            $diff_day   = $diff_day > 0 ? $diff_day : ($this->getLunarYearDays($lunar_year) + $diff_day);
            for($i = 0; $i < 13; $i++) {
                if($diff_day == $year_month[$i]) {
                    $month_num = $i + 2;
                    $day_num   = 1;
                    break;
                }elseif($diff_day < $year_month[$i]) {
                    //第几个月
                    $month_num      = $i + 1;
                    //截止到上个月多少天
                    $last_month_day = $year_month[$i - 1];
                    $last_month_day = dv($last_month_day, 0);
                    //距离当前月一号多少天
                    $day_num        = $diff_day - $last_month_day + 1;
                    break;
                }
            }

            if($leap_month != 0 && $month_num == $leap_month + 1){
                $lunar_month = ('闰'. $this->getCapitalNum($month_num - 1,true));
            }else{
                $month_num   = ($leap_month != 0 && $leap_month + 1 < $month_num ) ? ($month_num-1) : $month_num;
                $lunar_month = $this->getCapitalNum($month_num, true);
            }
            $lunar_day   = $this->getCapitalNum($day_num, false);

        }

        // 天干地支
        $lunar_year_name = $this->getLunarYearName($lunar_year);
        // 12生肖
        $zodiac     = $this->getYearZodiac($lunar_year);
        // 闰几月
        $lunar_info = compact('leap_month', 'zodiac', 'lunar_year_name', 'lunar_year', 'lunar_month', 'lunar_day', 'lunar_format');
        return $lunar_info;
    }

    /**
     * [getLunarYearName 获取干支纪年]
     * @author zzz
     * @DateTime 2021-09-10T13:53:55+0800
     */
    public function getLunarYearName($lunar_year) {
        $sky   = array('庚', '辛', '壬', '癸', '甲', '乙', '丙', '丁', '戊', '己');
        $earth = array('申', '酉', '戌', '亥', '子', '丑', '寅', '卯', '辰', '巳', '午', '未');
        $lunar_year  = $lunar_year. '';
        return $sky[$lunar_year{3}]. $earth[$lunar_year % 12];
    }

    /**
     * [getYearZodiac 根据阴历年获取生肖]
     * @author zzz
     * @DateTime 2021-09-10T13:50:06+0800
     */
    public function getYearZodiac($lunar_year){
        $zodiac = array('猴', '鸡', '狗', '猪', '鼠', '牛', '虎', '兔', '龙', '蛇', '马', '羊');
        return $zodiac[$lunar_year % 12];
    }

    /**
     * [convertSolarToLunar 阳历转化为农历（阴历）]
     * @author zzz
     * @DateTime 2021-09-10T10:14:36+0800
     */
    public function convertSolarToLunar($solar_date){
        $solar_time  = strtotime($solar_date);
        $solar_year  = date('Y', $solar_time);
        $solar_month = date('n', $solar_time);
        $solar_day   = date('j', $solar_time);
        #根据年份获取当前阴历正月初一 对应的 阳历日期
        $year_data   = $this->lunar_info[$solar_year - $this->min_year];
        #计算2个阳历日期之间的天数
        $diff_day   = $this->getDaysBetweenSolar($solar_year, $solar_month, $solar_day, $year_data[1], $year_data[2]);
        #获取阴历信息
        $lunar_info = $this->getLunarByDiffDay($solar_year, $diff_day);
        return $lunar_info;
    }
}