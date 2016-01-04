<?php
namespace app\controllers\manage\file;

use app\models\File;
use yii\base\Action;
use Yii;
use yii\data\Pagination;

class FileAction extends Action{
    public function run(){
        $this->controller->view->title = '文件列表 - 管理中心';
        $search = [
            'filename'=>''
        ];


        $list = File::find();

        $count = $list->count();
        $pageSize = 20;
        $pages = new Pagination(['totalCount' =>$count, 'pageSize' => $pageSize,'pageSizeParam'=>false]);
        $list = $list
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy('id asc')
            ->all();

        $params['list'] = $list;
        $params['search'] = $search;
        $params['pages'] = $pages;
        return $this->controller->render('file/index',$params);
    }
}