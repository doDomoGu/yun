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
        $id = Yii::$app->request->get('id',false);
        $p_id = Yii::$app->request->get('p_id',false);
        $action = null ;
        if($id!=false){
            $position = Position::find()->where(['id'=>$id])->one();
            if($position){
                $this->controller->view->title = '职位/部门 - 编辑';
                $model->setAttributes($position->attributes);
                $action = 'edit';
            }else{
                Yii::$app->response->redirect('position')->send();
            }
        }elseif($p_id!=false){
            $parPos = Position::find()->where(['id'=>$p_id,'is_leaf'=>0])->one();
            if($parPos){
                $model->p_id = $p_id;
                //$model->type = $parPos->type;
                $model->level = $parPos->level + 1;
                $model->status = 1;
                $this->controller->view->title = '职位/部门 - 添加';
                $action = 'add';
            }else{
                Yii::$app->response->redirect('position')->send();
            }
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
        $params['action'] = $action;
        return $this->controller->render('position/add_and_edit',$params);
    }
}