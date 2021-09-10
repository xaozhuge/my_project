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
	 * [formatRemindContent 格式化提醒内容]
	 * @author zzz
	 * @DateTime 2021-09-11T01:06:43+0800
	 */
	public function formatRemindContent($remind_info){
		$content = $remind_info['solar_monthday']. ' / '. $remind_info['lunar_monthday']. "<br>";
		if(empty($remind_info['event'])) return '';
		foreach ($remind_info['event'] as $k=>$v) {
			$content.= ($k+1). '.'. $v. "<br>";
		}
		$content .= "<br>";
		$content .= "<br>";
		return $content;
	}

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
		$data = compact('solar_monthday', 'lunar_monthday', 'event');
		return $data;
	}

}
