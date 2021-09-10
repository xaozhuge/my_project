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

}


