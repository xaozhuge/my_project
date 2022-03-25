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
    //最大ID/最大时间
    protected $maxId;
    //日志信息
    protected $scriptMsg = 'success';
    //脚本起始时间
    protected $startTime;
    //output输出次数
    protected $callNum = 0;

    public function __construct(){
        parent::__construct();
        #1. 检查脚本进度表是否存在
        $this->checkTableExist('script_log');
        $this->scriptName = INTERFACE_NAME;
        $this->scriptStart();

    }

    /**
     * [getScriptListByColumn 获取脚本进程Model]
     * @author zzz
     * @DateTime 2022-03-25T13:40:42+0800
     */
    public function getScriptListByColumn($modelName, $column, $step = 100, $reset = false) {
        #1. 获取起始 startId
        $this->startId = $this->getModel('ScriptLog')->getStartId($this->scriptName);
        #2. 获取终止 endId
        $this->endId   = $this->getModel('ScriptLog')->getEndId($this->getModel($modelName), $column, $step);
        #3. 获取最大 maxId
        $this->maxId   = $this->getModel('ScriptLog')->getMaxId($this->getModel($modelName), $column);

        #4. 如果终止ID为0,看是否重头开始
        if (!$this->endId) {
            if ($reset) {
                $this->getModel('scriptLog')->updatePosition($this->scriptName, '');
                $this->scriptMsg = '重新开始脚本进度记录';
            }else{
                $this->scriptMsg = '脚本已更新到最新';
            }
            $this->scriptEnd();
        }

        #5. 更新脚本执行位置
        $this->getModel('scriptLog')->updatePosition($this->scriptName, $this->endId);

        if(empty($this->startId)){
            #1. 起始ID为0时，
            $where['_string'] = "{$column} <= '{$this->endId}' ";
        }else{
            #2. 起始ID有值时
            $where['_string'] = "{$column} > '{$this->startId}' and {$column} <= '{$this->endId}' ";
        }

        $model = $this->getModel($modelName)->where($where);
        return $model;
    }

    public function scriptStart(){
        echo date('Y-m-d H:i:s')."\n";
        $this->startTime = microtime(true);
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
        echo "ok startId:{$this->startId}|endId:{$this->endId}|maxId:{$this->maxId}|{$time}|{$this->callNum}|{$this->scriptMsg}\n";
        exit();
    }

}
