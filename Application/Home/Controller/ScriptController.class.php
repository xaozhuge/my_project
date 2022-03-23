<?php
namespace Home\Controller;
/**
 * Created by sublime.
 * User: zzz
 * Date: 2022年03月22日16:19:29
 * desc: 脚本基类controller Script
 */
class ScriptController extends Controller {

    //起始ID/起始时间
    protected $startId;
    //终止ID/终止时间
    protected $endId;
    //脚本起始时间
    protected $startTime;
    //output输出次数
    protected $callNum = 0;

    public function __construct(){
        parent::__construct();
        $this->scriptStart();
    }

    public function scriptStart(){
        echo date('Y-m-d H:i:s')."\n";
        $this->startTime    =   microtime(true);
    }

    /**
     * [output 用于输出，参与计数]
     * @author zzz
     * @DateTime 2022-03-23T11:29:53+0800
     */
    public function output(){
        $this->callNum++;
        $param = func_get_args();
        echo implode('|', $param)."\n";
    }

    public function scriptEnd(){
        $time = microtime(true) - $this->startTime;
        $time = $this->getModel('Number')->keepDecimal($time, 4, 1);
        echo "ok start:{$this->startId}|end:{$this->endId}|{$time}|{$this->callNum}\n";
        exit();
    }

}
