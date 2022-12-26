<?php
namespace Home\Controller;
/**
 * TestController
 */
class TestController extends Controller {

	public function test(){
		$start_date = date('Y-m-d');
		$end_date   = $this->getModel('Date')->getNumDaysAfter(7);
		$range_date = $this->getModel('Date')->getDateRange($start_date, $end_date);
		$content    = '';
		foreach ($range_date as $v) {
			$remind_info = $this->getModel('RemindDate')->getRemindByDate($v);
			$content    .= $this->getModel('RemindDate')->formatRemindContent($remind_info);
		}
		$title = $start_date. '到'. $end_date;
		$content_qy = str_replace('<br>', "\n", $content);
		$res = $this->getModel('QyWechat')->sendWebhookText(C('QYWECHAT_KEY'), $content_qy);
		p($res);

		$res = $this->getModel('Email')->sendEmail($toemail, $title, $content);
		p($res);
	}
}