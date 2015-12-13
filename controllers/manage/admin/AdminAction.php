<?php
namespace app\controllers\manage\admin;

use yii\base\Action;
use app\models\User;
use yii\helpers\ArrayHelper;
use yii\data\Pagination;
use app\components\PositionFunc;
use Yii;

class AdminAction extends Action{
    public function run(){
        $this->controller->view->title = '管理员设置 - 管理中心';
        $search = [
            'username' => '',
            'name' => '',
            'status' => '',
            'is_admin' => '',
            'position_id' => '',
        ];
        $searchPost = yii::$app->request->post('search',false);

        $list = User::find();
        if($searchPost){
            $search = ArrayHelper::merge($search,$searchPost);
/*var_dump($search);exit;*/
            foreach($search as $k=>$s){
                if(in_array($k,['username','name'])){
                    if($s!='')
                        $list->andWhere(['like',$k,$s]);
                }else if(in_array($k,['status','is_admin'])){
                    if($s!=='')
                        $list->andWhere([$k=>$s]);
                }else if(in_array($k,['position_id'])){
                    if($s!==''){
                        $arr = ArrayHelper::merge([$s],PositionFunc::getAllChildrenIds($s));
                        $list->andWhere(['in',$k,$arr]);
                    }
                }
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
        return $this->controller->render('admin/list',$params);
    }
}