<?php
namespace app\controllers\manage\admin;

use yii\base\Action;
use app\models\User;
use yii\helpers\ArrayHelper;

use Yii;

class AdminSetAction extends Action{
    public function run(){
        $id = yii::$app->request->get('id');
        $is_admin = yii::$app->request->get('is_admin');

        $user = User::find()->where(['id'=>$id])->one();
        $user->is_admin = $is_admin;

        if($user->save()){
            Yii::$app->response->redirect('admin')->send();
        }
    }
}