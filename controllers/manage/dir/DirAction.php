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
            Yii::$app->response->redirect('dir')->send();
            exit;
        }
        if(Yii::$app->request->get('handle')){
            DirFunc::handleIsLastAndIsLeaf();
            Yii::$app->response->redirect('dir')->send();
            exit;
        }

        $this->controller->view->title = '板块目录 - 列表';

        $dir_id = Yii::$app->request->get('dir_id',false);  //目录

        $dirList_1 = DirFunc::getDropDownList(0,true,false,1); //第一层目录

        $dirList_2 = [];

        $list = [];

        $curDir = Dir::find()->where(['id'=>$dir_id,'status'=>1])->one();

        if($curDir){
            $parents = DirFunc::getParents($dir_id);

            $dirLvl_1 = isset($parents[1])?$parents[1]:null;
            $dirLvl_2 = isset($parents[2]) && $dirLvl_1?$parents[2]:null;
            if($dirLvl_1){
                $dirList_2 = DirFunc::getDropDownList($dirLvl_1->id,true,false,1);
            }
        }else{
            $dirLvl_1 = null;
            $dirLvl_2 = null;
        }

        if($curDir){
            if($curDir->level==2){
                $list = DirFunc::getListArr($dir_id,true,true,true);
            }else{
                $list = DirFunc::getListArr($dir_id,true,true,true,0);
            }
        }

        $params['list'] = $list;
        $params['dirList_1'] = $dirList_1;
        $params['dirList_2'] = $dirList_2;
        $params['dirLvl_1'] = $dirLvl_1;
        $params['dirLvl_2'] = $dirLvl_2;


        return $this->controller->render('dir/list',$params);
    }



}