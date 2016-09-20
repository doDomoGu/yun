<?php

namespace app\models;

use Yii;
use yii\base\Model;

class GroupForm extends Model
{
    public $id;
    public $name;
    public $describe;
    public $status;

    public function attributeLabels(){
        return [
            'name' => '群组名',
            'describe' => '描述',
            'status' => '状态',
        ];
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['id', 'status'], 'integer'],
            [['describe'], 'safe']

        ];
    }

}
