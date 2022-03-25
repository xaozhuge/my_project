<?php
/**
 * Created by sublime.
 * User: zzz
 * Date: 2022年03月23日20:11:34
 * desc: 脚本进度Model ScriptLog
 */
namespace Home\Model;

class ScriptLogModel extends BModel{
    protected $trueTableName = 'DEFAULT.script_log';

    private $startId;//当前脚本起始ID
    private $endId;  //当前脚本截止ID

    /**
     * [getStartId 通过code码获取脚本执行位置 获取startId]
     * @author zzz
     * @DateTime 2022-03-24T16:21:26+0800
     */
    public function getStartId($code){
        $this->startId = $this->byCode($code)->getField('position');
        $this->startId = dv($this->startId, 0);
        return $this->startId;
    }

    /**
     * [updatePosition 更新脚本执行位置]
     * @author zzz
     * @DateTime 2022-03-24T17:33:12+0800
     */
    public function updatePosition($code, $position){
    	$info  = compact('code', 'position');
    	$count = $this->byCode($code)->count();
        if($count){
            return $this->byCode($code)->save($info);
        }else{
            return $this->add($info);
        }
    }

    /**
     * [getColumnRange 获取脚本 ID/update_time 取值范围]
     * @author zzz
     * @DateTime 2022-03-24T18:17:32+0800
     */
    public function getColumnRange($code, $model, $column, $step = 1){
        #2. 获取Model表最大ID
        $maxId = $model->max($column);
        #3. 判断最大ID和脚本位置
        if($maxId <= $this->startId) return false; 
        #4. 大于startId，按照column升序, 取step条
        $sql = $model->field($column)
        	->setWhere($column, array('gt', $this->startId))
        	->limit($step)
        	->order($column)
        	->buildSql();
        #5. 获取当前脚本的截止ID
        $this->endId = $model->table($sql. ' a')->max($column);
        #6. 判断截止ID是否存在
        if(empty($this->endId)) return false; 
        #7. 更新脚本执行位置
        $res = $this->updatePosition($code, $this->endId);
        #8. 返回startId、endId
        if($res !== false){
            return array($this->startId, $this->endId);
        }
    }

    /**
     * [restart 重新开始脚本进度记录]
     * @author zzz
     * @DateTime 2022-03-25T09:29:37+0800
     */
    public function restart($code){
        return $this->updatePosition($code, '');
    }

}


/**
CREATE TABLE `script_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `code` varchar(100) NOT NULL DEFAULT '' COMMENT '脚本code',
  `position` varchar(100) NOT NULL DEFAULT '' COMMENT '脚本执行到的位置',
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `IDX_CODE` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='脚本进度'
*/
