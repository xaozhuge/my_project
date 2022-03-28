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
        $limit_time = date('Y-m-d H:i:s', strtotime(" -5 minutes"));
        
    }



}



