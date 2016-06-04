<?php
namespace app\controllers\manage\dir;

use app\components\DirFrontFunc;
use app\components\DirFunc;
use Yii;
use yii\base\Action;
use app\models\DirForm;
use app\models\Dir;
use yii\helpers\Json;

class DirDeployCacheAction extends Action{
    public function run(){
        if(Yii::$app->request->isAjax){
            $dir_id = Yii::$app->request->get('dir_id',false);
            $dir = Dir::find()->where(['id'=>$dir_id])->one();
            $time = 0;
            if($dir){
                $start = microtime(true);
                DirFrontFunc::getTreeData($dir->id);
                $end = microtime(true);
                $time = number_format($end - $start,3);
                $result = true;
            }else{
                $result = false;
            }
            return Json::encode(['result'=>$result,'time'=>$time]);
        }else{
            $this->controller->view->title = '重新生成“文件目录结构”缓存';
            $cache = Yii::$app->getCache();
            unset($cache['treeDataId']);
            unset($cache['dirDataId']);
            unset($cache['dirChildrenDataId']);

            $dirList = Dir::find()->all();
            $dirIds = [];
            foreach($dirList as $l){
                $dirIds[] = $l->id;
            }
            $params['dirIds'] = $dirIds;
            $params['dirIdsJson'] = Json::encode($dirIds);
            return $this->controller->render('dir/deploy_cache',$params);
        }
    }
}