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

    /**
     * [getPosition 通过code码获取脚本执行位置]
     * @author zzz
     * @DateTime 2022-03-24T16:21:26+0800
     */
    public function getPosition($code){
        return $this->byCode($code)->getField('position');
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
