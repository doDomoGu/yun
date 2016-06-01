<?php
namespace app\controllers\manage\position;

use app\components\DirFrontFunc;
use app\components\PositionFunc;
use yii\base\Action;
use app\models\Position;
use app\models\Dir;

use Yii;

class PositionTestAction extends Action{
    public function run(){
        if(Yii::$app->request->get('clear')){
            $cache = Yii::$app->cache;
            unset($cache['posTreeData']);
            Yii::$app->response->redirect('positionTest')->send();
            exit;
        }


        /*$treeData = DirFrontFunc::getTreeData(1);
        var_dump($treeData);
        echo '<br/>================<br/>';
        $treeData = PositionFunc::getTreeData();
        var_dump($treeData);
        echo '<br/>================<br/>';
        exit;*/


        $treeData = PositionFunc::getTreeData();

        /*$this->controller->view->title = '职位/部门 - 列表';

        $list = PositionFunc::getListArr(0,true,true,true);
        $params['list'] = $list;*/
        $params['treeData'] = $treeData;
        return $this->controller->render('position/list_test',$params);
    }
}