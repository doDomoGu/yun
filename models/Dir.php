<?php

namespace app\models;
use app\components\PositionFunc;
use yii;
use yii\helpers\ArrayHelper;

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

/*ALTER TABLE `dir` ADD `alias` VARCHAR(255) DEFAULT NULL AFTER `name`;*/

    public $arr0;

    public $arr_yt1;

    public $arr_yt2;

    public $arr_company;

    public $arr_xiangmu;

    public $arr_yt3;

    public $arr1;

    public $localArr;

    public $ytArr;

    public function __construct(){

        $this->arr0 = [
            ['n'=>'企业运营中心','a'=>'zyfzzx','c'=>[]],
            ['n'=>'发展资源中心','a'=>'fzzyzx','c'=>[]],
            ['n'=>'工具应用中心','a'=>'gjyyzx','c'=>[]],
            ['n'=>'项目资源中心','a'=>'xmzyzx','c'=>[]],
            ['n'=>'学习共享中心','a'=>'xxgxzx','c'=>[]]
        ];

        $this->arr_yt1 = [
            ['n'=>'颂唐机构','a'=>'stjg','l'=>true],
            ['n'=>'市场策略中心','a'=>'scclzx','l'=>true],
            ['n'=>'华麦建筑','a'=>'hmjz','l'=>true],
            ['n'=>'颂唐地产','a'=>'stdc','l'=>true],
            ['n'=>'汉佑房屋','a'=>'hyfw','l'=>true],
            /*['n'=>'致秦经纪','a'=>'zqjj','l'=>true],
            ['n'=>'明致置业','a'=>'mzzy','l'=>true],
            ['n'=>'日鑫商业','a'=>'rxsy','l'=>true],
            ['n'=>'颂唐广告','a'=>'stgg','l'=>true],
            ['n'=>'尚晋公关','a'=>'sjgg','l'=>true],
            ['n'=>'元素互动','a'=>'yshd','l'=>true],
            ['n'=>'周道物业','a'=>'zdwy','l'=>true]*/
        ];

        $this->arr_yt2 = [
            ['n'=>'颂唐机构','a'=>'stjg','c'=>[
                ['n'=>'上海总部平台','a'=>'shzbpt','l'=>true]
            ]],
            ['n'=>'市场策略中心','a'=>'scclzx','c'=>[
                ['n'=>'上海总部平台','a'=>'shzbpt','l'=>true]
            ]],
            ['n'=>'华麦建筑','a'=>'hmjz','c'=>[
                ['n'=>'上海华麦建筑','a'=>'sh','l'=>true]
            ]],
            ['n'=>'颂唐地产','a'=>'stdc','c'=>[
                ['n'=>'上海颂唐地产','a'=>'sh','l'=>true],
                ['n'=>'苏州颂唐地产','a'=>'sz','l'=>true],
                ['n'=>'无锡颂唐地产','a'=>'wx','l'=>true],
                ['n'=>'南京颂唐地产','a'=>'nj','l'=>true],
                ['n'=>'安徽颂唐地产','a'=>'ah','l'=>true],
                ['n'=>'苏北颂唐地产','a'=>'sb','l'=>true]
            ]],
            ['n'=>'汉佑房屋','a'=>'hyfw','c'=>[
                ['n'=>'苏州汉佑房屋','a'=>'sz','l'=>true],
                ['n'=>'无锡汉佑房屋','a'=>'wx','l'=>true]
            ]],
            ['n'=>'致秦经纪','a'=>'zqjj','c'=>[
                ['n'=>'上海致秦经纪','a'=>'sh','l'=>true],
                ['n'=>'苏州致秦经纪','a'=>'sz','l'=>true],
                ['n'=>'无锡致秦经纪','a'=>'wx','l'=>true],
                ['n'=>'南京致秦经纪','a'=>'nj','l'=>true],
                ['n'=>'合肥致秦经纪','a'=>'hf','l'=>true]
            ]],
            ['n'=>'明致置业','a'=>'mzzy','c'=>[
                ['n'=>'上海明致置业','a'=>'sh','l'=>true],
                ['n'=>'南京明致置业','a'=>'nj','l'=>true]
            ]],
            ['n'=>'日鑫商业','a'=>'rxsy','c'=>[
                ['n'=>'上海日鑫商业','a'=>'sh','l'=>true],
                ['n'=>'苏州日鑫商业','a'=>'sz','l'=>true],
                ['n'=>'无锡日鑫商业','a'=>'wx','l'=>true],
                ['n'=>'南京日鑫商业','a'=>'nj','l'=>true],
                ['n'=>'安徽日鑫商业','a'=>'ah','l'=>true],
                ['n'=>'苏北日鑫商业','a'=>'sb','l'=>true]
            ]],
            ['n'=>'颂唐广告','a'=>'stgg','c'=>[
                ['n'=>'上海颂唐广告','a'=>'sh','l'=>true],
                ['n'=>'苏州颂唐广告','a'=>'sz','l'=>true],
                ['n'=>'南京颂唐广告','a'=>'nj','l'=>true],
                ['n'=>'安徽颂唐广告','a'=>'ah','l'=>true]
            ]],
            ['n'=>'尚晋公关','a'=>'sjgg','c'=>[
                ['n'=>'苏州尚晋公关','a'=>'sz','l'=>true]
            ]],
            ['n'=>'元素互动','a'=>'yshd','c'=>[
                ['n'=>'上海元素互动','a'=>'sh','l'=>true]
            ]],
            ['n'=>'周道物业','a'=>'zdwy','c'=>[
                ['n'=>'苏州周道物业','a'=>'sz','l'=>true]
            ]]
        ];

        $this->arr_company = [
            ['n'=>'公司A','l'=>true],
            ['n'=>'公司B','l'=>true],
            ['n'=>'公司C','l'=>true],
        ];

        $this->arr_xiangmu = [
            ['n'=>'项目A','l'=>true],
            ['n'=>'项目B','l'=>true],
            ['n'=>'项目C','l'=>true]
        ];

        $this->arr_yt3 = [
            ['n'=>'颂唐机构','c'=>$this->arr_company],
            ['n'=>'市场策略中心','c'=>$this->arr_company],
            ['n'=>'华麦建筑','c'=>$this->arr_company],
            ['n'=>'颂唐地产','c'=>$this->arr_company],
            ['n'=>'汉佑房屋','c'=>$this->arr_company],
            ['n'=>'致秦经纪','c'=>$this->arr_company],
            ['n'=>'明致置业','c'=>$this->arr_company],
            ['n'=>'日鑫商业','c'=>$this->arr_company],
            ['n'=>'颂唐广告','c'=>$this->arr_company],
            ['n'=>'尚晋公关','c'=>$this->arr_company],
            ['n'=>'元素互动','c'=>$this->arr_company],
            ['n'=>'周道物业','c'=>$this->arr_company]
        ];

        $this->arr1 = [
            /*['n'=>'企宣管控中心','a'=>'qxgkzx','c'=>[
                ['n'=>'公司简介','a'=>'gsjj','pm'=>[11=>['single'=>['admin']],12=>'all'],'c'=>$this->arr_yt1],
                ['n'=>'VI应用标准模板','a'=>'vi','pm'=>[11=>['single'=>['admin']],12=>'all'],'c'=>$this->arr_yt2]
            ]],*/
            ['n'=>'行政管控中心','a'=>'xzgkzx','c'=>[
                ['n'=>'公告通知','a'=>'ggtz','pm'=>[/*11=>['zhglb'=>'ytlocal'],*/12=>['ytlocal'=>'all']],'c'=>$this->arr_yt2],
                /*['n'=>'行政管理制度','a'=>'xzglzd','pm'=>[12=>'ytlocal'],'c'=>$this->arr_yt2],
                ['n'=>'人事管理制度','a'=>'rsglzd','pm'=>[12=>'ytlocal'],'c'=>$this->arr_yt2],
                ['n'=>'管理表单范本','a'=>'glbdfb','c'=>$this->arr_yt1],
                ['n'=>'制度培训模板','a'=>'zdpxmb','pm'=>[12=>'ytlocal'],'c'=>$this->arr_yt2],*/
            ]],
            /*['n'=>'财务管控中心','c'=>[
                ['n'=>'财务管理制度','c'=>$arr_yt1],
                ['n'=>'财务表单范本','c'=>$arr_yt1]
            ]],
            ['n'=>'法务管控中心','c'=>[
                ['n'=>'合同范本','c'=>$arr_yt1],
                ['n'=>'信函范本','c'=>$arr_yt1]
            ]]*/
        ];

        $this->localArr = [
            'shzbpt','sh','sz','wx','hf','sb','ah','nj'
        ];

        $this->ytArr = [
            'stjg','scclzx','hmjz','stdc','hyfw','zqjj','mzzy','rxsy','stgg','sjgg','yshd','zdwy'
        ];
    }
    public function install() {
        try {
            $exist = Dir::find()->one();
            if($exist){
                throw new yii\base\Exception('Dir has installed');
            }

            self::initDirTop($this->arr0);

            //业态 业务平台



            $this->initDir($this->arr1,1,2,1);

            /*$arr2 = [
                ['n'=>'颂唐-人才资源中心','c'=>[
                    ['n'=>'在职员工档案','c'=>$this->arr_yt2],
                    ['n'=>'离职员工档案','c'=>$this->arr_yt2],
                    ['n'=>'应聘员工档案','c'=>$this->arr_yt2],
                    ['n'=>'行业人才档案','c'=>$this->arr_yt2]
                ]],
                ['n'=>'颂唐-客户资源中心','c'=>[
                    ['n'=>'甲方人员档案','c'=>$this->arr_company]
                ]],
                ['n'=>'颂唐-供应商资源中心','c'=>[
                    ['n'=>'供应商档案','c'=>$this->arr_yt3]
                ]],
                ['n'=>'颂唐地产-客户资源中心','c'=>[
                    ['n'=>'购房客户档案','l'=>true]
                ]],
                ['n'=>'日鑫商业-商家资源中心','c'=>[
                    ['n'=>'商家档案','l'=>true]
                ]]
            ];

            self::initDir($arr2,2,2,2);*/

            /*$arr3 = [
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

            $arr4 = [
                ['n'=>'执行项目资料中心','c'=>[
                    ['n'=>'颂唐地产','c'=>$arr_xiangmu],
                    ['n'=>'颂唐广告','c'=>$arr_xiangmu],
                    ['n'=>'日鑫商业','c'=>$arr_xiangmu],
                    ['n'=>'明致置业','c'=>$arr_xiangmu],
                ]],
                ['n'=>'历史项目资料中心','c'=>$arr_xiangmu]
            ];
            self::initDir($arr4,4,2,4);

            $arr5 = [
                ['n'=>'公司推荐学习资料库','l'=>true],
                ['n'=>'员工推荐学习资料库','l'=>true]
            ];

            self::initDir($arr5,5,2,5);*/
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

    public function initDir($arr,$pid,$level,$type,$pm=[],$yt='',$local=''){
        $sqlbase = "INSERT IGNORE INTO `dir`(`name`,`alias`,`p_id`,`type`,`is_leaf`,`level`,`is_last`,`ord`,`status`)
                VALUES";
        $ord = 99;
        $i = 1;
        foreach($arr as $a){
            $isLast = $i == count($arr)?1:0;
            $leaf = isset($a['l']) && $a['l']==1?1:0;
            $name = isset($a['n']) && $a['n']!=''?$a['n']:'默认名称';
            $alias = isset($a['a']) && $a['a']!=''?$a['a']:'默认别名';
            if(empty($pm) && isset($a['pm']))
                $pm = $a['pm'];

            if(in_array($alias,$this->ytArr))
                $yt = $alias;

            if(in_array($alias,$this->localArr))
                $local = $alias;


            $sql = $sqlbase."('".$name."','".$alias."',$pid,$type,$leaf,$level,$isLast,$ord,1)";
            $cmd = Yii::$app->db->createCommand($sql);
            $cmd->execute();
            $lastId = Yii::$app->db->lastInsertID;
            if($leaf==0){
                if(isset($a['c']) && !empty($a['c'])){
                    $this->initDir($a['c'],$lastId,$level+1,$type,$pm,$yt,$local);
                }
            }else{
                $this->initPm($lastId,$pm,$yt,$local);
            }


            $ord--;
            $i++;
        }
    }

    public function initPm($dir_id,$pmArr,$yt,$local){
        if(!empty($pmArr)){
            $pAll = [];
            $positionAll = Position::find()->where(['is_leaf'=>1])->all();
            foreach($positionAll as $pOne){
                $pAll[] = $pOne->id;
            }
            $sqlBase = "INSERT IGNORE INTO `position_dir_permission`(`position_id`,`dir_id`,`type`) VALUES";
            foreach($pmArr as $k=>$pmItem){
                if($pmItem=='all'){
                    $sql = $sqlBase;
                    $sqlValueArr = [];
                    foreach($pAll as $p){
                        $sqlValueArr[] = '("'.$p.'","'.$dir_id.'","'.$k.'")';
                    }
                    $sql .= implode(',',$sqlValueArr);
                    $cmd = Yii::$app->db->createCommand($sql);
                    $cmd->execute();
                }elseif(is_array($pmItem) && !empty($pmItem)){
                    foreach($pmItem as $type => $pmItem2){
                        if($type == 'ytlocal'){

                            //业态是唯一的 业态下的地方公司也是唯一的
                            if(in_array($local,$this->localArr) && in_array($yt,$this->ytArr)){
                                //$pLocalArr = [];
                                $sql = $sqlBase;
                                //根据业态获取position
                                $pos1 = Position::find()->where(['alias'=>$yt])->one();
                                if($pos1){
                                    //业态的下面一层就是地方公司
                                    $pos2 = Position::find()->where(['alias'=>$local,'p_id'=>$pos1->id])->one();
                                    if($pos2){
                                        //现在的yt-local = $pos1->alias.'-'.$pos2->alias  例如: stgg-sh stdc-sh
                                        /*$arrTmp = PositionFunc::getAllLeafChildrenIds($pos2->id);
                                        $pYtLocalArr = ArrayHelper::merge($pLocalArr,$arrTmp);*/
                                        $pYtLocalArr = PositionFunc::getAllLeafChildrenIds($pos2->id);
                                    }
                                }
                                if(!empty($pYtLocalArr)){
                                    $sqlValueArr = [];
                                    foreach($pYtLocalArr as $p){
                                        $sqlValueArr[] = '("'.$p.'","'.$dir_id.'","'.$k.'")';
                                    }
                                    $sql .= implode(',',$sqlValueArr);
                                    $cmd = Yii::$app->db->createCommand($sql);
                                    $cmd->execute();
                                }
                            }
                        }elseif($type == 'single'){
                            $sql = $sqlBase;
                            $sqlValueArr = [];
                            $pids = [];
                            foreach($pmItem2 as $p){
                                $p_id = PositionFunc::getIdByAlias($p);
                                $pids[] = $p_id;
                            }
                            foreach($pids as $p){
                                $sqlValueArr[] = '("'.$p.'","'.$dir_id.'","'.$k.'")';
                            }
                            $sql .= implode(',',$sqlValueArr);
                            $cmd = Yii::$app->db->createCommand($sql);
                            $cmd->execute();
                        }
                    }
                }
            }
        }
    }


    public static function initDirTop($arr){
        $sqlbase = "INSERT IGNORE INTO `dir`(`name`,`alias`,`p_id`,`type`,`is_leaf`,`level`,`is_last`,`ord`,`status`)
                VALUES";
        $ord = 99;
        $i = 1;
        foreach($arr as $a){
            $isLast = $i == count($arr)?1:0;
            $leaf = isset($a['l']) && $a['l']==1?1:0;
            $name = isset($a['n']) && $a['n']!=''?$a['n']:'默认名称';
            $alias = isset($a['a']) && $a['a']!=''?$a['a']:'默认别名';
            $sql = $sqlbase."('".$name."','".$alias."',0,$i,$leaf,1,$isLast,$ord,1)";
            $cmd = Yii::$app->db->createCommand($sql);
            $cmd->execute();
            
            $ord--;
            $i++;
        }
    }
}