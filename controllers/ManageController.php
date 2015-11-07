<?php

namespace app\controllers;

use app\models\News;
use app\models\NewsForm;
use Yii;


class ManageController extends BaseController
{
    public function behaviors()
    {
        return [
            /*'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout','index'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],*/
            /*'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],*/
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
                /*'view' => 'error'*/
            ],
            'test' => [
                'class' => 'app\controllers\site\TestAction',
                /*'view' => 'error'*/
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        /*$username = 'admin';
        $user = User::findByUsername($username);
        var_dump($user->getId());exit;*/

        return $this->render('index');
    }

    public function actionNews(){
        $this->view->title = '首页新闻 - 管理列表';
        $list = News::find()->orderBy('status desc, ord desc, edit_time desc')->all();

        return $this->render('news/list',['list'=>$list]);
    }

    public function actionNewsAddAndEdit(){
        $model = new NewsForm();
        $news = null;
        $id = Yii::$app->request->get('id');
        if($id!=''){
            $news = News::find()->where(['id'=>$id])->one();
            if($news){
                $this->view->title = '首页新闻 - 修改';
                $model->setAttributes($news->attributes);
                $news->setScenario('update');
            }else{
                Yii::$app->response->redirect('news')->send();
            }
        }else{
            $this->view->title = '首页新闻 - 添加';
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
        return $this->render('news/add_and_edit',$params);
    }

    /*public function actionNewsEdit(){
        $this->view->title = '首页新闻 - 修改';
        $id = Yii::$app->request->get('id');

        $model = new NewsForm();
        $news = News::find()->where(['id'=>$id])->one();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $news->setAttributes($model->attributes);
            if($news->save()){
                Yii::$app->response->redirect('news')->send();
            }
        }
        $params['model'] = $model;
        return $this->render('news/add',$params);
    }*/

    public function actionRecruitment(){
        $this->view->title = '首页新闻管理';
        $list = News::find()->all();

        return $this->render('news/list',['list'=>$list]);
    }

}
