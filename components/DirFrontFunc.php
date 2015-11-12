<?php
namespace app\components;

use app\models\Dir;
use app\models\Position;
use yii\base\Component;
use yii\helpers\BaseArrayHelper;
use Yii;

class DirFrontFunc extends Component {
    public static function getNavbar(){
        $arr = [];
        $isDirCtl = strpos(Yii::$app->controller->route,'dir')===0?true:false;
        $dirLvl_1 = null;
        if($isDirCtl){
            $dir_id = Yii::$app->request->get('dir_id',false);

            if($dir_id){
                $parents = DirFunc::getParents($dir_id);
                $dirLvl_1 = isset($parents[1])?$parents[1]:null;
            }
        }





        $dirs = Dir::find()->where(['p_id'=>0,'status'=>1])->orderBy('ord desc,id desc')->all();
        if(!empty($dirs)){
            foreach($dirs as $dir){
                $active = $dirLvl_1!=null && $dirLvl_1->id==$dir->id?true:false;

                $arr[] = [
                    'label'=>$dir->name,
                    'url'=>['/dir','dir_id'=>$dir->id],
                    'active' => $active,
                ];
            }
        }


        return $arr;
    }
}