<?php
namespace app\components;

use yii\helpers\Json;
use yii\base\Component;
use yii;
use app\models\Message;

class MessageFunc extends Component {
    Const SEND_TYPE_ONE = 1;
    Const SEND_TYPE_POSITION = 2;
    Const SEND_TYPE_ALL = 3;


    public static function getTypeNameById($send_type){
        switch($send_type){
            case self::SEND_TYPE_ONE:
                $name = '对单一职员发送';break;
            case self::SEND_TYPE_POSITION:
                $name = '对整个部门发送';break;
            case self::SEND_TYPE_ALL:
                $name = '对全体职员发送';break;
            default:
                $name = null;
        }
        return $name;
    }

    public static function getObjectInfo($send_type,$send_param){
        $info = 'N/A';
        if($send_type==self::SEND_TYPE_ONE){
            if($send_param!=''){

            }
            $object = Json::decode($send_param);
            $user_id = $object['user_id'];
            $info = $user_id;
        }elseif($send_type==self::SEND_TYPE_POSITION){
            $object = Json::decode($send_param);
            $position_id = $object['position_id'];
            $info = $position_id;
        }
        return $info;
    }
}