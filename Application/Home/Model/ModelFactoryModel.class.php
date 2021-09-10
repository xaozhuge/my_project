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

		if($model == null){
			echo $modelClass.' is not find';exit;
		}
		static::$models[$modelName] = $model;
		return $model;
	}
	
}