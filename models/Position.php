<?php

namespace app\models;
use yii;

class Position extends \yii\db\ActiveRecord
{
    public $childrenIds;

    public function rules()
    {
        return [
            ['name', 'required'],
            [['id', 'status', 'p_id', 'ord', 'is_leaf', 'is_last', 'level', 'is_class'], 'integer'],
            ['name', 'string', 'max'=>100],
            [['describe','shuoming','zhiquan','zhize','zhibiao'],'safe']
        ];
    }

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
            'shuoming' => '个人岗位说明',
            'zhiquan' => '个人岗位职权',
            'zhize' => '个人岗位职责',
            'zhibiao' => '个人绩效指标',
        ];
    }

    /*CREATE TABLE `position` (
     `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
     `name` varchar(100) NOT NULL COMMENT '部门/职位名称',
     `describe` text NOT NULL,
     `p_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '父位置id,一级位置为0',
     `level` int(4) unsigned DEFAULT '0' COMMENT '层级',
     `is_leaf` tinyint(1) unsigned DEFAULT '0' COMMENT '0:部门;1:职位;',
     `is_class` tinyint(1) unsigned DEFAULT '0' COMMENT '0:不在,1:在中心的组织架构中出现;',
     `is_last` tinyint(1) unsigned DEFAULT '0' COMMENT '实际排序当前同级下最后一个',
     `ord` int(4) unsigned DEFAULT '0' COMMENT '排序,倒序从大到小',
     `status` tinyint(1) unsigned DEFAULT '0' COMMENT '0:删除;1:正常',
     PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8*/



/*ALTER TABLE `position` ADD `shuoming` VARCHAR(255) DEFAULT NULL ,
ADD `zhiquan` VARCHAR(255) DEFAULT NULL ,
ADD `zhize` VARCHAR(255) DEFAULT NULL ,
ADD `zhibiao` VARCHAR(255) DEFAULT NULL ;*/


