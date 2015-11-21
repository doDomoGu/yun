<?php
namespace app\controllers\manage\position;

use app\components\PositionFunc;
use yii\base\Action;
use app\models\Position;

use Yii;

class PositionDirPermissionAction extends Action{
    public function run(){
        $this->controller->view->title = '目录权限 - 管理中心';

        $position_id = Yii::$app->request->get('position_id',false);

        $position = Position::find()->where(['id'=>$position_id,'is_leaf'=>1])->one();
        if($position){

        }else{
            Yii::$app->response->redirect('position')->send();
        }

        $params['position'] = $position;
        return $this->controller->render('position/dir_permission',$params);
    }
}