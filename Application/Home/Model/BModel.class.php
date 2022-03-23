<?php
namespace Home\Model;
use Think\Model;
/**
 * 数据操作基类
 */
class BModel extends Model{

    /**
     * [__construct ]
     * name 数据表名
     * connection 数据库配置
     * @author zzz
     * @DateTime 2022-03-23T12:59:03+0800
     */
    public function __construct($name = '', $tablePrefix = '', $connection = ''){
        if(strpos($name,'.') != false){
            list($connection, $name) = explode('.', $name);  
        }
        parent::__construct($name, $tablePrefix, $connection);
    }

    /**
     * 获取model对象
     */
    public function getModel($modelName){
        $model = ModelFactoryModel::getModel($modelName);
        return $model;
    }

    /**
     * 魔术方法操作查询
     */
    public function __call($method, $args){
        $defaultMethod = [
	        'by'=>'eq', 'neq', 'gt', 'egt', 
	        'lt', 'elt', 'notlike', 'like'=>'like', 
	        'rlike'=>'like', 'llike'=>'like', 'notin', 'in',
	        'between','notbetween'
        ];

        // 数据查询魔术方法
        foreach ($defaultMethod as $key=>$value) {
            $expFlag    =   $value;
            if(!is_numeric($key)){
                $value  =   $key;
            }
            $key    =   strval($key);
            $isMethod    =   strpos($method,$value) === 0;
            if(in_array($value, array('gt','lt', 'egt', 'elt'))){
                $isNMethod   =   strpos($method,'n'.$value) === 0;
            }else{
                $isNMethod   =   strpos($method,'e'.$value) === 0;
            }

            if($isMethod || $isNMethod){
                $methodLen  =   strlen($value);
                if($isNMethod){
                    if($args[0] === '' || $args[0] === null || $args[0] === array()){
                        return $this;
                    }
                    $methodLen  +=  1;
                }

                // 处理like语句
                $likeRuleMap    =   ['rlike'=>'%s%%','llike'=>'%%%s','like'=>'%%%s%%'];
                if(strstr($key, 'like')){
                    if(empty($args[0])){
                        return $this;
                    }
                    $likeRule   =   $likeRuleMap[$key];
                    if(is_array($args[0])){
                        $args[0]    =   array_map(function($v) use($likeRule){
                            return vsprintf($likeRule, [$v]);
                        },$args[0]);
                    }else{
                        $args['0']  =   vsprintf($likeRule, $args['0']);
                    }
                }
                $alias =   isset($args[1]) && !empty($args[1]) ? $args[1].'.' : '';
                $name  =   $alias.parse_name(substr($method,$methodLen));
                $exp   =   array($expFlag,$args[0]);
                if(isset($this->options['where'][$name]) && isset($args[2]) && $args[2] == 'or'){
                    if(is_array($this->options['where'][$name][0])){
                        array_unshift($this->options['where'][$name],$exp);
                        $exp      =   $this->options['where'][$name];
                    }else{
                        $exp      =     [$this->options['where'][$name],$exp,'or',];
                    }

                }
                return $this->setWhere($name,$exp);
            }
        }
        return parent::__call($method,$args);
    }

    /**
     * 设置查询条件
     */
    public function setWhere($field, $value){
        if(strpos($field,'.') == false){
            $field  =   $this->ac($field);
        }
        $where[$field]  =   $value;
        return $this->where($where);
    }

    /**
     * 为字段添加表别名aliasColumn
     */
    protected function ac($column){
        return isset($this->options['alias']) && strpos($column,'.') === false ? $this->options['alias'].'.'.$column : $column;
    }

    /**
     * 拼装复杂查询or语句
     */
    public function _orComplex($key=[]){
        $where  =   $this->extractWhere($key);
        if(empty($where)){
            return $this;
        }
        $where['_logic']        =   'or';
        $complex['_complex']    =   $where;
        return $this->where($complex);
    }

    /**
     * 提取where条件
     */
    public function extractWhere($key){
        if(empty($key)){
            $where  =   $this->options['where'];
            unset($this->options['where']);
        }else{
            $where  = array_intersect_key($this->options['where'], array_flip($key));
            $this->options['where']     =   array_diff_key($this->options['where'],array_flip($key));
        }
        return $where;
    }

}
