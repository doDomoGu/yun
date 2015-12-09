<?php

namespace app\models;
use yii;

class Dir extends \yii\db\ActiveRecord
{
    public $childrenIds;
    public $childrenList;

    public function rules()
    {
        return [
            [['name', 'p_id'], 'required'],
            [['id', 'type', 'ord', 'level', 'is_leaf', 'is_last', 'p_id', 'status'], 'integer'],
            [['describe'], 'safe']
        ];
    }
/*CREATE TABLE `dir` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`name` varchar(100) NOT NULL COMMENT '目录/项目名称',
`describe` text NOT NULL,
`type` tinyint(4) unsigned NOT NULL COMMENT '板块ID',
`more_cate` tinyint(1) unsigned NOT NULL COMMENT '更多的分类',
`p_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '父位置id,一级位置为0',
`level` int(4) unsigned DEFAULT '0' COMMENT '层级',
`is_leaf` tinyint(1) unsigned DEFAULT '0' COMMENT '0:目录;1:项目;',
`is_last` tinyint(1) unsigned DEFAULT '0' COMMENT '实际排序当前同级下最后一个',
`ord` int(4) unsigned DEFAULT '0' COMMENT '排序,倒序从大到小',
`status` tinyint(1) unsigned DEFAULT '0' COMMENT '0:删除;1:正常',
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8*/
    public function install() {
        try {
            $exist = Dir::find()->one();
            if($exist){
                throw new yii\base\Exception('Dir has installed');
            }
            $arr0 = [
                ['n'=>'企业运营中心','c'=>[]],
                ['n'=>'发展资源中心','c'=>[]],
                ['n'=>'工具应用中心','c'=>[]],
                ['n'=>'项目资源中心','c'=>[]],
                ['n'=>'学习共享中心','c'=>[]]
            ];

            self::initDirTop($arr0);




            //业态 业务平台
            $arr_yt1 = [
                ['n'=>'颂唐机构','l'=>true],
                ['n'=>'市场策略中心','l'=>true],
                ['n'=>'华麦建筑','l'=>true],
                ['n'=>'颂唐地产','l'=>true],
                ['n'=>'汉佑房屋','l'=>true],
                ['n'=>'致秦经纪','l'=>true],
                ['n'=>'明致置业','l'=>true],
                ['n'=>'日鑫商业','l'=>true],
                ['n'=>'颂唐广告','l'=>true],
                ['n'=>'尚晋公关','l'=>true],
                ['n'=>'元素互动','l'=>true],
                ['n'=>'周道物业','l'=>true]
            ];
            $arr_yt2 = [
                ['n'=>'颂唐机构','c'=>[
                    ['n'=>'上海总部平台','l'=>true]
                ]],
                ['n'=>'市场策略中心','c'=>[
                    ['n'=>'上海总部平台','l'=>true]
                ]],
                ['n'=>'华麦建筑','c'=>[
                    ['n'=>'上海华麦建筑','l'=>true]
                ]],
                ['n'=>'颂唐地产','c'=>[
                    ['n'=>'上海颂唐地产','l'=>true],
                    ['n'=>'苏州颂唐地产','l'=>true],
                    ['n'=>'无锡颂唐地产','l'=>true],
                    ['n'=>'南京颂唐地产','l'=>true],
                    ['n'=>'安徽颂唐地产','l'=>true],
                    ['n'=>'苏北颂唐地产','l'=>true]
                ]],
                ['n'=>'汉佑房屋','c'=>[
                    ['n'=>'苏州汉佑房屋','l'=>true],
                    ['n'=>'无锡汉佑房屋','l'=>true]
                ]],
                ['n'=>'致秦经纪','c'=>[
                    ['n'=>'上海致秦经纪','l'=>true],
                    ['n'=>'苏州致秦经纪','l'=>true],
                    ['n'=>'无锡致秦经纪','l'=>true],
                    ['n'=>'南京致秦经纪','l'=>true],
                    ['n'=>'合肥致秦经纪','l'=>true]
                ]],
                ['n'=>'明致置业','c'=>[
                    ['n'=>'上海明致置业','l'=>true],
                    ['n'=>'南京明致置业','l'=>true]
                ]],
                ['n'=>'日鑫商业','c'=>[
                    ['n'=>'上海日鑫商业','l'=>true],
                    ['n'=>'苏州日鑫商业','l'=>true],
                    ['n'=>'无锡日鑫商业','l'=>true],
                    ['n'=>'南京日鑫商业','l'=>true],
                    ['n'=>'安徽日鑫商业','l'=>true],
                    ['n'=>'苏北日鑫商业','l'=>true]
                ]],
                ['n'=>'颂唐广告','c'=>[
                    ['n'=>'上海颂唐广告','l'=>true],
                    ['n'=>'苏州颂唐广告','l'=>true],
                    ['n'=>'南京颂唐广告','l'=>true],
                    ['n'=>'安徽颂唐广告','l'=>true]
                ]],
                ['n'=>'尚晋公关','c'=>[
                    ['n'=>'苏州尚晋公关','l'=>true]
                ]],
                ['n'=>'元素互动','c'=>[
                    ['n'=>'上海元素互动','l'=>true]
                ]],
                ['n'=>'周道物业','c'=>[
                    ['n'=>'苏州周道物业','l'=>true]
                ]]
            ];



            $arr1 = [
                ['n'=>'企宣管控中心','c'=>[
                    ['n'=>'公司简介','c'=>$arr_yt1],
                    ['n'=>'VI应用标准模板','c'=>$arr_yt2]
                ]],
                ['n'=>'行政管控中心','c'=>[
                    ['n'=>'公告通知','c'=>$arr_yt2],
                    ['n'=>'行政管理制度','c'=>$arr_yt2],
                    ['n'=>'人事管理制度','c'=>$arr_yt2],
                    ['n'=>'管理表单范本','c'=>$arr_yt1],
                    ['n'=>'制度培训模板','c'=>$arr_yt2],
                ]],
                ['n'=>'财务管控中心','c'=>[
                    ['n'=>'财务管理制度','c'=>$arr_yt1],
                    ['n'=>'财务表单范本','c'=>$arr_yt1]
                ]],
                ['n'=>'法务管控中心','c'=>[
                    ['n'=>'合同范本','c'=>$arr_yt1],
                    ['n'=>'信函范本','c'=>$arr_yt1]
                ]]
            ];


            self::initDir($arr1,1,2,1);

            $arr2 = [
                ['n'=>'颂唐-人才资源中心','c'=>[
                    ['n'=>'在职员工档案','l'=>true],
                    ['n'=>'离职员工档案','l'=>true],
                    ['n'=>'应聘员工档案','l'=>true],
                    ['n'=>'行业人才档案','l'=>true]
                ]],
                ['n'=>'颂唐-客户资源中心','c'=>[
                    ['n'=>'甲方人员档案','l'=>true]
                ]],
                ['n'=>'颂唐-供应商资源中心','c'=>[
                    ['n'=>'供应商档案','l'=>true]
                ]],
                ['n'=>'颂唐地产-客户资源中心','c'=>[
                    ['n'=>'购房客户档案','l'=>true]
                ]],
                ['n'=>'日鑫商业-商家资源中心','c'=>[
                    ['n'=>'商家档案','l'=>true]
                ]]
            ];

            self::initDir($arr2,2,2,2);

            $arr3 = [
                ['n'=>'颂唐地产','c'=>[
                    ['n'=>'开发拓展部工具箱','c'=>[
                        ['n'=>'工作流程规范','c'=>$arr_yt1],
                        ['n'=>'工作文件范本','c'=>$arr_yt1],
                        ['n'=>'工作文件档案','c'=>$arr_yt2]
                    ]],
                    ['n'=>'市场策划部工具箱','c'=>[
                        ['n'=>'工作流程规范','c'=>$arr_yt1],
                        ['n'=>'工作报告模板','c'=>$arr_yt1],
                        ['n'=>'工作表单范本','c'=>$arr_yt1],
                        ['n'=>'产品定位资源库','c'=>$arr_yt1],
                        ['n'=>'工作报告档案库','c'=>$arr_yt1]
                    ]],
                    ['n'=>'销售业务部工具箱','c'=>[
                        ['n'=>'工作流程规范','c'=>$arr_yt1],
                        ['n'=>'工作报告范本','c'=>$arr_yt1],
                        ['n'=>'工作表单范本','c'=>$arr_yt1],
                        ['n'=>'活动方案资源库','c'=>$arr_yt1]
                    ]]
                ]],
                ['n'=>'颂唐广告','c'=>[
                    ['n'=>'AE策划部工具箱','c'=>[
                        ['n'=>'工作流程规范','c'=>$arr_yt1],
                        ['n'=>'工作报告模板','c'=>$arr_yt1],
                        ['n'=>'工作表单范本','c'=>$arr_yt1]
                    ]],
                    ['n'=>'创作部工具箱','c'=>[
                        ['n'=>'工作流程规范','c'=>$arr_yt1],
                        ['n'=>'工作文件模板','c'=>$arr_yt1],
                        ['n'=>'工作表单范本','c'=>$arr_yt1]
                    ]]
                ]],
                ['n'=>'日鑫商业','c'=>[
                    ['n'=>'商业策划部工具箱','c'=>[
                        ['n'=>'工作流程规范','c'=>$arr_yt1],
                        ['n'=>'工作报告模板','c'=>$arr_yt1],
                        ['n'=>'工作表单范本','c'=>$arr_yt1],
                        ['n'=>'商业定位资源库','c'=>$arr_yt1],
                        ['n'=>'工作报告档案库','c'=>$arr_yt1]
                    ]],
                    ['n'=>'商业招商部工具箱','c'=>[
                        ['n'=>'工作流程规范','c'=>$arr_yt1],
                        ['n'=>'工作文件模板','c'=>$arr_yt1],
                        ['n'=>'工作表单范本','c'=>$arr_yt1]
                    ]]
                ]],
                ['n'=>'华麦建筑','c'=>[]],
                ['n'=>'汉佑房屋','c'=>[]],
                ['n'=>'致秦经纪','c'=>[]],
                ['n'=>'明致置业','c'=>[]],
                ['n'=>'尚晋公关','c'=>[]],
                ['n'=>'元素互动','c'=>[]],
                ['n'=>'周道物业','c'=>[]]
            ];

            self::initDir($arr3,3,2,3);

            $arr4_22 = array(
                array('n'=>'执行项目资料中心','c'=>array(
                    array('n'=>'颂唐地产','c'=>array(
                        /*array('n'=>'项目介绍'),
                        array('n'=>'项目答客问'),
                        array('n'=>'建筑图纸'),
                        array('n'=>'效果图'),
                        array('n'=>'家配图'),
                        array('n'=>'项目团队人员组织架构/联络方式'),
                        array('n'=>'项目案场团队集体照/项目广告团队集体照')*/
                    )
                    ),
                    array('n'=>'颂唐广告','c'=>array(
                        /*array('n'=>'项目介绍'),
                        array('n'=>'项目答客问'),
                        array('n'=>'建筑图纸'),
                        array('n'=>'效果图'),
                        array('n'=>'家配图'),
                        array('n'=>'项目团队人员组织架构/联络方式'),
                        array('n'=>'项目案场团队集体照/项目广告团队集体照')*/
                    )
                    ),
                    array('n'=>'日鑫商业'),
                    array('n'=>'XX置业')
                )
                ),
                array('n'=>'历史项目资料中心','c'=>array(
                    /*array('n'=>'合同/财务档案','c'),
                    array('n'=>'规划设计方案','c'),
                    array('n'=>'业务结案报告','c'),
                    array('n'=>'企划档案资料','c'),
                    array('n'=>'楼盘实景照片','c'),
                    array('n'=>'执行团队照片','c')*/
                )
                )
            );
            $arr4 = [
                ['n'=>'执行项目资料中心','c'=>[
                    ['n'=>'颂唐地产','l'=>true],
                    ['n'=>'颂唐广告','l'=>true],
                    ['n'=>'日鑫商业','l'=>true],
                    ['n'=>'明致置业','l'=>true],
                ]],
                ['n'=>'历史项目资料中心','l'=>true]
            ];
            self::initDir($arr4,4,2,4);

            $arr5 = [
                ['n'=>'公司推荐学习资料库','l'=>true],
                ['n'=>'员工推荐学习资料库','l'=>true]
            ];

            self::initDir($arr5,5,2,5);
            return true;
        }catch (\Exception $e)
        {
            echo  'Dir install failed<br />';
            $message = $e->getMessage() . "\n";
            $errorInfo = $e instanceof \PDOException ? $e->errorInfo : null;
            echo $message;
            /*echo '<br/><br/>';
            var_dump($errorInfo);*/

            //throw new \Exception($message, $errorInfo, (int) $e->getCode(), $e);
            return false;
        }
    }

