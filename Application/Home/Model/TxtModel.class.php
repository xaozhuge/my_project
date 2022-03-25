<?php
namespace Home\Model;
/**
 * Created by sublime.
 * User: zzz
 * Date: 2022年03月25日18:04:16
 * desc: 数字处理 Txt
 */
class TxtModel{

    protected $map_character = array(
        '%0D' => '\r',
        '%0A' => '\n',//换行
        '%09' => '\t',
        '%20' => '\s',//空格
        '%E3%80%80' => '\m'
    );
    
    /**
     * [checkBlankCharacter 分析空白字符]
     * @author zzz
     * @DateTime 2022-03-25T18:13:45+0800
     */
    public function checkBlankCharacter($content){
        $content = rawurlencode($content);
        $content = str_replace(array_keys($this->map_character), array_values($this->map_character), $content);
        $content = rawurldecode($content);

        $pattern = '/(\\\[rntsm]){0,}\\\[rntsm]/';
        preg_match_all($pattern, $content, $preg_res);
        $preg_res = $preg_res[0];
        $res     = array_count_values($preg_res);
        p($res);
    }

}
