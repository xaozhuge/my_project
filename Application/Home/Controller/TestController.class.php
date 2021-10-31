<?php
namespace Home\Controller;
/**
 * TestController
 */
class TestController extends Controller {

	public function test(){
		$start_date = '2021-09-10';
		$end_date   = $this->getModel('Date')->getNumDaysAfter(30);
		$range_date = $this->getModel('Date')->getDateRange($start_date, $end_date);
		$content    = '';
		foreach ($range_date as $v) {
			$remind_info = $this->getModel('RemindDate')->getRemindByDate($v);
			$content    .= $this->getModel('RemindDate')->formatRemindContent($remind_info);
		}
		$title = $start_date. '到'. $end_date;
		$toemail = 'xaozhuge@163.com';
		$res = $this->getModel('Email')->sendEmail($toemail, $title, $content);
		p($res);
	}
}