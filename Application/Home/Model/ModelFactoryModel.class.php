<?php
namespace Home\Model;
class ModelFactoryModel{
	protected static $models;

	/**
	 * 通过工厂创建model
	 */
	public static function createModelUseFactory($modelName){
		$model = null;
		$factorys = array(
			
		);
		if(isset($factorys[$modelName])){
			$model = call_user_func($factorys[$modelName]);
		}
		return $model;
	}

	/**
	 * 获取model
	 */
	public static function getModel($modelName){
		$modelName = ucfirst($modelName);
		// 通过工厂创建model
		$model     = static::createModelUseFactory($modelName);
		if($model == null){
			//正常创建
			$modelClass = 'Home\Model\\'.$modelName.'Model';
			if(class_exists($modelClass)){
				$model  = new $modelClass();
			}
		}

		// 通过表名创建
		if($model == null){
			$model = static::createModelByTable($modelName);
		}

		if($model == null){
			echo $modelClass.' is not find';exit;
		}
		static::$models[$modelName] = $model;
		return $model;
	}

	/**
	 * [createModelByTable 通过表名创建model]
	 * @author zzz
	 * @DateTime 2022-03-23T11:57:37+0800
	 */
	public static function createModelByTable($modelName){
		list($db, $table) = explode('.', $modelName);
		//如果$table为空
		if(empty($table)) return null;
		//如果数据库配置不为空
		if(!empty(C($db))) return new BModel($modelName); 
	}
	
}
