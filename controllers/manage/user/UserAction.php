<?php
namespace app\controllers\manage\user;

use app\components\PositionFunc;
use yii\base\Action;
use app\models\User;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use Yii;

class UserAction extends Action{
    public function run(){
        $this->controller->view->title = '职员列表 - 管理列表';
        $search = [
            'username' => '',
            'name' => '',
            'phone' => '',
            'mobile' => '',
            'status' => '',
            'gender' => '',
            'position_id' => '',
        ];
        $searchPost = yii::$app->request->post('search',false);

        $list = User::find();
        if($searchPost){
            $search = ArrayHelper::merge($search,$searchPost);
            /*var_dump($search);exit;*/
            foreach($search as $k=>$s){
                if(in_array($k,['username','name','phone','mobile'])){
                    if($s!='')
                        $list->andWhere(['like',$k,$s]);
                }else if(in_array($k,['status','gender'])){
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
            //->orderBy('')
            ->all();
        $params['list'] = $list;
        $params['search'] = $search;
        $params['pages'] = $pages;
        return $this->controller->render('user/list',$params);
    }
}