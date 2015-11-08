<?php
namespace app\controllers\manage;

use Yii;
use yii\base\Action;
use app\models\RecruitmentForm;
use app\models\Recruitment;

class RecruitmentAddAndEditAction extends Action{
    public function run(){
        $model = new RecruitmentForm();
        $recruitment = null;
        $id = Yii::$app->request->get('id');
        if($id!=''){
            $recruitment = Recruitment::find()->where(['id'=>$id])->one();
            if($recruitment){
                $this->controller->view->title = '招聘信息 - 编辑';
                $model->setAttributes($recruitment->attributes);
                $recruitment->setScenario('update');
            }else{
                Yii::$app->response->redirect('recruitment')->send();
            }
        }else{
            $this->controller->view->title = '招聘信息 - 添加';
        }
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if($recruitment == null){
                $recruitment = new Recruitment();
                $recruitment->setScenario('create');
            }

            $recruitment->setAttributes($model->attributes);
            if($recruitment->save()){
                Yii::$app->response->redirect('recruitment')->send();
            }
        }

        $params['model'] = $model;
        return $this->controller->render('recruitment/add_and_edit',$params);
    }
}