    public static function initDir($arr,$pid,$level,$type){
        $sqlbase = "INSERT IGNORE INTO `dir`(`name`,`p_id`,`type`,`is_leaf`,`level`,`is_last`,`ord`,`status`)
                VALUES";
        $ord = 99;
        $i = 1;
        foreach($arr as $a){
            $isLast = $i == count($arr)?1:0;
            $leaf = isset($a['l']) && $a['l']==1?1:0;
            $sql =$sqlbase."('".$a['n']."',$pid,$type,$leaf,$level,$isLast,$ord,1)";
            $cmd = Yii::$app->db->createCommand($sql);
            $cmd->execute();
            //$lastId = Yii::app()->db->lastInsertID;
            if(isset($a['c']) && !empty($a['c'])){
                self::initDir($a['c'],Yii::$app->db->lastInsertID,$level+1,$type);
            }
            $ord--;
            $i++;
        }
    }

    public static function initDirTop($arr){
        $sqlbase = "INSERT IGNORE INTO `dir`(`name`,`p_id`,`type`,`is_leaf`,`level`,`is_last`,`ord`,`status`)
                VALUES";
        $ord = 99;
        $i = 1;
        foreach($arr as $a){
            $isLast = $i == count($arr)?1:0;
            $leaf = isset($a['l']) && $a['l']==1?1:0;
            $sql =$sqlbase."('".$a['n']."',0,$i,$leaf,1,$isLast,$ord,1)";
            $cmd = Yii::$app->db->createCommand($sql);
            $cmd->execute();
            
            $ord--;
            $i++;
        }
    }
}