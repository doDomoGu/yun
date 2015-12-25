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
        $id = Yii::$app->request->get('id',false);
        $p_id = Yii::$app->request->get('p_id',false);
        $action = null ;
        if($id!=false){
            $dir = Dir::find()->where(['id'=>$id])->one();
            if($dir){
                $this->controller->view->title = '板块目录 - 编辑';
                $model->setAttributes($dir->attributes);
                $action = 'edit';
            }else{
                Yii::$app->response->redirect('dir')->send();
            }
        }elseif($p_id!=false){
            $parDir = Dir::find()->where(['id'=>$p_id,'is_leaf'=>0])->one();
            if($parDir){
                $model->p_id = $p_id;
                $model->type = $parDir->type;
                $model->level = $parDir->level + 1;
                $model->status = 1;
                $this->controller->view->title = '板块目录 - 添加';
                $action = 'add';
            }else{
                Yii::$app->response->redirect('dir')->send();
            }
        }
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if($dir == null){
                $dir = new Dir();
                $dir->setAttributes($model->attributes);
                $dir->more_cate = 0;
                //查找出当前父目录下的其他子目录 ord 最小的
                $lastDir = Dir::find()->where(['p_id'=>$p_id])->orderBy('ord asc')->one();
                if($lastDir){
                    //将原本is_last子目录改为0
                    $lastDir->is_last = 0;
                    $lastDir->save();
                    //赋予新建的目录ord = lastDir->ord - 1  is_last = 1
                    $dir->ord = $lastDir->ord - 1;
                }else{
                    $dir->ord = 99;
                }
                $dir->is_last = 1;

            }else{
                $dir->setAttributes($model->attributes);
            }

            if($dir->save()){
                //清除缓存
                $cache = Yii::$app->getCache();
                unset($cache['treeDataId']);
                //$this->clearTreeDataCache();

                //重定向
                $parents = DirFunc::getParents($dir->id);
                $redirect = ['manage/dir'];
                if(isset($parents[2])){
                    $redirect['dir_id'] = $parents[2]->id;
                }elseif(isset($parents[1])){
                    $redirect['dir_id'] = $parents[1]->id;
                }
                Yii::$app->response->redirect($redirect)->send();
            }
        }

        $params['model'] = $model;
        $params['action'] = $action;
        return $this->controller->render('dir/add_and_edit',$params);
    }

    public function clearTreeDataCache(){
        $dirList = Dir::find()->all();
        foreach($dirList as $d){
            DirFrontFunc::getTreeData($d->id);
        }
    }
}