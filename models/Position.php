<?php

namespace app\models;
use yii;

class Position extends \yii\db\ActiveRecord
{
    public $childrenIds;

    public function rules()
    {
        return [
            [['name', 'alias'], 'required'],
            [['id', 'status', 'p_id', 'ord', 'is_leaf', 'is_last', 'level', 'is_class'], 'integer'],
            ['name', 'string', 'max'=>100],
            [['describe', 'full_alias', 'shuoming','zhiquan','zhize','zhibiao'],'safe']
        ];
    }

    public function attributeLabels(){
        return [
            'name' => '名称',
            'alias' => '别名',
            'full_alias' => '完整别名',
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

/*ALTER TABLE `position` ADD `full_alias` VARCHAR(255) DEFAULT NULL AFTER `alias`;*/

    public $zhiji1;
    public $zhiji2;
    public $zhiji2_2;
    public $zhiji3;
    public $zhiji4;
    public $zhiji_zgb;
    public $anchang1;
    public $anchang2;
    public $guanggao;
    public $bumen1;
    public $bumen1_2;
    public $bumen1_stdc_sh;
    public $bumen1_stdc_wx;
    public $bumen1_rxsy_sh;
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
            ['n'=>'总经理','a'=>'zjl','l'=>true],
            ['n'=>'副总经理','a'=>'fzjl','l'=>true],
            ['n'=>'办公室主任','a'=>'bgszr','l'=>true],
            ['n'=>'总监','a'=>'zj','l'=>true],
            ['n'=>'总经理助理','a'=>'zjlzl','l'=>true]
        ];

        $this->zhiji2_2 = [
            ['n'=>'总经理','a'=>'zjl','l'=>true],
            ['n'=>'副总经理','a'=>'fzjl','l'=>true],
            ['n'=>'办公室主任','a'=>'bgszr','l'=>true],
            ['n'=>'总监','a'=>'zj','l'=>true],
            ['n'=>'总经理助理','a'=>'zjlzl','l'=>true],
            ['n'=>'司机','a'=>'sj','l'=>true]
        ];

        $this->zhiji3 = [
            ['n'=>'总监','a'=>'zj','l'=>true],
            ['n'=>'副总监','a'=>'fzj','l'=>true],
            ['n'=>'经理','a'=>'jl','l'=>true]
        ];

        $this->zhiji4 = [
            ['n'=>'指导','a'=>'zd','l'=>true],
            ['n'=>'师','a'=>'s','l'=>true],
            ['n'=>'专员','a'=>'zy','l'=>true],
            ['n'=>'助理','a'=>'zl','l'=>true]
        ];


        $this->zhiji_zgb = [
            ['n'=>'总监','a'=>'zj','l'=>true],
            ['n'=>'副总监','a'=>'fzj','l'=>true],
            ['n'=>'经理','a'=>'jl','l'=>true],
            ['n'=>'主管','a'=>'zg','l'=>true],
            ['n'=>'专员','a'=>'zy','l'=>true],
            ['n'=>'行政主管','a'=>'xzzg','l'=>true],
            ['n'=>'财务总监','a'=>'cwzj','l'=>true],
            ['n'=>'主办会计','a'=>'zbkj','l'=>true],
            ['n'=>'会计','a'=>'kj','l'=>true],
            ['n'=>'出纳','a'=>'cn','l'=>true],
            ['n'=>'人事经理','a'=>'rsjl','l'=>true],
            ['n'=>'人事主管','a'=>'rszg','l'=>true],
            ['n'=>'人事专员','a'=>'rszy','l'=>true],
            ['n'=>'前台','a'=>'qt','l'=>true],
        ];


        $this->anchang1 = [
            ['n'=>'项目管理','a'=>'xmgl','c'=>[
                ['n'=>'总监','a'=>'zj','l'=>true],
                ['n'=>'副总监','a'=>'fzj','l'=>true],
                ['n'=>'经理','a'=>'jl','l'=>true]
            ]],
            ['n'=>'案场策划','a'=>'acch','c'=>[
                ['n'=>'副总监','a'=>'fzj','l'=>true],
                ['n'=>'经理','a'=>'jl','l'=>true],
                ['n'=>'副经理','a'=>'fjl','l'=>true],
                ['n'=>'主管','a'=>'zg','l'=>true],
                ['n'=>'专员','a'=>'zy','l'=>true]
            ]],
            ['n'=>'案场销售','a'=>'acxs','c'=>[
                ['n'=>'客户主管','a'=>'khzg','l'=>true],
                ['n'=>'销售总监','a'=>'xszj','l'=>true],
                ['n'=>'销售主管','a'=>'xszg','l'=>true],
                ['n'=>'销售经理','a'=>'xsjl','l'=>true],
                ['n'=>'销售专员','a'=>'xszy','l'=>true]
            ]],
            ['n'=>'案场客服','a'=>'ackf','c'=>[
                ['n'=>'客户代表','a'=>'khdb','l'=>true]
            ]],
            ['n'=>'案场行政','a'=>'acxz','c'=>[
                ['n'=>'主管','a'=>'zg','l'=>true],
                ['n'=>'专员','a'=>'zy','l'=>true]
            ]],
            ['n'=>'案场招商','a'=>'aczs','c'=>[
                ['n'=>'总监','a'=>'zj','l'=>true],
                ['n'=>'副总监','a'=>'fzj','l'=>true],
                ['n'=>'主管','a'=>'zg','l'=>true],
                ['n'=>'专员','a'=>'zy','l'=>true]
            ]]
        ];

        $this->anchang2 = [
            ['n'=>'总监','a'=>'zj','l'=>true],
            ['n'=>'副总监','a'=>'fzj','l'=>true],
            ['n'=>'经理','a'=>'jl','l'=>true],
            ['n'=>'副经理','a'=>'fjl','l'=>true],
            ['n'=>'主管','a'=>'zg','l'=>true],
            ['n'=>'案场行政','a'=>'acxz','l'=>true],
            ['n'=>'置业顾问','a'=>'zygw','l'=>true],
            ['n'=>'实习生','a'=>'sxs','l'=>true]
        ];

        $this->guanggao = [
            ['n'=>'部门管理','a'=>'bmgl','c'=>$this->zhiji3],
            ['n'=>'设计','a'=>'sj','c'=>$this->zhiji4],
            ['n'=>'文案','a'=>'wa','c'=>$this->zhiji4],
        ];
        $this->bumen1 = [
            ['n'=>'总经办','a'=>'zjb','c'=>$this->zhiji2_2],
            //['n'=>'财务部','a'=>'cwb','c'=>$this->zhiji1],
            ['n'=>'综合管理部','a'=>'zhglb','c'=>$this->zhiji_zgb],
            ['n'=>'开发拓展部','a'=>'kftzb','c'=>$this->zhiji1],
            ['n'=>'市场策划部','a'=>'scchb','c'=>$this->zhiji1],
            ['n'=>'销售业务部','a'=>'xsywb','c'=>[
                ['n'=>'总经理','a'=>'zjl','l'=>true],
                ['n'=>'副总经理','a'=>'fzjl','l'=>true],
                ['n'=>'总监','a'=>'zj','l'=>true],
                ['n'=>'总经理助理','a'=>'zjlzl','l'=>true],
                ['n'=>'项目案场[A]','a'=>'xmac_1','c'=>$this->anchang1],
                ['n'=>'项目案场[B]','a'=>'xmac_2','c'=>$this->anchang1],
                ['n'=>'项目案场[C]','a'=>'xmac_3','c'=>$this->anchang1]
            ]]
        ];
        $this->bumen1_2 = [
            ['n'=>'总经办','a'=>'zjb','c'=>$this->zhiji2_2],
            ['n'=>'综合管理部','a'=>'zhglb','c'=>$this->zhiji_zgb],
            ['n'=>'开发拓展部','a'=>'kftzb','c'=>$this->zhiji1],
            ['n'=>'市场策划部','a'=>'scchb','c'=>$this->zhiji1],
            ['n'=>'销售业务部','a'=>'xsywb','c'=>[
                ['n'=>'总经理','a'=>'zjl','l'=>true],
                ['n'=>'副总经理','a'=>'fzjl','l'=>true],
                ['n'=>'总监','a'=>'zj','l'=>true],
                ['n'=>'总经理助理','a'=>'zjlzl','l'=>true],
                ['n'=>'项目案场[A]','a'=>'xmac_1','c'=>$this->anchang1],
                ['n'=>'项目案场[B]','a'=>'xmac_2','c'=>$this->anchang1],
                ['n'=>'项目案场[C]','a'=>'xmac_3','c'=>$this->anchang1]
            ]]
        ];

        $this->bumen1_stdc_sh = [
            ['n'=>'总经办','a'=>'zjb','c'=>$this->zhiji2_2],
            //['n'=>'财务部','a'=>'cwb','c'=>$this->zhiji1],
            ['n'=>'综合管理部','a'=>'zhglb','c'=>$this->zhiji_zgb],
            ['n'=>'开发拓展部','a'=>'kftzb','c'=>$this->zhiji1],
            ['n'=>'市场策划部','a'=>'scchb','c'=>$this->zhiji1],
            ['n'=>'销售业务部','a'=>'xsywb','c'=>[
                ['n'=>'总经理','a'=>'zjl','l'=>true],
                ['n'=>'副总经理','a'=>'fzjl','l'=>true],
                ['n'=>'总监','a'=>'zj','l'=>true],
                ['n'=>'总经理助理','a'=>'zjlzl','l'=>true],
                ['n'=>'宝山上坤上街案场','a'=>'bssksjac','c'=>$this->anchang1],
                ['n'=>'绍兴锦园案场','a'=>'sxjyac','c'=>$this->anchang1],
                ['n'=>'天津麦谷案场','a'=>'tjmgac','c'=>$this->anchang1],
                ['n'=>'项目案场[A]','a'=>'xmac_1','c'=>$this->anchang1],
                ['n'=>'项目案场[B]','a'=>'xmac_2','c'=>$this->anchang1],
                ['n'=>'项目案场[C]','a'=>'xmac_3','c'=>$this->anchang1]
            ]]
        ];

        $this->bumen1_stdc_wx = [
            ['n'=>'总经办','a'=>'zjb','c'=>$this->zhiji2_2],
            //['n'=>'财务部','a'=>'cwb','c'=>$this->zhiji1],
            ['n'=>'综合管理部','a'=>'zhglb','c'=>$this->zhiji_zgb],
            ['n'=>'开发拓展部','a'=>'kftzb','c'=>$this->zhiji1],
            ['n'=>'市场策划部','a'=>'scchb','c'=>$this->zhiji1],
            ['n'=>'销售业务部','a'=>'xsywb','c'=>[
                ['n'=>'总经理','a'=>'zjl','l'=>true],
                ['n'=>'副总经理','a'=>'fzjl','l'=>true],
                ['n'=>'总监','a'=>'zj','l'=>true],
                ['n'=>'总经理助理','a'=>'zjlzl','l'=>true],
                ['n'=>'国信世家案场','a'=>'gxsjac','c'=>$this->anchang2],
                ['n'=>'君悦案场','a'=>'jyac','c'=>$this->anchang2],
                ['n'=>'天氿御城案场','a'=>'tgycac','c'=>$this->anchang2],
                ['n'=>'中交上东湾案场','a'=>'zjsdwac','c'=>$this->anchang2],
                ['n'=>'天御广场案场','a'=>'tygcac','c'=>$this->anchang2],
                ['n'=>'星湖花海案场','a'=>'xhhhac','c'=>$this->anchang2],
                ['n'=>'赛维拉案场','a'=>'slwac','c'=>$this->anchang2],
                ['n'=>'城开国际案场','a'=>'ckgjac','c'=>$this->anchang2],
                ['n'=>'金鑫广场案场','a'=>'jxgcac','c'=>$this->anchang2],
                ['n'=>'项目案场[A]','a'=>'xmac_1','c'=>$this->anchang2],
                ['n'=>'项目案场[B]','a'=>'xmac_2','c'=>$this->anchang2],
                ['n'=>'项目案场[C]','a'=>'xmac_3','c'=>$this->anchang2]
            ]]
        ];

        $this->bumen1_rxsy_sh = [
            ['n'=>'总经办','a'=>'zjb','c'=>$this->zhiji2_2],
            //['n'=>'财务部','a'=>'cwb','c'=>$this->zhiji1],
            ['n'=>'综合管理部','a'=>'zhglb','c'=>$this->zhiji_zgb],
            ['n'=>'开发拓展部','a'=>'kftzb','c'=>$this->zhiji1],
            ['n'=>'市场策划部','a'=>'scchb','c'=>$this->zhiji1],
            ['n'=>'销售业务部','a'=>'xsywb','c'=>[
                ['n'=>'总经理','a'=>'zjl','l'=>true],
                ['n'=>'副总经理','a'=>'fzjl','l'=>true],
                ['n'=>'总监','a'=>'zj','l'=>true],
                ['n'=>'总经理助理','a'=>'zjlzl','l'=>true],
                ['n'=>'吴江案场','a'=>'wjac','c'=>$this->anchang1],
                ['n'=>'阜阳案场','a'=>'fyac','c'=>$this->anchang1],
                ['n'=>'彩生活案场','a'=>'cshac','c'=>$this->anchang1],
                ['n'=>'项目案场[A]','a'=>'xmac_1','c'=>$this->anchang1],
                ['n'=>'项目案场[B]','a'=>'xmac_2','c'=>$this->anchang1],
                ['n'=>'项目案场[C]','a'=>'xmac_3','c'=>$this->anchang1]
            ]]
        ];

        $this->bumen2 = [
            //['n'=>'财务部','a'=>'cwb','c'=>$this->zhiji1],
            ['n'=>'综合管理部','a'=>'zhglb','c'=>$this->zhiji_zgb],
            ['n'=>'销售业务部','a'=>'xsywb','c'=>[
                ['n'=>'项目案场[A]','a'=>'xmac_1','c'=>$this->zhiji1],
                ['n'=>'项目案场[B]','a'=>'xmac_2','c'=>$this->zhiji1]
            ]]
        ];

        $this->bumen2_2 = [
            ['n'=>'销售业务部','a'=>'xsywb','c'=>[
                ['n'=>'项目案场[A]','a'=>'xmac_1','c'=>$this->zhiji1],
                ['n'=>'项目案场[B]','a'=>'xmac_2','c'=>$this->zhiji1]
            ]]
        ];

        $this->bumen3 = [
            ['n'=>'总经办','a'=>'zjb','c'=>$this->zhiji2_2],
            //['n'=>'财务部','a'=>'cwb','c'=>$this->zhiji1],
            ['n'=>'综合管理部','a'=>'zhglb','c'=>$this->zhiji_zgb],
            ['n'=>'开发拓展部','a'=>'kftzb','c'=>$this->zhiji1],
            ['n'=>'AE策划部','a'=>'aechb','c'=>$this->zhiji1],
            ['n'=>'创意部','a'=>'cyb','c'=>$this->guanggao],
            ['n'=>'创作部','a'=>'czb','c'=>[
                ['n'=>'创作1部','a'=>'czb_1','c'=>$this->guanggao],
                ['n'=>'创作2部','a'=>'czb_2','c'=>$this->guanggao],
                ['n'=>'创作3部','a'=>'czb_3','c'=>$this->guanggao]
            ]],
        ];

        $this->bumen3_2 = [
            ['n'=>'总经办','a'=>'zjb','c'=>$this->zhiji2_2],
            ['n'=>'开发拓展部','a'=>'kftzb','c'=>$this->zhiji1],
            ['n'=>'AE策划部','a'=>'aechb','c'=>$this->zhiji1],
            ['n'=>'创意部','a'=>'cyb','c'=>$this->guanggao],
            ['n'=>'创作部','a'=>'czb','c'=>[
                ['n'=>'平面设计','a'=>'pmsj','l'=>true],
                ['n'=>'美术指导','a'=>'mszd','l'=>true],
                ['n'=>'文案','a'=>'wa','l'=>true],
                ['n'=>'创作1部','a'=>'czb_1','c'=>$this->guanggao],
                ['n'=>'创作2部','a'=>'czb_2','c'=>$this->guanggao],
                ['n'=>'创作3部','a'=>'czb_3','c'=>$this->guanggao]
            ]],
        ];



        $this->arr = [
            ['n'=>'管理员','l'=>true,'a'=>'admin'],
            ['n'=>'颂唐机构','a'=>'stjg','c'=>[
                ['n'=>'上海总部平台','a'=>'shzbpt','c'=>[
                    ['n'=>'总经办','a'=>'zjb','c'=>[
                        ['n'=>'董事长','a'=>'dsz','l'=>true],
                        ['n'=>'总经理','a'=>'zjl','l'=>true],
                        ['n'=>'副总经理','a'=>'fzjl','l'=>true],
                        ['n'=>'总监','a'=>'zj','l'=>true],
                        ['n'=>'总经理助理','a'=>'zjlzl','l'=>true],
                        ['n'=>'司机','a'=>'sj','l'=>true]
                    ]],
                    ['n'=>'综合管理部','a'=>'zhglb','c'=>$this->zhiji_zgb],
                    ['n'=>'企宣管控中心','a'=>'qxgkzx','c'=>$this->zhiji1],
                    ['n'=>'发展管控中心','a'=>'fzgkzx','c'=>$this->zhiji1],
                    ['n'=>'行政管控中心','a'=>'xzgkzx','c'=>$this->zhiji1],
                    ['n'=>'财务管控中心','a'=>'cwgkzx','c'=>$this->zhiji1]
                ]]
            ]],
            ['n'=>'市场策略中心','a'=>'scclzx','c'=>[
                ['n'=>'上海总部平台','a'=>'shzbpt','c'=>$this->zhiji1]
            ]],

            ['n'=>'颂唐地产','a'=>'stdc','c'=>[
                ['n'=>'上海','a'=>'sh','c'=>$this->bumen1_stdc_sh],
                ['n'=>'无锡','a'=>'wx','c'=>$this->bumen1_stdc_wx],
                /*['n'=>'苏州','a'=>'sz','c'=>$this->bumen1_2],
                ['n'=>'南京','a'=>'nj','c'=>$this->bumen1_2],
                ['n'=>'安徽','a'=>'ah','c'=>$this->bumen1_2],
                ['n'=>'苏北','a'=>'sb','c'=>$this->bumen1_2],*/
            ]],

            ['n'=>'颂唐广告','a'=>'stgg','c'=>[
                ['n'=>'上海','a'=>'sh','c'=>$this->bumen3_2],
                /*['n'=>'苏州','a'=>'sz','c'=>$this->bumen3_2],
                ['n'=>'南京','a'=>'nj','c'=>$this->bumen3_2],
                ['n'=>'安徽','a'=>'ah','c'=>$this->bumen3_2]*/
            ]],

            ['n'=>'日鑫商业','a'=>'rxsy','c'=>[
                ['n'=>'上海','a'=>'sh','c'=>$this->bumen1_rxsy_sh],
                /*['n'=>'苏州','a'=>'sz','c'=>$this->bumen1_2],
                ['n'=>'无锡','a'=>'wx','c'=>$this->bumen1_2],
                ['n'=>'南京','a'=>'nj','c'=>$this->bumen1_2],
                ['n'=>'安徽','a'=>'ah','c'=>$this->bumen1_2],
                ['n'=>'苏北','a'=>'sb','c'=>$this->bumen1_2],*/
            ]],            /*
            ['n'=>'华麦建筑','a'=>'hmjz','c'=>[
                ['n'=>'上海','a'=>'sh']
            ]],
            ['n'=>'汉佑房屋','a'=>'hyfw','c'=>[
                ['n'=>'苏州','a'=>'sz','c'=>[
                    ['n'=>'新湖明珠店','a'=>'xhmzd','c'=>$this->zhiji1],
                    ['n'=>'石湖店','a'=>'shd','c'=>$this->zhiji1]
                ]],
                ['n'=>'无锡','a'=>'wx']
            ]],
            ['n'=>'鸿汉经纪','a'=>'hhjj','c'=>[
               ['n'=>'上海','a'=>'sh','c'=>$this->bumen2],
               ['n'=>'苏州','a'=>'sz','c'=>$this->bumen2_2],
               ['n'=>'无锡','a'=>'wx','c'=>$this->bumen2_2],
               ['n'=>'南京','a'=>'nj','c'=>$this->bumen2_2],
               ['n'=>'合肥','a'=>'hf','c'=>$this->bumen2_2],
            ]],
            ['n'=>'明致置业','a'=>'mzzy','c'=>[
               ['n'=>'上海','a'=>'sh'],
               ['n'=>'南京','a'=>'nj']
            ]],


            ['n'=>'尚晋公关','a'=>'sjgg','c'=>[
                ['n'=>'苏州','a'=>'sz','c'=>$this->zhiji1],
            ]],
            ['n'=>'元素互动','a'=>'yshd','c'=>[
                ['n'=>'上海','a'=>'sh','c'=>$this->zhiji1],
            ]],
            ['n'=>'周道物业','a'=>'zdwy','c'=>[
                ['n'=>'苏州','a'=>'sz','c'=>$this->zhiji1],
            ]]*/
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