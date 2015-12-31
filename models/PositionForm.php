<?php

namespace app\models;

use Yii;
use yii\base\Model;

class PositionForm extends Model
{
    public $id;
    public $name;
    public $alias;
    public $describe;
    public $p_id;
    public $level;
    public $is_leaf;
    public $is_class;
    public $is_last;
    public $ord;
    public $status;
    public $shuoming;
    public $zhiquan;
    public $zhize;
    public $zhibiao;

    public function attributeLabels(){
        return [
            'name' => '名称',
            'alias' => '别名',
            'describe' => '描述',
            'p_id' => '父级',
            'level' => '层级',
            'is_leaf' => '是否职位',
            //'is_class' => '是否类',
            //'is_last' => '最后一个',
            'ord' => '排序',
            'status' => '状态',
            'shuoming' => '个人岗位说明',
            'zhiquan' => '个人岗位职权',
            'zhize' => '个人岗位职责',
            'zhibiao' => '个人绩效指标',
        ];
    }

    public function rules()
    {
        return [
            [['name', 'alias', 'p_id'], 'required'],
            [['id', 'ord', 'level', 'is_leaf', 'is_last', 'is_class', 'p_id', 'status'], 'integer'],
            [['describe','shuoming','zhiquan','zhize','zhibiao'], 'safe']

        ];
    }

}
