<?php

namespace app\models;
use yii;

class File extends \yii\db\ActiveRecord
{
    public $childrenIds;

    public function rules()
    {
        return [
            ['name', 'required'],
            [['id, type, more_cate, status, p_id, ord, is_leaf, is_last, level'], 'integer'],
            ['name', 'string', 'max'=>100],
            [['describe'],'safe']
        ];
    }
/*CREATE TABLE `file` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`filename` varchar(200) NOT NULL COMMENT '文件名',
`filesize` int(11) NOT NULL COMMENT '文件大小',
`filetype` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '文件类型，后缀名',
`folder_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '所属文件夹目录ID',
`foldertype` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '所属文件夹目录类型',
`dir_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '对应中心结构叶目录Dir.id',
`p_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '父文件夹id;0为顶层下的文件',
`filename_real` varchar(50) NOT NULL COMMENT '实际存在的转换后的文件名（带后缀名）',
`uid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '上传用户ID',
`clicks` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '打开数',
`inputtime` datetime NOT NULL,
`updatetime` datetime NOT NULL,
`describe` text NOT NULL,
`ord` int(4) unsigned DEFAULT '0' COMMENT '排序,倒序从大到小',
`flag` tinyint(1) unsigned DEFAULT '0' COMMENT '标志位',
`status` tinyint(1) unsigned DEFAULT '0' COMMENT '0:删除;1:正常',
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8
}*/
    public function install() {
        try {
            $exist = Dir::find()->one();
            if($exist){
                throw new yii\base\Exception('Dir has installed');
            }
            $arr0 = array(
                array('n'=>'企业运营中心','c'=>[]),
                array('n'=>'发展资源中心','c'=>[]),
                array('n'=>'工具应用中心','c'=>[]),
                array('n'=>'项目资源中心','c'=>[]),
                array('n'=>'学习共享中心','c'=>[]),
            );

            self::initDirTop($arr0);




            //业态 业务平台
            $arr_yt = array(
                array('n'=>'颂唐控股','c'=>array(
                    array('n'=>'总部平台','l'=>true)
                )
                ),
                array('n'=>'颂唐地产研究部','c'=>array(
                    array('n'=>'默认','l'=>true)
                )
                ),
                array('n'=>'华麦建筑','c'=>array(
                    array('n'=>'默认','l'=>true)
                )
                ),
                array('n'=>'颂唐地产','c'=>array(
                    array('n'=>'总部','l'=>true),
                    array('n'=>'上海颂唐地产','l'=>true),
                    array('n'=>'苏州颂唐地产','l'=>true),
                    array('n'=>'无锡颂唐地产','l'=>true),
                    array('n'=>'南京颂唐地产','l'=>true),
                    array('n'=>'安徽颂唐地产','l'=>true),
                    array('n'=>'苏北颂唐地产','l'=>true)
                )
                ),
                array('n'=>'XX房屋','c'=>array(
                    array('n'=>'默认','l'=>true)
                )
                ),
                array('n'=>'XX经纪','c'=>array(
                    array('n'=>'默认','l'=>true)
                )
                ),
                array('n'=>'XX置业','c'=>array(
                    array('n'=>'默认','l'=>true)
                )
                ),
                array('n'=>'日鑫商业','c'=>array(
                    array('n'=>'默认','l'=>true)
                )
                ),
                array('n'=>'颂唐广告','c'=>array(
                    array('n'=>'总部','l'=>true),
                    array('n'=>'上海颂唐广告','l'=>true),
                    array('n'=>'苏州颂唐广告','l'=>true),
                    array('n'=>'南京颂唐广告','l'=>true),
                    array('n'=>'安徽颂唐广告','l'=>true)
                )
                ),
                array('n'=>'XX公关','c'=>array(
                    array('n'=>'默认','l'=>true)
                )
                ),
                array('n'=>'XX数码互动','c'=>array(
                    array('n'=>'默认','l'=>true)
                )
                ),
                array('n'=>'XX物业','c'=>array(
                    array('n'=>'默认','l'=>true)
                )
                )
            );



            $arr1 = array(
                array('n'=>'企业形象中心','c'=>array(
                    array('n'=>'公司简介','c'=>$arr_yt),
                    array('n'=>'VI应用标准模板','c'=>array())
                )
                ),
                array('n'=>'行政管控中心','c'=>array(
                    array('n'=>'公告通知','c'),
                    array('n'=>'行政管理制度','c'),
                    array('n'=>'人事管理制度','c'),
                    array('n'=>'管理表单范本','c'),
                    array('n'=>'制度培训模板','c')
                )
                ),
                array('n'=>'财务管控中心','c'=>array(
                    array('n'=>'财务管理制度','c'),
                    array('n'=>'财务表单范本','c')
                )
                ),
                array('n'=>'法务管控中心','c'=>array(
                    array('n'=>'合同范本','c'),
                    array('n'=>'信函范本','c')
                )
                )
            );

            self::initDir($arr1,1,2,1);

            $arr2 = array(
                array('n'=>'颂唐-人才资源中心','c'=>array(
                    array('n'=>'在职员工档案','c'),
                    array('n'=>'离职员工档案','c'),
                    array('n'=>'应聘员工档案','c'),
                    array('n'=>'行业人才档案','c')
                )
                ),
                array('n'=>'颂唐-客户资源中心','c'=>array(
                    array('n'=>'甲方人员档案')
                )
                ),
                array('n'=>'颂唐-供应商资源中心','c'=>array(
                    array('n'=>'供应商档案'),
                )
                ),
                array('n'=>'颂唐地产-客户资源中心','c'=>array(
                    array('n'=>'购房客户档案')
                )
                ),
                array('n'=>'日鑫商业-商家资源中心','c'=>array(
                    array('n'=>'商家档案')
                )
                )
            );

            self::initDir($arr2,2,2,2);

            $arr3 = array(
                array('n'=>'颂唐地产','c'=>array(
                    array('n'=>'开发拓展部工具箱','c'=>array(
                        array('n'=>'工作流程规范','c'),
                        array('n'=>'工作文件范本','c'),
                        array('n'=>'工作文件档案','c')
                    )
                    ),
                    array('n'=>'市场策划部工具箱','c'=>array(
                        array('n'=>'工作流程规范','c'),
                        array('n'=>'工作报告模板','c'),
                        array('n'=>'工作表单范本','c'),
                        array('n'=>'产品定位资源库','c'),
                        array('n'=>'工作报告档案库','c')
                    )
                    ),
                    array('n'=>'销售业务部工具箱','c'=>array(
                        array('n'=>'工作流程规范','c'),
                        array('n'=>'工作报告范本','c'),
                        array('n'=>'工作表单范本','c'),
                        array('n'=>'活动方案资源库','c')
                    )
                    )
                )
                ),
                array('n'=>'颂唐广告','c'=>array(
                    array('n'=>'AE策划部工具箱','c'=>array(
                        array('n'=>'工作流程规范','c'),
                        array('n'=>'工作报告模板','c'),
                        array('n'=>'工作表单范本','c')
                    )
                    ),
                    array('n'=>'创作部工具箱','c'=>array(
                        array('n'=>'工作流程规范','c'),
                        array('n'=>'工作文件模板','c'),
                        array('n'=>'工作表单范本','c')
                    )
                    )
                )
                ),
                array('n'=>'日鑫商业','c'=>array()),
                array('n'=>'华麦建筑','c'=>array())
            );

            self::initDir($arr3,3,2,3);

            $arr4 = array(
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
            self::initDir($arr4,4,2,4);

            $arr5 = array(
                array('n'=>'公司推荐学习资料库'),
                array('n'=>'员工推荐学习资料库')

            );

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
            if(isset($a['c'])){
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