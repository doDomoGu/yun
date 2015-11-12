<?php
namespace app\controllers\manage\news;

use Yii;
use yii\base\Action;
use app\models\NewsForm;
use app\models\News;

class NewsAddAndEditAction extends Action{
    public function run(){
        $model = new NewsForm();
        $news = null;
        $id = Yii::$app->request->get('id');
        if($id!=''){
            $news = News::find()->where(['id'=>$id])->one();
            if($news){
                $this->controller->view->title = '首页新闻 - 编辑';
                $model->setAttributes($news->attributes);
                $news->setScenario('update');
            }else{
                Yii::$app->response->redirect('news')->send();
            }
        }else{
            $this->controller->view->title = '首页新闻 - 添加';
        }
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if($news == null){
                $news = new News();
                $news->setScenario('create');
            }

            $news->setAttributes($model->attributes);
            if($news->save()){
                Yii::$app->response->redirect('news')->send();
            }
        }

        $params['model'] = $model;
        return $this->controller->render('news/add_and_edit',$params);
    }
}