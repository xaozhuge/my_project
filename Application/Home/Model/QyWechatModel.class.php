<?php
namespace Home\Model;
/**
 * Created by sublime.
 * User: zzz
 * Date: 2021年06月16日11:30:58
 * desc: 企业维信API QyWechat
 */
class QyWechatModel extends BModel {

    public function __construct(){}

    /**
     * [sendWebhookText 发送Webhook应用消息]
     * @author zzz
     * @DateTime 2022-06-20T18:03:40+0800
     */
    public function sendWebhookText($key, $content){
        $msgtype = 'text';
        $mentioned_list = ["@all"];
        $text    = compact('content', 'mentioned_list');
        $url     = vsprintf(C('QYWECHAT_WEBHOOK_SEND'), [$key]);
        $post    = compact('msgtype', 'text');
        $result  = $this->curl()->getJsonByPostJson($url, $post);
        if($result['errmsg'] != 'ok'){
            logs(formatlog('sendWebhookText', returnJson($result)), 'qywechat_webhook');
        }
        return $result;
    }


    

    
}
