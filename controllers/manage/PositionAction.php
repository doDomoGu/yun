<?php
namespace app\controllers\manage;

use yii\base\Action;
use app\models\Position;

use Yii;

class PositionAction extends Action{
    public function run(){
        if(Yii::$app->request->get('install')){
            $p = new Position();
            $p->install();
            exit;
        }


        $this->controller->view->title = '首页新闻 - 管理列表';
        $list = [];
        //$list = News::find()->orderBy('status desc, ord desc, edit_time desc')->all();

        return $this->controller->render('news/list',['list'=>$list]);
    }
}