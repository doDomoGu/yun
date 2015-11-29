<?php
namespace app\components;

use app\models\Position;
use app\models\User;
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
                $name = '对整个部门/职位发送';break;
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
            $object = Json::decode($send_param);
            $user_id = $object['user_id'];
            $user = User::find()->where(['id'=>$user_id])->one();
            if($user)
                $info = $user_id.' '.$user->name;
            else
                $info = $user_id.' N/A';
        }elseif($send_type==self::SEND_TYPE_POSITION){
            $object = Json::decode($send_param);
            $position_id = $object['position_id'];

            $position = Position::find()->where(['id'=>$position_id])->one();
            if($position)
                $info = $position_id.' '.PositionFunc::getFullRoute($position_id);
            else
                $info = $position_id.' N/A';
        }
        return $info;
    }
}