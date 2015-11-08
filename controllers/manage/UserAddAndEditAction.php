<?php
namespace app\controllers\manage;

use Yii;
use yii\base\Action;
use app\models\UserForm;
use app\models\User;

class UserAddAndEditAction extends Action{
    public function run(){
        $model = new UserForm();
        $user = null;
        $id = Yii::$app->request->get('id');
        if($id!=''){
            $user = User::find()->where(['id'=>$id])->one();
            if($user){
                $this->controller->view->title = '职员 - 编辑';
                $model->setAttributes($user->attributes);
                //$user->setScenario('update');
            }else{
                Yii::$app->response->redirect('user')->send();
            }
        }else{
            $this->controller->view->title = '职员 - 添加';
        }
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if($user == null){
                $user = new User();
                //$user->setScenario('create');
            }

            $user->setAttributes($model->attributes);
            if($user->save()){
                Yii::$app->response->redirect('user')->send();
            }
        }

        $params['model'] = $model;
        return $this->controller->render('user/add_and_edit',$params);
    }
}