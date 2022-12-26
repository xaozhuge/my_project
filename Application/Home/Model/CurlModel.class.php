<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Home\Model;
/**
 * Created by sublime.
 * desc: curl功能 Curl
 */
class CurlModel{
    public $ch;
    public $result;
    public $errmsg = '';
    public function __construct() {
        $this->ch   =   curl_init();
        $this->timeout(2)->encoding('');
    }
    public function json_decode($obj= true){
        $res    =   $obj == false ? false : array();
        if(!empty($this->result)){
            $res    =   json_decode($this->result,$obj);
        }
        return $res;
    }

    public function xml(){
        if(empty($this->result)){
            return [];
        }
        return xmlToArray($this->result);
    }

    public function getXmlByPost($url,$post){
        return $this->postfields($post)->exec($url)->xml();
    }
    public function getJsonByGet($url){
        return $this->customrequest('GET')->getJson($url);
    }

    public function getJsonByPost($url,$post){
        return $this->postfields($post)->getJson($url);
    }

    /**
     * [getJsonByPostJson 发送json对象数据]
     * @DateTime 2021-06-16T14:27:51+0800
     */
    public function getJsonByPostJson($url, $post){
        $post   = json_encode($post);
        $header = array(
            'Content-Type: application/json',
            'Content-Length: '. strlen($post)
        );
        return $this->httpheader($header)->postfields($post)->getJson($url);
    }

    public function getJson($url){
        return $this->exec($url)->json_decode();
    }

    public function httpGet($url){
        return $this->customrequest('GET')->exec($url)->result();
    }

    public function httpPost($url,$post){
        return $this->postfields($post)->exec($url)->result();
    }

    public function error(){
        return curl_error($this->ch); 
    }
    public function errno(){
        return curl_errno($this->ch);
    }

    /**
     * [getErrmsg 获取此次curl失败的原因]
     * @DateTime 2022-03-02T10:12:04+0800
     */
    public function getErrmsg(){
        return $this->errmsg;
    }

    public function close(){
        curl_close($this->ch);
        return $this;
    }
    public function chInfo(){
        return curl_getinfo($this->ch);
    }

    public function exec($url){
        if(strpos($url,'https') !== false){
            $this->https();
        }
        $this->setopt(CURLOPT_URL, $url)
             ->setopt(CURLOPT_RETURNTRANSFER, 1);
        $this->result   =   curl_exec($this->ch);
        // 请求无响应发送警报邮件
        if($this->errno() != 0 ){
            $this->errmsg = $this->error();
            $message    =   "异常链接：{$url};\n error:".$this->error().";\n sys:".sysName().";\n interface:".INTERFACE_NAME.";\n post:".json_encode($_POST);
            logs($message,'curl');
        }
        $this->close();
        $this->ch   =   curl_init();
        return $this;
    }
    public function result(){
        return $this->result;
    }
    public function reset(){
        curl_reset($this->ch);
        return $this;
    }
    public function setopt($option,$value){
        curl_setopt($this->ch, $option, $value);
        return $this;
    }

    /**
     * 自定义请求方式
     * @DateTime 2020-05-21
     */
    public function customrequest($method){
        $this->setopt(CURLOPT_CUSTOMREQUEST,$method);
        return $this;
    }

    /**
     * 设置url重定向次数
     * @DateTime 2020-05-21
     */
    public function maxredirs($num){
        $this->setopt(CURLOPT_FOLLOWLOCATION,1);
        $this->setopt(CURLOPT_MAXREDIRS,$num);
        return $this;
    }
    /**
     * 设置请求超时时间
     * @DateTime 2020-05-21
     */
    public function timeout($num){
        $this->setopt(CURLOPT_TIMEOUT,$num);
        return $this;
    }

    /**
     * 指定coding
     * @DateTime 2020-05-21
     */
    public function encoding($opt){
        $this->setopt(CURLOPT_ENCODING,$opt);
        return $this;
    }

    /**
     * 指定http版本
     * @DateTime 2020-05-21
     */
    public function httpVersion($num){
        $this->setopt(CURLOPT_HTTP_VERSION,$num);
        return $this;
    }

    /**
     * 设定post
     * @DateTime 2020-05-21
     */
    public function postfields($v,$method='POST'){
        if(is_array($v)){
            $v  =   http_build_query($v);
        }
        $this->setopt(CURLOPT_POSTFIELDS,$v);
        $this->customrequest($method);
        return $this;
    }


    /**
     * 设置header
     * @DateTime 2020-05-21
     */
    public function httpheader($v){
        $this->setopt(CURLOPT_HTTPHEADER,$v);
        return $this;
    }


    public function connecttimeout($v){
        $this->setopt(CURLOPT_CONNECTTIMEOUT,$v);
        return $this;
    }

    public function sslcert($v){
        $this->setopt(CURLOPT_SSLCERT,$v);
        return $this;
    }
    
    public function sslkey($v){
        $this->setopt(CURLOPT_SSLKEY,$v);
        return $this;
    }

    public function https(){
        $this->setopt( CURLOPT_SSL_VERIFYPEER, FALSE);
        $this->setopt(CURLOPT_SSL_VERIFYHOST, FALSE);
    }
}
