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

class GroupUserSelectAction extends Action{
    public function run(){
        $group_id = Yii::$app->request->get('id');
        $group = Group::find()->where(['id'=>$group_id,'status'=>1])->one();
        if($group){
            if(isset($_POST) && !empty($_POST)){
                GroupUser::deleteAll(['group_id'=>$group->id]);
                if(!empty($_POST['uid'])){
                    $uids = $_POST['uid'];
                    $sql = "INSERT IGNORE INTO `group_user`(`group_id`,`user_id`) VALUES";
                    $insert = [];
                    foreach($uids as $uid){
                        $insert[] = '('.$group->id.','.$uid.')';
                    }
                    $sql .= implode(',',$insert);
                    $cmd = Yii::$app->db->createCommand($sql);
                    $cmd->execute();
                }
            }

            $list = User::find()->where('id>10001')->all();

            $groupUser = GroupUser::find()->where(['group_id'=>$group->id])->all();
            $checked = [];
            if($groupUser){
                foreach($groupUser as $gu){
                    $checked[] = $gu->user_id;
                }
            }
            $params['list'] = $list;
            $params['checked'] = $checked;
            $params['group'] = $group;

            return $this->controller->render('group/user_select',$params);
        }else{
            Yii::$app->response->redirect('/manage/group')->send();
        }



    }





}