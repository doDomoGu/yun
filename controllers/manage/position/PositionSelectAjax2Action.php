<?php
namespace app\controllers\manage\position;

use app\components\PositionFunc;
use yii\base\Action;
use app\models\Position;

use Yii;

class PositionSelectAjax2Action extends Action{
    public function run(){
        $p_id = Yii::$app->request->get('p_id',0);
        $this->controller->layout = false;
        $posList = PositionFunc::getDropDownList($p_id,true,false,1);
        if(empty($posList)){
            yii::$app->end();
        }
        $params['list'] = $posList;

        return $this->controller->render('_position2',$params);
    }
}