<?php
namespace app\controllers\manage\position;

use app\components\PositionFunc;
use yii\base\Action;
use app\models\Position;

use Yii;

class PositionSelectAjaxAction extends Action{
    public function run(){
        $p_id = Yii::$app->request->get('p_id',0);

        $this->controller->layout = false;

        $parents = PositionFunc::getParents($p_id);

/*        foreach($parents as $p){
            echo $p->name,'<br/>';
        }
        exit;*/
        $posList = [];
        $selected = [];
        if(!empty($parents)){
            $p_id2 = 0;
            foreach($parents as $p){
                $posList[] = PositionFunc::getDropDownList($p_id2,true,false,1);
                $selected[] = $p->id;
                $p_id2 = $p->id;
            }
            $posList[] = PositionFunc::getDropDownList($p_id2,true,false,1);
        }else{
            $posList[] = PositionFunc::getDropDownList($p_id,true,false,1);
        }


       /* if(empty($posList)){
            yii::$app->end();
        }*/
        $params['posList'] = $posList;
        $params['selected'] = $selected;

        return $this->controller->render('_position2',$params);
    }
}