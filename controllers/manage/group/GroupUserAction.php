<?php
namespace app\controllers\manage\group;

use app\components\DirFunc;
use app\components\PositionFunc;
use app\models\Group;
use app\models\GroupUser;
use app\models\Position;
use app\models\User;
use yii\base\Action;
use app\models\Dir;
use yii\helpers\ArrayHelper;
use Yii;

class GroupUserAction extends Action{
    public function run(){
        $group_id = Yii::$app->request->get('id');
        $group = Group::find()->where(['id'=>$group_id,'status'=>1])->one();
        if($group){
            $groupUser = GroupUser::find()->where(['group_id'=>$group->id])->all();
            $list = [];
            if($groupUser){
                $user_id_arr = [];
                foreach($groupUser as $gu){
                    $user_id_arr[] = $gu->user_id;
                }
                $list = User::find()->where(['in','id',$user_id_arr])->all();
            }
            $params['list'] = $list;
            $params['group'] = $group;

            return $this->controller->render('group/user',$params);
        }else{
            Yii::$app->response->redirect('/manage/group')->send();
        }



    }





}