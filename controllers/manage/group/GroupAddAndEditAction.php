<?php
namespace app\controllers\manage\group;

use app\components\DirFrontFunc;
use app\components\DirFunc;
use Yii;
use yii\base\Action;
use app\models\GroupForm;
use app\models\Group;

class GroupAddAndEditAction extends Action{
    public function run(){
        $model = new GroupForm();
        $group = null;
        $id = Yii::$app->request->get('id',false);
        $action = null ;
        if($id!=false){
            $group = Group::find()->where(['id'=>$id])->one();
            if($group){
                $action = 'edit';
                $model->setAttributes($group->attributes);
            }else{
                Yii::$app->response->redirect('group')->send();
            }
        }else{

        }
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if($group == null){
                $group = new Group();
            }
            $group->setAttributes($model->attributes);

            if($group->save()){
                //重定向
                Yii::$app->response->redirect('/manage/group')->send();
            }
        }

        $params['model'] = $model;
        $params['action'] = $action;
        return $this->controller->render('group/add_and_edit',$params);
    }

}