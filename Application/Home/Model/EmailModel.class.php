<?php
namespace Home\Model;
use Org\Util\Smtp;
/**
 * Created by sublime.
 * User: zzz
 * Date: 2021年09月10日16:29:17
 * desc: 发送邮件 Email
 */
class EmailModel extends BModel{
    //SMTP服务器
    protected $smtpserver     =  "smtp.163.com";
    //SMTP服务器端口
    protected $smtpserverport = 25;
    //SMTP服务器的用户邮箱,需要自己配置
    protected $smtpusermail   = "";
    //SMTP服务器的用户密码,需要自己配置
    protected $smtppass       = "";

	public function __construct(){
        $this->smtpusermail = C('SMTPUSERMAIL');
        $this->smtppass     = C('SMTPPASS');
    }

    /**
     * [sendEmail 发送邮件]
     * @author zzz
     * @DateTime 2021-09-10T16:33:16+0800
     */
    public function sendEmail($toemail, $title, $content){
        //邮件内容
        $mailcontent = "<p>". $content. "</p>";
        //邮件格式（HTML/TXT）,TXT为文本邮件
        $mailtype    = "HTML";
        //这里面的一个true是表示使用身份验证,否则不使用身份验证.
        $smtp        = new Smtp($this->smtpserver, $this->smtpserverport, true, $this->smtpusermail, $this->smtppass);
        //是否显示发送的调试信息
        $smtp->debug = false;
        $status      = $smtp->sendmail($toemail, $this->smtpusermail, $title, $mailcontent, $mailtype);
        return $status;
    }
}