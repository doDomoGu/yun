<?php
namespace app\controllers\manage\group;

use app\components\PositionFunc;
use app\components\DirFunc;
use app\models\Group;
use app\models\GroupDirPermission;
use yii\base\Action;
use app\models\Dir;
use Yii;

class GroupDirPermissionAction extends Action{
    public function run(){
        $this->controller->view->title = '群组目录权限设置 - 管理中心';

        $group_id = Yii::$app->request->get('id',false);

        $group = Group::find()->where(['id'=>$group_id])->one();
        if($group){
            $pmPost = Yii::$app->request->post('pm');
            if(!empty($pmPost))
                $this->updatePermission($group->id,$pmPost);

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
            $pmCheck = [];
            $pmDirIds = [];
            foreach($list as $l){
                if($l->is_leaf ==1){
                    $pmDirIds[] = $l->id;
                }
            }
            $pmList = GroupDirPermission::find()->where(['group_id'=>$group->id])->andWhere(['in','dir_id',$pmDirIds])->all();

            foreach($pmList as $pmOne){
                $pmCheck[$pmOne->dir_id][$pmOne->type] = 1;
            }

            $params['list'] = $list;
            $params['pmCheck'] = $pmCheck;

            $params['dirList_1'] = $dirList_1;
            $params['dirList_2'] = $dirList_2;
            $params['dirLvl_1'] = $dirLvl_1;
            $params['dirLvl_2'] = $dirLvl_2;

            $params['group'] = $group;
            return $this->controller->render('group/dir_permission',$params);
        }else{
            Yii::$app->response->redirect('group')->send();
        }
    }

    public function updatePermission($group_id,$pm){
        foreach($pm as $k=>$p){

            $typeAll = [11,12,21,/*22,*//*31,*/32];
            GroupDirPermission::deleteAll(['group_id'=>$group_id,'dir_id'=>$k]);
            $typeArr = [];
            /*if(isset($p['all'])){
                $typeArr = $typeAll;
            }else{*/
            if(!empty($p)){
                foreach($p as $k2=>$a){
                    if(in_array($k2,$typeAll)){
                        $typeArr[] = $k2;
                    }
                }
            }

            /*}*/
            if(!empty($typeArr)){
                foreach($typeArr as $t){
                    $row = new GroupDirPermission();
                    $row->group_id = $group_id;
                    $row->dir_id = $k;
                    $row->type = $t;
                    $row->save();
                }
            }
        }
    }





}