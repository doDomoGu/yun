<?php
namespace app\controllers\manage\dir;

use app\components\DirFrontFunc;
use app\components\DirFunc;
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
                Yii::$app->response->redirect('dir')->send();
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
                $parents = DirFunc::getParents($dir->id);
                $redirect = ['manage/dir'];
                if(isset($parents[2])){
                    $redirect['dir_id'] = $parents[2]->id;
                }elseif(isset($parents[1])){
                    $redirect['dir_id'] = $parents[1]->id;
                }
                $cache = Yii::$app->getCache();
                unset($cache['treeDataId']);
                //$this->clearTreeDataCache();

                Yii::$app->response->redirect($redirect)->send();
            }
        }

        $params['model'] = $model;
        return $this->controller->render('dir/add_and_edit',$params);
    }

    public function clearTreeDataCache(){
        $dirList = Dir::find()->all();
        foreach($dirList as $d){
            DirFrontFunc::getTreeData($d->id);
        }
    }
}