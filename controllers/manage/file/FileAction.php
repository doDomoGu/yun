<?php
namespace app\controllers\manage\file;

use app\models\File;
use app\models\User;
use yii\base\Action;
use Yii;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;

class FileAction extends Action{
    public function run(){
        $this->controller->view->title = '文件列表 - 管理中心';
        $search = [
            'filename' => '',
            'isfile' => '',
            'username' => '',

        ];
        $searchPost = yii::$app->request->post('search',false);

        $list = File::find();
        if($searchPost){
            $search = ArrayHelper::merge($search,$searchPost);
            /*var_dump($search);exit;*/
            foreach($search as $k=>$s){
                if(in_array($k,['filename'])){
                    if($s!='')
                        $list->andWhere(['like',$k,$s]);
                }else if($k=='username'){
                    $users = User::find()->where(['like','name',$s])->all();
                    $uids = [];
                    if(!empty($users)){
                        foreach($users as $u){
                            $uids[] = $u->id;
                        }
                    }
                    $list->andWhere(['in','uid',$uids]);
                }else if($k=='isfile'){
                    if($s==='0'){
                        $list->andWhere(['filetype'=>0]);
                    }elseif($s==='1'){
                        $list->andWhere(['>','filetype',0]);
                    }
                }/*else if(in_array($k,['status','gender'])){
                    if($s!=='')
                        $list->andWhere([$k=>$s]);
                }*//*else if(in_array($k,['position_id'])){
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