<?php

namespace app\controllers;


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
            'news' => [
                'class' => 'app\controllers\manage\newsAction',
            ],
            'news-add-and-edit' => [
                'class' => 'app\controllers\manage\newsAddAndEditAction',
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

    public function actionRecruitment(){
        $this->view->title = '首页新闻管理';
        $list = News::find()->all();

        return $this->render('news/list',['list'=>$list]);
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



}
