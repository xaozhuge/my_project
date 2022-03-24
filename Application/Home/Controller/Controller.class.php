<?php
namespace Home\Controller;
use Think\Controller as ThinkController;
use Home\Model\ModelFactoryModel;
/**
 * 公用controller
 */
class Controller extends ThinkController{

    /**
     * 获取model对象
     */
    public function getModel($modelName){
        $model = ModelFactoryModel::getModel($modelName);
        return $model;
    }

    /**
     * [checkTableExist 校验数据表是否存在]
     * @author zzz
     * @DateTime 2022-03-24T11:02:34+0800
     */
    public function checkTableExist($table_name, $connection = ''){
    	#1. 变量初始化
		$connection = dv(C('DEFAULT'));
		$sql_temp   = "show tables like '%s';";
    	#2. M方法获取数据库实例
		$model      = M('', '', $connection);
    	#3. 查询语句
    	$sql   = vsprintf($sql_temp, array($table_name));
    	#4. 判断数据表是否存在
    	$exist = $model->query($sql);
    	if(empty($exist)){
    		exit("数据表-{$table_name}，不存在");
    	}

    }

}



