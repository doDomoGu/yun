<?php
namespace app\controllers\manage;

use yii\base\Action;
use app\models\Recruitment;

use Yii;

class RecruitmentAction extends Action{
    public function run(){

        $this->controller->view->title = '招聘信息 - 管理列表';
        $list = Recruitment::find()->orderBy('status desc, ord desc, edit_time desc')->all();

        return $this->controller->render('recruitment/list',['list'=>$list]);
    }
}