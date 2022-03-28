<?php
namespace Home\Controller;
/**
 * Created by sublime.
 * User: zzz
 * Date: 2022年03月23日11:43:31
 * desc: 同步脚本 SynScript
 */
class SynScriptController extends ScriptController {

    /**
     * [synTable 同步近5分钟内更新过的数据表]
     * @author zzz
     * @DateTime 2022-03-28T20:23:29+0800
     */
    public function synTable(){
        #1. 定义时间和数据库
        $limit_time = date('Y-m-d H:i:s', strtotime(" -60 minutes"));
        $database   = 'zzz';
        #2. 数据表列表
        $sql  = "select  `TABLE_NAME`  from `information_schema`.`TABLES` where `information_schema`.`TABLES`.`TABLE_SCHEMA` = '{$database}' ";
        $list = $this->getModel('ScriptLog')->query($sql);

        #3. 判断时间
        foreach ($list as  $v) {
            $table_name  = $v['table_name'];
            #获取同步表的最新时间
            $update_time = $this->getModel('DEFAULT.'. $table_name)
                ->order('update_time desc')
                ->getField('update_time');
            if($update_time < $limit_time){
                $this->output('数据不更新', $table_name, $update_time);
                continue;
            }

            #获取被同步表的最新时间
            $update_time_syn = $this->getModel('DEFAULT.'. $table_name)
                ->order('update_time desc')
                ->getField('update_time');
            if($update_time_syn == $update_time){
                $this->output('最新时间相同不更新', $table_name, $update_time);
                continue;
            }
            #4. 同步数据表
            exec("/bin/bash syncer_table.sh", $res);
            $this->output('数据更新', $table_name, $update_time, $update_time_syn, returnJson($res));
        }
        $this->scriptEnd();
    }



}



