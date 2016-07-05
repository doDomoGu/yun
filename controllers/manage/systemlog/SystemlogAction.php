<?php
namespace app\controllers\manage\systemlog;


use app\models\SystemLog;
use app\models\User;
use yii\base\Action;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use Yii;

class SystemlogAction extends Action{
    public function run(){
        $this->controller->view->title = '网站日志';
        $search = [
            'type' => '',
            'level' => '',
            'name' => '',
            'category' => '',
        ];
        $searchPost = yii::$app->request->post('search',false);
        $list = SystemLog::find();
        if($searchPost){
            $search = ArrayHelper::merge($search,$searchPost);
        }
        /*var_dump($search);exit;*/
        foreach($search as $k=>$s){
            if(in_array($k,['name'])){
                if($s!='')
                    $list->innerJoinWith('user')->andWhere('user.name like "%'.$s.'%"');
            }else if(in_array($k,['type','level'])){
                if($s!=='')
                    $list->andWhere([$k=>$s]);
            }else if(in_array($k,['category'])){
                if($s!=='')
                    $list->andWhere('category like "%'.$s.'%"');
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
        /*$uids = [];
        foreach($list as $l){
            if(!in_array($l->uid,$uids))
                $uids[] = $l->uid;
        }
        $username_list = [];
        $users = User::find()->where(['in','id',$uids])->all();
        foreach($users as $u){
            $username_list[$u->id]=>$u->username;
        }*/

        $params['list'] = $list;
        $params['search'] = $search;
        $params['pages'] = $pages;
        return $this->controller->render('systemlog/index',$params);
    }
}