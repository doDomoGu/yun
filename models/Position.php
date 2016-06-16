<?php

namespace app\models;
use yii;

class Position extends \yii\db\ActiveRecord
{
    public $childrenIds;
    public $childrenList;

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

    public $installArr;

    public function __construct(){
        //职位 普通设置1
        $zw_1 = [
            ['n'=>'总监','a'=>'zj','l'=>true],
            ['n'=>'经理','a'=>'jl','l'=>true],
            ['n'=>'主管','a'=>'zg','l'=>true],
            ['n'=>'专员','a'=>'zy','l'=>true]
        ];
        //职位 普通设置2
        /*$zw_2 = [
            ['n'=>'总监','a'=>'zj','l'=>true],
            ['n'=>'经理','a'=>'jl','l'=>true]
        ];*/
        //职位 普通设置3
        /*$zw_3 = [
            ['n'=>'指导','a'=>'zd','l'=>true],
            ['n'=>'师','a'=>'s','l'=>true],
            ['n'=>'专员','a'=>'zy','l'=>true],
            ['n'=>'助理','a'=>'zl','l'=>true]
        ];*/

        //职位 各个中心
        $zw_zx = [
            ['n'=>'总监','a'=>'zj','l'=>true],
            ['n'=>'经理','a'=>'jl','l'=>true],
            ['n'=>'主管','a'=>'zg','l'=>true],
            ['n'=>'专员','a'=>'zy','l'=>true]
        ];
        //职位 综合管理部
        $zw_zgb = [
            ['n'=>'总监','a'=>'zj','l'=>true],
            ['n'=>'经理','a'=>'jl','l'=>true],
            ['n'=>'主管','a'=>'zg','l'=>true],
            ['n'=>'专员','a'=>'zy','l'=>true],
        ];
        //职位 财务部
        $zw_cwb = [
            ['n'=>'总监','a'=>'zj','l'=>true],
            ['n'=>'经理','a'=>'jl','l'=>true],
            ['n'=>'主管','a'=>'zg','l'=>true],
            ['n'=>'专员','a'=>'zy','l'=>true],
        ];

        //职位 总经办
        $zw_zjb = [
            ['n'=>'总经理','a'=>'zjl','l'=>true],
            ['n'=>'副总经理','a'=>'fzjl','l'=>true],
            ['n'=>'总经理助理','a'=>'zjlzl','l'=>true],
            ['n'=>'总监','a'=>'zj','l'=>true],
            ['n'=>'专员','a'=>'zy','l'=>true],
        ];

        //部门 颂唐地产
        $bm_stdc = [
            ['n'=>'总经办','a'=>'zjb','c'=>$zw_zjb],
            ['n'=>'开发拓展部','a'=>'kftzb','c'=>$zw_1],
            ['n'=>'市场策划部','a'=>'scchb','c'=>$zw_1]
        ];





        //职位 颂唐地产 销售业务部
        $zw_stdc_xsywb = [
            ['n'=>'其他','a'=>'qt','l'=>true],
        ];

        /*$zw_stdc_xsywb = [
            ['n'=>'总监','a'=>'zj','l'=>true],
            ['n'=>'副总监','a'=>'fzj','l'=>true],
            ['n'=>'总经理','a'=>'zjl','l'=>true],
            ['n'=>'副总经理','a'=>'fzjl','l'=>true],
            ['n'=>'策划副总监','a'=>'chfzj','l'=>true],
        ];*/
        //职位 颂唐地产 案场
        $zw_stdc_ac = [
            ['n'=>'项目总监','a'=>'xmzj','l'=>true],
            ['n'=>'项目经理','a'=>'xmjl','l'=>true],
            ['n'=>'项目主管','a'=>'xmzg','l'=>true],
            ['n'=>'项目策划','a'=>'xmch','l'=>true],
            ['n'=>'项目行政','a'=>'xmxz','l'=>true],
            ['n'=>'客户代表','a'=>'khdb','l'=>true],
        ];


        //职位 颂唐广告 AE策划部
        $zw_stgg_aechb = [
            ['n'=>'AE/策划总监','a'=>'aechzy','l'=>true],
            ['n'=>'AE/策划经理','a'=>'aechjl','l'=>true],
            ['n'=>'AE/策划主管','a'=>'aechzg','l'=>true],
            ['n'=>'AE/策划师','a'=>'aechs','l'=>true],
            ['n'=>'AE/策划助理','a'=>'aechzl','l'=>true],
        ];


        //职位 颂唐广告 创作部
        $zw_stgg_czb = [
            ['n'=>'创作总监','a'=>'czzj','l'=>true],
            ['n'=>'创作指导','a'=>'czzd','l'=>true],
            ['n'=>'创作师','a'=>'czs','l'=>true],
            ['n'=>'创作助理','a'=>'czzl','l'=>true],
        ];



        //职位 上海颂唐广告 创作部
        /*$zw_shstgg_czb = [
            ['n'=>'部门管理','a'=>'bmgl','c'=>$zw_2],
            ['n'=>'设计','a'=>'sjs','c'=>$zw_3],
            ['n'=>'美术','a'=>'ms','c'=>$zw_3],
            ['n'=>'文案','a'=>'wa','c'=>$zw_3],
        ];*/

        //职位 苏州颂唐广告 创作部
        /*$zw_szstgg_czb = [
            ['n'=>'文案总监','a'=>'wazj','l'=>true],
            ['n'=>'文案专员','a'=>'wazy','l'=>true],
            ['n'=>'设计总监','a'=>'sjzj','l'=>true],
            ['n'=>'设计专员','a'=>'sjzy','l'=>true],
            ['n'=>'策划总监','a'=>'chzj','l'=>true],
            ['n'=>'策划专员','a'=>'chzy','l'=>true]
        ];*/

        //职位 上海颂唐广告 策划部
        /*$zw_shstgg_chb = [
            ['n'=>'策划经理','a'=>'chjl','l'=>true],
            ['n'=>'策划师','a'=>'chs','l'=>true],
            ['n'=>'策划助理','a'=>'chzl','l'=>true],
            ['n'=>'策划专员','a'=>'chzy','l'=>true]
        ];*/
        //职位 上海颂唐广告 执行策划
        /*$zw_shstgg_zxch = [
            ['n'=>'执行策划','a'=>'zxch','l'=>true],
        ];*/

        //部门 颂唐地产 上海
        $bm_dc_sh = array_merge($bm_stdc,[
            ['n'=>'销售业务部','a'=>'xsywb','c'=>array_merge([
                ['n'=>'宝山上坤上街案场','a'=>'bssksjac','c'=>$zw_stdc_ac],
                ['n'=>'绍兴锦园案场','a'=>'sxjyac','c'=>$zw_stdc_ac],
                ['n'=>'天津麦谷案场','a'=>'tjmgac','c'=>$zw_stdc_ac],
            ],$zw_stdc_xsywb)]
        ]);
        $bm_dc_sh_2 = array_merge($bm_stdc,[
            ['n'=>'销售业务部','a'=>'xsywb','c'=>array_merge([
                ['n'=>'默认案场一','a'=>'ac_1','c'=>$zw_stdc_ac],
                ['n'=>'默认案场二','a'=>'ac_2','c'=>$zw_stdc_ac],
            ],$zw_stdc_xsywb)]
        ]);

        //部门 颂唐地产 无锡
        $bm_dc_wx = array_merge($bm_stdc,[
            ['n'=>'销售业务部','a'=>'xsywb','c'=>array_merge([
                ['n'=>'国信世家案场','a'=>'gxsjac','c'=>$zw_stdc_ac],
                ['n'=>'君悦案场','a'=>'jyac','c'=>$zw_stdc_ac],
                ['n'=>'天氿御城案场','a'=>'tgycac','c'=>$zw_stdc_ac],
                ['n'=>'中交上东湾案场','a'=>'zjsdwac','c'=>$zw_stdc_ac],
                ['n'=>'天御广场案场','a'=>'tygcac','c'=>$zw_stdc_ac],
                ['n'=>'星湖花海案场','a'=>'xhhhac','c'=>$zw_stdc_ac],
                ['n'=>'赛维拉案场','a'=>'slwac','c'=>$zw_stdc_ac],
                ['n'=>'城开国际案场','a'=>'ckgjac','c'=>$zw_stdc_ac],
                ['n'=>'金鑫广场案场','a'=>'jxgcac','c'=>$zw_stdc_ac],
            ],$zw_stdc_xsywb)]
        ]);

        //部门 颂唐地产 苏州
        $bm_dc_sz = array_merge($bm_stdc,[
            ['n'=>'销售业务部','a'=>'xsywb','c'=>array_merge([
                ['n'=>'鸿汉案场','a'=>'hhac','c'=>$zw_stdc_ac],
                ['n'=>'瑞景国际案场','a'=>'rjgjac','c'=>$zw_stdc_ac],
                ['n'=>'恒业站前案场','a'=>'hyzqac','c'=>$zw_stdc_ac],
                ['n'=>'华邦案场','a'=>'hbac','c'=>$zw_stdc_ac],
                ['n'=>'常州莱蒙城案场','a'=>'czlmcac','c'=>$zw_stdc_ac],
            ],$zw_stdc_xsywb)]
        ]);

        //部门 颂唐地产 南京
        $bm_dc_nj = array_merge($bm_stdc,[
            ['n'=>'销售业务部','a'=>'xsywb','c'=>array_merge([
                ['n'=>'卧龙湖案场','a'=>'wlhac','c'=>$zw_stdc_ac],
            ],$zw_stdc_xsywb)]
        ]);

        //部门 颂唐地产 合肥
        $bm_dc_hf = array_merge($bm_stdc,[
            ['n'=>'销售业务部','a'=>'xsywb','c'=>array_merge([
                ['n'=>'阜阳金悦国际案场','a'=>'fyjygjac','c'=>$zw_stdc_ac],
                ['n'=>'阜阳幸福华庭案场','a'=>'fyxfhtac','c'=>$zw_stdc_ac],
                ['n'=>'黄山秀湖秘境案场','a'=>'hsxhmjac','c'=>$zw_stdc_ac],
                ['n'=>'池州江南世家案场','a'=>'czjnsjac','c'=>$zw_stdc_ac],
                ['n'=>'巢湖盛景广场案场','a'=>'chsjgcac','c'=>$zw_stdc_ac],
            ],$zw_stdc_xsywb)]
        ]);
        //部门 颂唐地产 呵呵浩特
        $bm_dc_hhht = array_merge($bm_stdc,[
            ['n'=>'销售业务部','a'=>'xsywb','c'=>array_merge([
                ['n'=>'金华学府案场','a'=>'jhxfac','c'=>$zw_stdc_ac],
            ],$zw_stdc_xsywb)]
        ]);

        //部门 颂唐广告 上海
        $bm_gg_2 = [
            ['n'=>'总经办','a'=>'zjb','c'=>$zw_zjb],
            ['n'=>'开发拓展部','a'=>'kftzb','c'=>$zw_1],
            ['n'=>'AE/策划部','a'=>'aechb','c'=>$zw_stgg_aechb],
            ['n'=>'创作部','a'=>'czb','c'=>[
                ['n'=>'创作部一组','a'=>'czb_1','c'=>$zw_stgg_czb],
                ['n'=>'创作部二组','a'=>'czb_2','c'=>$zw_stgg_czb],
                ['n'=>'创作部三组','a'=>'czb_3','c'=>$zw_stgg_czb],
                ['n'=>'创作部四组','a'=>'czb_4','c'=>$zw_stgg_czb]
            ]],
        ];

        //部门 颂唐广告
        $bm_gg = [
            ['n'=>'总经办','a'=>'zjb','c'=>$zw_zjb],
            ['n'=>'开发拓展部','a'=>'kftzb','c'=>$zw_1],
            ['n'=>'AE/策划部','a'=>'aechb','c'=>$zw_stgg_aechb],
            ['n'=>'创作部','a'=>'czb','c'=>$zw_stgg_czb]
        ];
        $zw_shrxsy_ac = [
            ['n'=>'项目总监','a'=>'xmzj','l'=>true],
            ['n'=>'项目经理','a'=>'xmjl','l'=>true],
            ['n'=>'项目主管','a'=>'xmfjl','l'=>true],
            ['n'=>'项目策划','a'=>'ch','l'=>true],
            ['n'=>'项目行政','a'=>'acxz','l'=>true],
            ['n'=>'招商代表','a'=>'sxs','l'=>true]
        ];
        //部门 日鑫商业 上海
        $bm_rx_sh = [
            ['n'=>'总经办','a'=>'zjb','c'=>$zw_zjb],
            ['n'=>'品牌拓展部','a'=>'pptzb','c'=>$zw_1],
            ['n'=>'商业策划部','a'=>'sychb','c'=>$zw_1],
            ['n'=>'商业招商部','a'=>'syzsb','c'=>[
                ['n'=>'吴江案场','a'=>'wjac','c'=>$zw_shrxsy_ac],
                ['n'=>'阜阳案场','a'=>'fyac','c'=>$zw_shrxsy_ac],
                ['n'=>'彩生活案场','a'=>'cshac','c'=>$zw_shrxsy_ac],
            ]]
        ];

        //职位  汉佑房屋 门店
        $zw_fw_md = [
            ['n'=>'店长','a'=>'dz','l'=>true],
            ['n'=>'店长助理','a'=>'dzzl','l'=>true],
            ['n'=>'置业顾问','a'=>'zygw','l'=>true],
        ];
        //部门 汉佑房屋
        $bm_fw = [
            ['n'=>'总经办','a'=>'zjb','c'=>$zw_zjb],
            ['n'=>'开发拓展部','a'=>'kftzb','c'=>$zw_1],
            ['n'=>'门店','a'=>'md','c'=>[
                ['n'=>'门店一','a'=>'md_1','c'=>$zw_fw_md],
                ['n'=>'门店二','a'=>'md_2','c'=>$zw_fw_md],
            ]]
        ];


        //职位  鸿汉经纪 总经办
        $zw_jj_zjb = [
            ['n'=>'总经理','a'=>'zjl','l'=>true],
            ['n'=>'副总经理','a'=>'fzjl','l'=>true],
            ['n'=>'区域总监','a'=>'qyzj','l'=>true],
            ['n'=>'总经理助理','a'=>'zjlzl','l'=>true],
            ['n'=>'专员','a'=>'zy','l'=>true],
        ];

        //职位 鸿汉经纪 销售业务部
        $zw_jj_xsywb = [
            ['n'=>'其他','a'=>'qt','l'=>true],
        ];

        //职位 鸿汉经纪 销售业务部 项目
        $zw_jj_xm = [
            ['n'=>'项目总监','a'=>'xmzj','l'=>true],
            ['n'=>'项目经理','a'=>'xmjl','l'=>true],
            ['n'=>'项目主管','a'=>'xmzg','l'=>true],
            ['n'=>'项目策划','a'=>'xmch','l'=>true],
            ['n'=>'项目行政','a'=>'xmxz','l'=>true],
            ['n'=>'销售代表','a'=>'xsdb','l'=>true],
        ];

        //部门 鸿汉经纪 苏州
        $bm_jj_sz = [
            ['n'=>'总经办','a'=>'zjb','c'=>$zw_jj_zjb],
            ['n'=>'销售业务部','a'=>'xsywb','c'=>array_merge([
                ['n'=>'项目一','a'=>'xm_1','c'=>$zw_jj_xm],
                ['n'=>'项目二','a'=>'xm_2','c'=>$zw_jj_xm],
            ],$zw_jj_xsywb)]
        ];

        //部门 鸿汉经纪 无锡
        $bm_jj_wx = [
            ['n'=>'总经办','a'=>'zjb','c'=>$zw_jj_zjb],
            ['n'=>'销售业务部','a'=>'xsywb','c'=>array_merge([
                ['n'=>'苏宁天氿项目','a'=>'sntjxm','c'=>$zw_jj_xm],
                ['n'=>'君悦项目','a'=>'sntjxm','c'=>$zw_jj_xm],
                ['n'=>'金水名都项目','a'=>'jsmdxm','c'=>$zw_jj_xm],
                ['n'=>'中交上东湾项目','a'=>'zjsdwxm','c'=>$zw_jj_xm],
                ['n'=>'赛维拉项目','a'=>'swlxm','c'=>$zw_jj_xm],
                ['n'=>'国信世家项目','a'=>'gxsjxm','c'=>$zw_jj_xm],
                ['n'=>'城开国际项目','a'=>'ckgjxm','c'=>$zw_jj_xm],
            ],$zw_jj_xsywb)]
        ];

        $this->installArr = [
            ['n'=>'系统管理员','l'=>true,'a'=>'admin'],
            ['n'=>'颂唐机构','a'=>'stjg','c'=>[
                ['n'=>'发展管控中心','a'=>'fzgkzx','c'=>$zw_zx],
                ['n'=>'行政管控中心','a'=>'xzgkzx','c'=>$zw_zx],
                ['n'=>'财务管控中心','a'=>'cwgkzx','c'=>$zw_zx],
                ['n'=>'企宣管控中心','a'=>'qxgkzx','c'=>$zw_zx],
                ['n'=>'市场策略中心','a'=>'scclzx','c'=>$zw_zx],
                ['n'=>'上海','a'=>'sh','c'=>[
                    ['n'=>'综合管理部','a'=>'zhglb','c'=>$zw_zgb],
                    ['n'=>'财务部','a'=>'cwb','c'=>$zw_cwb],
                    ['n'=>'颂唐地产','a'=>'stdc','c'=>$bm_dc_sh],
                    ['n'=>'颂唐地产(二)','a'=>'stdc','c'=>$bm_dc_sh_2],
                    ['n'=>'颂唐广告','a'=>'stgg','c'=>$bm_gg],
                    ['n'=>'日鑫商业','a'=>'rxsy','c'=>$bm_rx_sh]
                ]],
                ['n'=>'苏州','a'=>'sz','c'=>[
                    ['n'=>'综合管理部','a'=>'zhglb','c'=>$zw_zgb],
                    ['n'=>'财务部','a'=>'cwb','c'=>$zw_cwb],
                    ['n'=>'颂唐地产','a'=>'stdc','c'=>$bm_dc_sz],
                    ['n'=>'颂唐广告','a'=>'stgg','c'=>$bm_gg_2],
                    ['n'=>'汉佑房屋','a'=>'hyfw','c'=>$bm_fw],
                    ['n'=>'鸿汉经纪','a'=>'hyfw','c'=>$bm_jj_sz],
                ]],
                ['n'=>'无锡','a'=>'wx','c'=>[
                    ['n'=>'综合管理部','a'=>'zhglb','c'=>$zw_zgb],
                    ['n'=>'财务部','a'=>'cwb','c'=>$zw_cwb],
                    ['n'=>'颂唐地产','a'=>'stdc','c'=>$bm_dc_wx],
                    ['n'=>'颂唐广告','a'=>'stgg','c'=>$bm_gg],
                    ['n'=>'汉佑房屋','a'=>'hyfw','c'=>$bm_fw],
                    ['n'=>'鸿汉经纪','a'=>'hyfw','c'=>$bm_jj_wx],
                ]],
                ['n'=>'南京','a'=>'nj','c'=>[
                    ['n'=>'综合管理部','a'=>'zhglb','c'=>$zw_zgb],
                    ['n'=>'财务部','a'=>'cwb','c'=>$zw_cwb],
                    ['n'=>'颂唐地产','a'=>'stdc','c'=>$bm_dc_nj],
                    ['n'=>'颂唐广告','a'=>'stgg','c'=>$bm_gg],
                ]],
                ['n'=>'合肥','a'=>'hf','c'=>[
                    ['n'=>'综合管理部','a'=>'zhglb','c'=>$zw_zgb],
                    ['n'=>'财务部','a'=>'cwb','c'=>$zw_cwb],
                    ['n'=>'颂唐地产','a'=>'stdc','c'=>$bm_dc_hf],
                    ['n'=>'颂唐广告','a'=>'stgg','c'=>$bm_gg],
                ]],
                ['n'=>'呼和浩特','a'=>'hhht','c'=>[
                    ['n'=>'综合管理部','a'=>'zhglb','c'=>$zw_zgb],
                    ['n'=>'财务部','a'=>'cwb','c'=>$zw_cwb],
                    ['n'=>'颂唐地产','a'=>'stdc','c'=>$bm_dc_hhht],
                ]]
            ]],
        ];
    }


    public function install2() {
        try {
            $exist = Position::find()->one();
            if($exist){
                throw new yii\base\Exception('Position has installed');
            }

            $this->array2value($this->installArr,0,1);
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