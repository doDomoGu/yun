<?php

namespace app\controllers;


use app\components\DirFunc;
use app\components\FileFrontFunc;

use app\components\PermissionFunc;
use app\models\Dir;
use app\models\File;

use app\models\PositionDirPermission;
use Yii;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;


class SearchController extends BaseController
{
    public function actionIndex()
    {
        $searchDefault = [
            'filename' => '',
        ];
        $search = [];
        $search['filename'] = yii::$app->request->get('filename',$searchDefault['filename']);



        $list = File::find();


        if(!yii::$app->user->isGuest){
            $dir_ids_ok_1 = PermissionFunc::getDirIdsOk($this->position->id,[PermissionFunc::DOWNLOAD_COMMON]);
            $dir_ids_ok_2 = PermissionFunc::getDirIdsOk($this->position->id,[PermissionFunc::DOWNLOAD_ALL]);

            if(is_array($dir_ids_ok_1) && !empty($dir_ids_ok_1) && is_array($dir_ids_ok_2) && !empty($dir_ids_ok_2)){
                $list->andWhere(
                    ['or',
                        [
                            'and',
                            ['flag'=>1],
                            ['in','dir_id',$dir_ids_ok_1]
                        ],
                        [
                            'and',
                            ['flag'=>2],
                            ['in','dir_id',$dir_ids_ok_2]
                        ]
                    ]);
            }elseif(is_array($dir_ids_ok_1) && !empty($dir_ids_ok_1)){
                $list->andWhere(['and',['flag'=>1],['in','dir_id',$dir_ids_ok_1]]);
            }elseif(is_array($dir_ids_ok_2) && !empty($dir_ids_ok_2)){
                $list->andWhere(['and',['flag'=>2],['in','dir_id',$dir_ids_ok_2]]);
            }
        }

        foreach($search as $k=>$s){
            if(in_array($k,['filename'])){
                if($s!='')
                    $list->andWhere(['like',$k,$s]);
;            }/*else if(in_array($k,['status','gender'])){

                if($s!=='')
                    $list->andWhere([$k=>$s]);
            }else if(in_array($k,['position_id'])){
                if($s!==''){
                    $arr = ArrayHelper::merge([$s],PositionFunc::getAllChildrenIds($s));
                    $list->andWhere(['in',$k,$arr]);
                }

            }*/
        }

        $count = $list->count();
        $pageSize = 20;
        $pages = new Pagination(['totalCount' =>$count, 'pageSize' => $pageSize,'pageSizeParam'=>false]);


        $list = $list
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy('id desc')
            ->all();
        $params['list'] = $list;
        $params['search'] = $search;
        $params['pages'] = $pages;

        return $this->render('index',$params);
    }

}


