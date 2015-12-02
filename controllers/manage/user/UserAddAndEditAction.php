<?php
namespace app\controllers\manage\user;

use Yii;
use yii\base\Action;
use app\models\UserForm;
use app\models\User;

class UserAddAndEditAction extends Action{
    public function run(){
        $model = new UserForm();
        $user = null;
        $notChangePw = false;
        $id = Yii::$app->request->get('id');
        if($id!=''){
            $user = User::find()->where(['id'=>$id])->one();
            if($user){
                $this->controller->view->title = '职员 - 编辑';
                $model->setScenario('update');
                $model->setAttributes($user->attributes);
                $model->password = '';
                //$user->setScenario('update');
            }else{
                Yii::$app->response->redirect('user')->send();
            }
        }else{
            $this->controller->view->title = '职员 - 添加';
            $model->setScenario('create');
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if($user == null){
                $user = new User();
                //$user->setScenario('create');
            }
            if($model->getScenario()=='update' && ($model->password=='' || $model->password2=='')){
                $model->password = $user->password;
                $notChangePw = true;
            }

            $user->setAttributes($model->attributes);

            if($notChangePw==false){
                $user->password = md5($user->password);
            }
            if($user->save()){
                Yii::$app->response->redirect('user')->send();
            }
        }

        $params['model'] = $model;
        return $this->controller->render('user/add_and_edit',$params);
    }
}