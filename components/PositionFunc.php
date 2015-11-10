<?php
namespace app\components;

use app\models\Position;
use yii\base\Component;

class PositionFunc extends Component {
    public static function getFullRoute($pid,$separator=' > '){
        $str = '';
        $position = Position::find()->where('id = '.$pid)->one();
        if($position!==NULL){
            $str.= self::getFullRoute($position->p_id,$separator);
            if($str!=null){
                $str.= $separator;
            }
            $str.= $position->name;
        }
        return $str;
    }

    public static function getIsLeaf($is_leaf=NULL){
        if($is_leaf===1){
            return '<span class="label label-primary">职位</span>';
        }elseif($is_leaf===0){
            return '<span class="label label-default">部门</span>';
        }else{
            return 'N/A';
        }
    }
}