<?php
namespace app\controllers\manage\file;

use app\models\File;
use yii\base\Action;
use Yii;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;

class FileAction extends Action{
    public function run(){
        $this->controller->view->title = '文件列表 - 管理中心';
        $search = [
            'filename' => '',
            'username' => '',
        ];
        $searchPost = yii::$app->request->post('search',false);

        $list = File::find();
        if($searchPost){
            $search = ArrayHelper::merge($search,$searchPost);
            foreach($search as $k=>$s){
                if(in_array($k,['filename'])){
                    if($s!='')
                        $list->andWhere(['like',$k,$s]);
                }else if(in_array($k,['status','gender'])){
                    if($s!=='')
                        $list->andWhere([$k=>$s]);
                }/*else if(in_array($k,['position_id'])){
                    if($s!==''){
                        $arr = ArrayHelper::merge([$s],PositionFunc::getAllChildrenIds($s));
                        $list->andWhere(['in',$k,$arr]);
                    }

                }*/
            }
        }



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