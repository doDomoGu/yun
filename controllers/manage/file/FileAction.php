<?php
namespace app\controllers\manage\file;

use app\models\File;
use yii\base\Action;
use Yii;

class FileAction extends Action{
    public function run(){
        $list = File::find()->all();
        $params['list'] = $list;
        return $this->controller->render('file/index',$params);
    }
}