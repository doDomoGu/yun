<?php
namespace app\controllers\manage\position;

use app\components\PositionFunc;
use yii\base\Action;
use app\models\Position;
use app\models\Dir;

use Yii;

class PositionAction extends Action{
    public function run(){
       /* if(Yii::$app->request->get('install')){
            $p = new Position();
            $p->install();
            exit;
        }*/
//var_dump(PositionFunc::getIdByAlias('stjg'));exit;

        if(Yii::$app->request->get('get-num')){
            $dir = new Dir();
            foreach($dir->ytArr as $y){
                foreach($dir->localArr as $l){
                    $this->getNum($y,$l);
                }
            }
            exit;
        }



        if(Yii::$app->request->get('install2')){
            $p = new Position();
            $p->install2();
            Yii::$app->response->redirect('position')->send();
            exit;
        }

        if(Yii::$app->request->get('handle')){
            PositionFunc::handleIsLastAndIsLeaf();
            Yii::$app->response->redirect('position')->send();
            exit;
        }


        $this->controller->view->title = '职位/部门 - 列表';

        $p_id = Yii::$app->request->get('p_id',false);

        $posList_1 = PositionFunc::getDropDownList(0,true,false,1);

        $posList_2 = [];

        $list = [];

        $curPos = Position::find()->where(['id'=>$p_id,'status'=>1])->one();

        if($curPos){
            $parents = PositionFunc::getParents($p_id);
            $posLvl_1 = isset($parents[1])?$parents[1]:null;
            $posLvl_2 = isset($parents[2]) && $posLvl_1?$parents[2]:null;
            if($posLvl_1){
               $posList_2 = PositionFunc::getDropDownList($posLvl_1->id,true,false,1);
            }
        }else{
            $posLvl_1 = null;
            $posLvl_2 = null;
        }

        if($curPos){
            if($curPos->level==2){
                $list = PositionFunc::getListArr($p_id,true,true,true);
                //$where = ['p_id'=>$p_id];
            }else{
                $list = PositionFunc::getListArr($p_id,true,true,true,0);
            }
        }

        //$list = Position::find()->where($where)->orderBy('ord desc,id desc')->limit(10)->all();

        $params['list'] = $list;
        $params['posList_1'] = $posList_1;
        $params['posList_2'] = $posList_2;
        $params['posLvl_1'] = $posLvl_1;
        $params['posLvl_2'] = $posLvl_2;


        return $this->controller->render('position/list',$params);
    }

    public function getNum($yt,$local){
        $pos1 = Position::find()->where(['alias'=>$yt])->one();
        echo $yt;
        if($pos1){
            echo '('.$pos1->name.')';
            //业态的下面一层就是地方公司
            echo ' - '.$local;
            $pos2 = Position::find()->where(['alias'=>$local,'p_id'=>$pos1->id])->one();
            if($pos2){
                echo '('.$pos2->name.')';
                $pYtLocalArr = PositionFunc::getAllLeafChildrenIds($pos2->id);
                echo ' : '.count($pYtLocalArr);
            }
        }
        echo '<br/>';
    }
}