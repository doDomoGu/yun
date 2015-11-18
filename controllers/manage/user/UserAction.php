<?php
namespace app\controllers\manage\user;

use yii\base\Action;
use app\models\User;
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
//            'is_admin' => '',


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
                }else if(in_array($k,['status','is_admin'])){
                    if($s!=='')
                        $list->andWhere([$k=>$s]);
                }
            }
        }

        $list = $list->orderBy('')->all();
        $params['list'] = $list;
        $params['search'] = $search;
        return $this->controller->render('user/list',$params);
    }
}