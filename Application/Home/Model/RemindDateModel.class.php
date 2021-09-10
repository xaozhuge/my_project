<?php
namespace Home\Model;
/**
 * Created by sublime.
 * User: zzz
 * Date: 2021年09月10日23:05:27
 * desc: 项目追踪数目 RemindDate
 */
class RemindDateModel extends BModel {
	protected $trueTableName    =   'remind_date';

	/**
	 * [getRemindByDate 根据日期查找提醒]
	 * @author zzz
	 * @DateTime 2021-09-11T00:40:52+0800
	 */
	public function getRemindByDate($solar_date){
		$solar_monthday = date('m-d', strtotime($solar_date));
		$common_day     = date('*d', strtotime($solar_date));
		$lunar_monthday = $this->getModel('SolarLunar')->getLunarMonthDay($solar_date);
		$event = $this->byLunarDate($lunar_monthday)
			->inSolarDate([$solar_monthday, $common_day])
			->_orComplex(['lunar_date', 'solar_date'])
			->getField('event', true);
		return $event;
	}

}
