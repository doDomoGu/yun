<?php

namespace app\models;

use Yii;
use yii\base\Model;

class UserChangeHeadImgForm extends Model
{
    public $id;
    public $head_img;


    public function rules()
    {
        return [
            ['head_img','safe'],
        ];
    }

    public function attributeLabels(){
        return [

            'head_img' => '职员头像',
        ];
    }
}
