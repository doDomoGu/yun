<?php
namespace app\controllers\manage\dir;

use Yii;
use yii\base\Action;
use app\models\DirForm;
use app\models\Dir;

class DirAddAndEditAction extends Action{
    public function run(){
        $model = new DirForm();
        $dir = null;
        $id = Yii::$app->request->get('id');
        if($id!=''){
            $dir = Dir::find()->where(['id'=>$id])->one();
            if($dir){
                $this->controller->view->title = '板块目录 - 编辑';
                $model->setAttributes($dir->attributes);
            }else{
                Yii::$app->response->redirect('news')->send();
            }
        }else{
            $this->controller->view->title = '板块目录 - 添加';
        }
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if($dir == null){
                $dir = new Dir();
            }

            $dir->setAttributes($model->attributes);
            if($dir->save()){
                Yii::$app->response->redirect('dir')->send();
            }
        }

        $params['model'] = $model;
        return $this->controller->render('dir/add_and_edit',$params);
    }
}