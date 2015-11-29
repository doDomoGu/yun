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
                $name = '发送单一职员';break;
            case self::SEND_TYPE_POSITION:
                $name = '发送整个部门';break;
            case self::SEND_TYPE_ALL:
                $name = '发送全体职员';break;
            default:
                $name = null;
        }
        return $name;
    }
}