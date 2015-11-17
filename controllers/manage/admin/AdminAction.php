<?php
namespace app\controllers\manage\admin;

use yii\base\Action;
use app\models\User;
use yii\helpers\ArrayHelper;

use Yii;

class AdminAction extends Action{
    public function run(){
        $this->controller->view->title = '管理员设置 - 管理中心';
        $search = [
            'username' => '',
            'name' => '',
            'status' => '',
            'is_admin' => '',


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
                }
            }
        }

        $list = $list->orderBy('')->all();
        $params['list'] = $list;
        $params['search'] = $search;
        return $this->controller->render('admin/list',$params);
    }
}