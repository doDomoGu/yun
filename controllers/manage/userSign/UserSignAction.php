<?php
namespace app\controllers\manage\userSign;

//use app\components\PositionFunc;
use app\models\UserSign;
use yii\base\Action;
//use app\models\User;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use Yii;

class UserSignAction extends Action{
    public function run(){
        $this->controller->view->title = '职员签到';
        $y = yii::$app->request->get('y',false);
        $m = yii::$app->request->get('m',false);
        $y = $y?$y:date('Y');
        $m = $m?$m:date('m');
        if(!(in_array($y,['2015','2016','2017','2018']) && in_array($m,['01','02','03','04','05','06','07','08','09','10','11','12']))){
            Yii::$app->response->redirect('/manage/user-sign')->send();
        }

        $dateFirst = $y.$m.'01'; //月份第一天

        $weekdayFirst = date('w',strtotime($dateFirst));

        $dayNum = date('t',strtotime($dateFirst)); //月份总天数

        $dateLast = $y.$m.$dayNum; //月份最后一天

        $weekdayLast = date('w',strtotime($dateLast));

        $today = date('Y-m-d'); //当前日期

        $prevMonth = strtotime('-1 month',strtotime($dateFirst));

        $nextMonth = strtotime('+1 month',strtotime($dateFirst));

        $prevLink = ['/manage/user-sign','y'=>date('Y',$prevMonth),'m'=>date('m',$prevMonth)];
        $nextLink = ['/manage/user-sign','y'=>date('Y',$nextMonth),'m'=>date('m',$nextMonth)];

        $signNum = [];
        for($d=1;$d<=$dayNum;$d++){
            $signNum[$d] = UserSign::find()->where(['y'=>$y,'m'=>$m,'d'=>$d])->innerJoinWith('user')->count();
        }



        $params['y'] = $y;
        $params['m'] = $m;

        $params['prevLink'] = $prevLink;
        $params['nextLink'] = $nextLink;


        $params['dateFirst'] = $dateFirst;
        $params['weekdayFirst'] = $weekdayFirst;
        $params['dateLast'] = $dateLast;
        $params['weekdayLast'] = $weekdayLast;
        $params['dayNum'] = $dayNum;
        $params['today'] = $today;


        $params['signNum'] = $signNum;

        /*$params['signList'] = $signList;

        $params['signTodayFlag'] = $signTodayFlag;*/
        return $this->controller->render('userSign/index',$params);
    }
}