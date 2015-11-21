<?php

namespace app\models;

use Yii;
use yii\base\Model;

class PositionForm extends Model
{
    public $id;
    public $name;
    public $describe;
    public $p_id;
    public $level;
    public $is_leaf;
    public $is_class;
    public $is_last;
    public $ord;
    public $status;

    public function attributeLabels(){
        return [
            'name' => '名称',
            'describe' => '描述',
            'p_id' => '父级',
            'level' => '层级',
            'is_leaf' => '是否叶级',
            //'is_class' => '是否类',
            //'is_last' => '最后一个',
            'ord' => '排序',
            'status' => '状态',
        ];
    }

    public function rules()
    {
        return [
            [['name', 'p_id'], 'required'],
            [['id', 'ord', 'level', 'is_leaf', 'is_last', 'is_class', 'p_id', 'status'], 'integer'],
            [['describe'], 'safe']

        ];
    }

}
