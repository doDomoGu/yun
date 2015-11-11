<?php
namespace app\controllers\manage;

use app\components\PositionFunc;
use yii\base\Action;
use app\models\Position;

use Yii;

class PositionAction extends Action{
    public function run(){
        if(Yii::$app->request->get('install')){
            $p = new Position();
            $p->install();
            exit;
        }
        $p_id = (int)Yii::$app->request->get('p_id');

        $posList_1 = PositionFunc::getDropDownList(0,true,false,true,1);

        $posList_2 = [];


        $curPos = Position::find()->where(['id'=>$p_id,'status'=>1])->one();

        if($curPos){
            $parents = PositionFunc::getParents($p_id);
            $posLvl_1 = isset($parents[1])?$parents[1]:null;
            $posLvl_2 = isset($parents[2]) && $posLvl_1?$parents[2]:null;
            if($posLvl_1){
                $posList_2 = PositionFunc::getDropDownList($posLvl_1->id,true,false,true,1);
            }
        }else{
            $posLvl_1 = null;
            $posLvl_2 = null;
        }
        $this->controller->view->title = '职位/部门 - 列表';
        $list = Position::find()->orderBy('')->limit(10)->all();
        $params['list'] = $list;
        $params['posList_1'] = $posList_1;
        $params['posList_2'] = $posList_2;
        $params['posLvl_1'] = $posLvl_1;
        $params['posLvl_2'] = $posLvl_2;


        return $this->controller->render('position/list',$params);
    }
}