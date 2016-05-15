<?php
namespace app\controllers\manage\userSign;

//use app\components\PositionFunc;
use app\models\UserSign;
use yii\base\Action;
//use app\models\User;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use Yii;

class UserSignDetailAction extends Action{
    public function run(){
        $this->controller->view->title = '职员签到-详情';
        $day = yii::$app->request->get('day',false);
        $dayTrue = date('Y-m-d',strtotime($day));
        if($day != $dayTrue){
            Yii::$app->response->redirect('/manage/user-sign')->send();
        }else{
            $y = substr($day,0,4);
            $m = substr($day,5,2);
            $d = substr($day,8,2);
            $list = UserSign::find()->where(['y'=>$y,'m'=>$m,'d'=>$d])->innerJoinWith('user');
            //$list = UserSign::find()->where(['y'=>$y,'m'=>$m,'d'=>$d])->getUser()->andWhere('status=1');
            $count = $list->count();
            $pageSize = 20;
            $pages = new Pagination(['totalCount' =>$count, 'pageSize' => $pageSize,'pageSizeParam'=>false]);


            $list = $list
                ->offset($pages->offset)
                ->limit($pages->limit)
                ->orderBy('id asc')
                ->all();
            $params['list'] = $list;
            $params['pages'] = $pages;


            $prevLink = ['/manage/user-sign-detail','day'=>date('Y-m-d',strtotime('-1day',strtotime($day)))];
            $nextLink = ['/manage/user-sign-detail','day'=>date('Y-m-d',strtotime('+1day',strtotime($day)))];

            $params['y'] = $y;
            $params['m'] = $m;
            $params['d'] = $d;

            $params['prevLink'] = $prevLink;
            $params['nextLink'] = $nextLink;
        }


        return $this->controller->render('userSign/detail',$params);
    }
}