<?php
namespace app\controllers\manage\dir;

use app\components\DirFunc;
use yii\base\Action;
use app\models\Dir;

use Yii;

class DirAction extends Action{
    public function run(){
        if(Yii::$app->request->get('install')){
            $p = new Dir();
            $p->install();
            exit;
        }
        /*if(Yii::$app->request->get('handleIsLast')){
            DirFunc::handleIsLast();
            exit;
        }*/

        $this->controller->view->title = '板块目录 - 列表';

        $type_id = Yii::$app->request->get('type_id',false);  //板块

        $dir_id = Yii::$app->request->get('dir_id',false);  //目录

        $typeArr = DirFunc::getCatalogType(true); //板块ID数组

        $list = array();

        if($dir_id!==false && $dir_id>0){ //如果dir_id不为空，可根据dir_id获取type_id
            $curDir = Dir::find()->where(['id'=>$dir_id])->one();
            if($curDir){
                $type_id = $curDir->type;
            }
        }


        //if(in_array($type_id,$typeArr)){   //板块匹配
            $params['dirList'] = array();
            $params['dir_pid'] = array();
            /*if($dir_id!=false && $dir_id>0){ //如果dir_id>0 遍历获取他的所有父级下拉框列表
                $_parent = $parent;
                for($i=intval($parent->level+1);$i>1;$i--){

                    $children = Dir::model()->findByAttributes(array('p_id'=>$_parent->id));
                    if($_parent->is_leaf==0 && $children){
                        ${'dirList_'.$i} = $dir->getDropDownListOne($_parent->id,$type_id,true,false);
                        $params['dirList'][$i] = ${'dirList_'.$i};
                    }
                    if($_parent->id>0){
                        $params['dir_pid'][$i-1] = $_parent->id;
                    }
                    if($_parent->p_id>0){
                        $_parent = Dir::model()->findByPK($_parent->p_id);
                    }

                }

            }*/
            $dirList_1 = DirFunc::getDropDownList(0,false,false,1); //第一层目录
            var_dump($dirList_1);exit;

            $params['dirList'][1] = $dirList_1;


            asort($params['dirList'],SORT_NUMERIC);
            asort($params['dir_pid'],SORT_NUMERIC);

            $list = $dir->getListArr($dir_id,$type_id,true,true,true);
        //}
        exit;
        $p_id = (int)Yii::$app->request->get('p_id');

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


        if($curPos && $curPos->level==2){


            $list = PositionFunc::getListArr($p_id,true,true,false);
            //$where = ['p_id'=>$p_id];
        }
        //$list = Position::find()->where($where)->orderBy('ord desc,id desc')->limit(10)->all();

        $params['list'] = $list;
        $params['posList_1'] = $posList_1;
        $params['posList_2'] = $posList_2;
        $params['posLvl_1'] = $posLvl_1;
        $params['posLvl_2'] = $posLvl_2;


        return $this->controller->render('position/list',$params);
    }



}