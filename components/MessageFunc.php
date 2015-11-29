<?php
namespace app\components;

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
}