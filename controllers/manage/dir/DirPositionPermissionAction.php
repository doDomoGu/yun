<?php
namespace app\controllers\manage\dir;

use app\components\DirFunc;
use app\components\PositionFunc;
use app\models\Position;
use yii\base\Action;
use app\models\Dir;
use yii\helpers\ArrayHelper;
use app\models\PositionDirPermission;
use Yii;

class DirPositionPermissionAction extends Action{
    public function run(){
        $this->controller->view->title = '板块目录 - 对应职位权限列表';

        $dir_id = Yii::$app->request->get('dir_id',false);  //目录 id

        $dir = Dir::find()->where(['id'=>$dir_id])->one();

        $list = PositionFunc::getListArr(0,true,true);
        $pmCheck = [];
        $pmList = PositionDirPermission::find()->where(['dir_id'=>$dir_id])->all();

        foreach($pmList as $pmOne){
            $pmCheck[$pmOne->position_id][$pmOne->type] = 1;
        }

        $params['dir'] = $dir;
        $params['list'] = $list;


        $params['pmCheck'] = $pmCheck;

        return $this->controller->render('dir/position_permission',$params);
    }





}