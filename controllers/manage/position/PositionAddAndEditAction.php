<?php
namespace app\controllers\manage\position;

use app\components\PositionFunc;
use Yii;
use yii\base\Action;
use app\models\PositionForm;
use app\models\Position;

class PositionAddAndEditAction extends Action{
    public function run(){
        $model = new PositionForm();
        $position = null;
        $id = Yii::$app->request->get('id');
        if($id!=''){
            $position = Position::find()->where(['id'=>$id])->one();
            if($position){
                $this->controller->view->title = '职位/部门 - 编辑';
                $model->setAttributes($position->attributes);
            }else{
                Yii::$app->response->redirect('position')->send();
            }
        }else{
            $this->controller->view->title = '职位/部门 - 添加';
        }
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if($position == null){
                $position = new Position();
            }

            $position->setAttributes($model->attributes);
            if($position->save()){
                $parents = PositionFunc::getParents($position->id);
                $redirect = ['manage/position'];
                if(isset($parents[2])){
                    $redirect['p_id'] = $parents[2]->id;
                }elseif(isset($parents[1])){
                    $redirect['p_id'] = $parents[1]->id;
                }
                Yii::$app->response->redirect($redirect)->send();
            }
        }

        $params['model'] = $model;
        return $this->controller->render('position/add_and_edit',$params);
    }
}