/*ALTER TABLE `position` ADD `alias` VARCHAR(255) DEFAULT NULL AFTER `name`;*/

    public $zhiji1;
    public $zhiji2;
    public $zhiji3;
    public $zhiji4;
    public $anchang1;
    public $guanggao;
    public $bumen1;
    public $bumen1_2;
    public $bumen2;
    public $bumen2_2;
    public $bumen3;
    public $bumen3_2;
    public $arr;

    public function __construct(){
        $this->zhiji1 = [
            ['n'=>'总监','a'=>'zj','l'=>true],
            ['n'=>'副总监','a'=>'fzj','l'=>true],
            ['n'=>'经理','a'=>'jl','l'=>true],
            ['n'=>'主管','a'=>'zg','l'=>true],
            ['n'=>'专员','a'=>'zy','l'=>true]
        ];

        $this->zhiji2 = [
            ['n'=>'总经理','l'=>true],
            ['n'=>'副总经理','l'=>true],
            ['n'=>'总监','l'=>true],
            ['n'=>'总经理助理','l'=>true]
        ];

        $this->zhiji3 = [
            ['n'=>'总监','l'=>true],
            ['n'=>'副总监','l'=>true],
            ['n'=>'经理','l'=>true]
        ];

        $this->zhiji4 = [
            ['n'=>'指导','l'=>true],
            ['n'=>'师','l'=>true],
            ['n'=>'专员','l'=>true],
            ['n'=>'助理','l'=>true]
        ];

        $this->anchang1 = [
            ['n'=>'项目管理','c'=>[
                ['n'=>'总监','l'=>true],
                ['n'=>'副总监','l'=>true],
                ['n'=>'经理','l'=>true]
            ]],
            ['n'=>'案场策划','c'=>[
                ['n'=>'副总监','l'=>true],
                ['n'=>'经理','l'=>true],
                ['n'=>'主管','l'=>true],
                ['n'=>'专员','l'=>true]
            ]],
            ['n'=>'案场销售','c'=>[
                ['n'=>'客户主管','l'=>true]
            ]],
            ['n'=>'案场客服','c'=>[
                ['n'=>'客户代表','l'=>true]
            ]],
            ['n'=>'案场行政','c'=>[
                ['n'=>'主管','l'=>true],
                ['n'=>'专员','l'=>true]
            ]]
        ];

        $this->guanggao = [
            ['n'=>'部门管理','c'=>$this->zhiji3],
            ['n'=>'设计','c'=>$this->zhiji4],
            ['n'=>'文案','c'=>$this->zhiji4],
        ];
        $this->bumen1 = [
            ['n'=>'总经办','a'=>'zjb','c'=>$this->zhiji2],
            ['n'=>'财务部','a'=>'cwb','c'=>$this->zhiji1],
            ['n'=>'综合管理部','a'=>'zhglb','c'=>$this->zhiji1],
            ['n'=>'开发拓展部','a'=>'kftzb','c'=>$this->zhiji1],
            ['n'=>'市场策划部','a'=>'scchb','c'=>$this->zhiji1],
            ['n'=>'销售业务部','a'=>'xsywb','c'=>[
                ['n'=>'项目案场[A]','a'=>'xmac_1','c'=>$this->anchang1],
                ['n'=>'项目案场[B]','a'=>'xmac_2','c'=>$this->anchang1],
                ['n'=>'项目案场[C]','a'=>'xmac_3','c'=>$this->anchang1]
            ]]
        ];
        $this->bumen1_2 = [
            ['n'=>'总经办','a'=>'zjb','c'=>$this->zhiji2],
            ['n'=>'开发拓展部','a'=>'kftzb','c'=>$this->zhiji1],
            ['n'=>'市场策划部','a'=>'scchb','c'=>$this->zhiji1],
            ['n'=>'销售业务部','a'=>'xsywb','c'=>[
                ['n'=>'项目案场[A]','a'=>'xmac_1','c'=>$this->anchang1],
                ['n'=>'项目案场[B]','a'=>'xmac_2','c'=>$this->anchang1],
                ['n'=>'项目案场[C]','a'=>'xmac_3','c'=>$this->anchang1]
            ]]
        ];

        $this->bumen2 = [
            ['n'=>'财务部','c'=>$this->zhiji1],
            ['n'=>'综合管理部','c'=>$this->zhiji1],
            ['n'=>'销售业务部','c'=>[
                ['n'=>'项目案场[A]','c'=>$this->zhiji1],
                ['n'=>'项目案场[B]','c'=>$this->zhiji1]
            ]]
        ];

        $this->bumen2_2 = [
            ['n'=>'销售业务部','c'=>[
                ['n'=>'项目案场[A]','c'=>$this->zhiji1],
                ['n'=>'项目案场[B]','c'=>$this->zhiji1]
            ]]
        ];

        $this->bumen3 = [
            ['n'=>'总经办','c'=>[
                ['n'=>'总经理','l'=>true],
                ['n'=>'副总经理','l'=>true],
                ['n'=>'总经理助理','l'=>true]
            ]],
            ['n'=>'财务部','c'=>$this->zhiji1],
            ['n'=>'综合管理部','c'=>$this->zhiji1],
            ['n'=>'开发拓展部','c'=>$this->zhiji1],
            ['n'=>'AE策划部','c'=>$this->zhiji1],
            ['n'=>'创意部','c'=>$this->guanggao],
            ['n'=>'创作部','c'=>[
                ['n'=>'创作1部','c'=>$this->guanggao],
                ['n'=>'创作2部','c'=>$this->guanggao],
                ['n'=>'创作3部','c'=>$this->guanggao]
            ]],


        ];

        $this->bumen3_2 = [
            ['n'=>'总经办','c'=>[
                ['n'=>'总经理','l'=>true],
                ['n'=>'副总经理','l'=>true],
                ['n'=>'总经理助理','l'=>true]
            ]],
            ['n'=>'开发拓展部','c'=>$this->zhiji1],
            ['n'=>'AE策划部','c'=>$this->zhiji1],
            ['n'=>'创意部','c'=>$this->guanggao],
            ['n'=>'创作部','c'=>[
                ['n'=>'创作1部','c'=>$this->guanggao],
                ['n'=>'创作2部','c'=>$this->guanggao],
                ['n'=>'创作3部','c'=>$this->guanggao]
            ]],


        ];




        $this->arr = [
            ['n'=>'管理员','l'=>true,'a'=>'admin'],
            ['n'=>'颂唐机构','a'=>'stjg','c'=>[
                ['n'=>'上海总部平台','a'=>'shzbpt','c'=>[
                    ['n'=>'企宣管控中心','a'=>'qxgkzx','c'=>$this->zhiji1],
                    ['n'=>'发展管控中心','a'=>'fzgkzx','c'=>$this->zhiji1],
                    ['n'=>'行政管控中心','a'=>'xzgkzx','c'=>$this->zhiji1],
                    ['n'=>'财务管控中心','a'=>'cwgkzx','c'=>$this->zhiji1]
                ]]
            ]],
            ['n'=>'市场策略中心','a'=>'scclzx','c'=>[
                ['n'=>'上海总部平台','a'=>'shzbpt','c'=>$this->zhiji1]
            ]],
            ['n'=>'华麦建筑','a'=>'hmjz','c'=>[
                ['n'=>'上海华麦建筑','a'=>'sh']
            ]],
            ['n'=>'颂唐地产','a'=>'stjg','c'=>[
                ['n'=>'上海颂唐地产','a'=>'sh','c'=>$this->bumen1],
                ['n'=>'苏州颂唐地产','a'=>'sz','c'=>$this->bumen1_2],
                ['n'=>'无锡颂唐地产','a'=>'wx','c'=>$this->bumen1_2],
                ['n'=>'南京颂唐地产','a'=>'nj','c'=>$this->bumen1_2],
                ['n'=>'安徽颂唐地产','a'=>'ah','c'=>$this->bumen1_2],
                ['n'=>'苏北颂唐地产','a'=>'sb','c'=>$this->bumen1_2],
            ]],
            ['n'=>'汉佑房屋','c'=>[
                ['n'=>'苏州汉佑房屋','c'=>[
                    ['n'=>'新湖明珠店','c'=>$this->zhiji1],
                    ['n'=>'石湖店','c'=>$this->zhiji1]
                ]],
                ['n'=>'无锡汉佑房屋']
            ]],
            ['n'=>'致秦经纪','c'=>[
               ['n'=>'上海致秦经纪','c'=>$this->bumen2],
               ['n'=>'苏州致秦经纪','c'=>$this->bumen2_2],
               ['n'=>'无锡致秦经纪','c'=>$this->bumen2_2],
               ['n'=>'南京致秦经纪','c'=>$this->bumen2_2],
               ['n'=>'合肥致秦经纪','c'=>$this->bumen2_2],
            ]],
            ['n'=>'明致置业','c'=>[
               ['n'=>'上海明致置业'],
               ['n'=>'南京明致置业']
            ]],
            ['n'=>'日鑫商业','c'=>[
                ['n'=>'上海日鑫商业','c'=>$this->bumen1],
                ['n'=>'苏州日鑫商业','c'=>$this->bumen1_2],
                ['n'=>'无锡日鑫商业','c'=>$this->bumen1_2],
                ['n'=>'南京日鑫商业','c'=>$this->bumen1_2],
                ['n'=>'安徽日鑫商业','c'=>$this->bumen1_2],
                ['n'=>'苏北日鑫商业','c'=>$this->bumen1_2],
            ]],
            ['n'=>'颂唐广告','c'=>[
                ['n'=>'上海颂唐广告','c'=>$this->bumen3],
                ['n'=>'苏州颂唐广告','c'=>$this->bumen3_2],
                ['n'=>'南京颂唐广告','c'=>$this->bumen3_2],
                ['n'=>'安徽颂唐广告','c'=>$this->bumen3_2]
            ]],
            ['n'=>'尚晋公关','c'=>[
                ['n'=>'苏州尚晋公关','c'=>$this->zhiji1],
            ]],
            ['n'=>'元素互动','c'=>[
                ['n'=>'上海元素互动','c'=>$this->zhiji1],
            ]],
            ['n'=>'周道物业','c'=>[
                ['n'=>'苏州周道物业','c'=>$this->zhiji1],
            ]]
        ];
    }


    public function install2() {
        try {
            $exist = Position::find()->one();
            if($exist){
                throw new yii\base\Exception('Position has installed');
            }






            $this->array2value($this->arr,0,1);
            return true;
        }catch (\Exception $e)
        {
            echo  'Position 2222 install failed<br />';
            $message = $e->getMessage() . "\n";
            $errorInfo = $e instanceof \PDOException ? $e->errorInfo : null;
            echo $message;
            /*echo '<br/><br/>';
            var_dump($errorInfo);*/

            //throw new \Exception($message, $errorInfo, (int) $e->getCode(), $e);
            return false;
        }
    }

    public function array2value($arr,$pid,$level){

        $sqlbase = "INSERT IGNORE INTO `position`(`name`,`alias`,`p_id`,`is_leaf`,`is_last`,`is_class`,`level`,`ord`,`status`)
                VALUES";
        $ord = 99;
        $i = 1;
        foreach($arr as $a){
            $isLast = $i == count($arr)?1:0;
            $is_leaf = isset($a['l']) && $a['l']==1?1:0;
            $is_class = isset($a['cl']) && $a['cl']==1?1:0;
            $name = isset($a['n']) && $a['n']!=''?$a['n']:'默认名称';
            $alias = isset($a['a']) && $a['a']!=''?$a['a']:'默认别名';
            $sql = $sqlbase."('".$name."','".$alias."',$pid,$is_leaf,$isLast,$is_class,$level,$ord,1)";
            $cmd = Yii::$app->db->createCommand($sql);
            $cmd->execute();

            //$lastId = Yii::app()->db->lastInsertID;
            if(isset($a['c']) && !empty($a['c'])){
                $this->array2value($a['c'],Yii::$app->db->lastInsertID,$level+1);
            }
            $ord--;
            $i++;
        }
    }
}