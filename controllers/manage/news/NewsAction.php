<?php
namespace app\controllers\manage\news;

use yii\base\Action;
use app\models\News;

use Yii;

class NewsAction extends Action{
    public function run(){

        $this->controller->view->title = '首页新闻 - 管理列表';
        $list = News::find()->orderBy('status desc, ord desc, edit_time desc')->all();

        return $this->controller->render('news/list',['list'=>$list]);
    }
}