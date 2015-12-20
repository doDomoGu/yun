<?php

namespace app\models;
use app\components\CommonFunc;
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

    public $arr_diyu;

    public $arr_company;

    public $arr_xiangmu;

    public $arr_yt3;

    public $arr1;

    public $arr2;

    public $arr3;

    public $arr4;

    public $arr5;

    public $localArr;

    public $ytArr;

    public $positionArr;

    public $localPositionArr;

    public function __construct(){
        $this->localArr = [
            'shzbpt','sh','sz','wx','hf','sb','ah','nj'
        ];

        $this->ytArr = [
            'stjg','scclzx','hmjz','stdc','hyfw','zqjj','mzzy','rxsy','stgg','sjgg','yshd','zdwy'
        ];

        $this->positionArr = [
            'zhglb','cwb','zjb','kftzb','scchb'
        ];

        $this->localPositionArr = [
            'zjb'=>['sh/zjb','sz/zjb','wx/zjb','hf/zjb','sb/zjb','ah/zjb','nj/zjb'],
            'kftzb'=>['sh/kftzb','sz/kftzb','wx/kftzb','hf/kftzb','sb/kftzb','ah/kftzb','nj/kftzb'],
            'scchb'=>['sh/scchb','sz/scchb','wx/scchb','hf/scchb','sb/scchb','ah/scchb','nj/scchb'],
        ];


        $this->arr_diyu = [
            'stjg'=>[
                ['n'=>'上海总部平台','a'=>'shzbpt','l'=>true]
            ],
            'scclzx'=>[
                ['n'=>'上海总部平台','a'=>'shzbpt','l'=>true]
            ],
            'hmjz'=>[
                ['n'=>'上海华麦建筑','a'=>'sh','l'=>true]
            ],
            'stdc'=>[
                ['n'=>'上海颂唐地产','a'=>'sh','l'=>true],
                ['n'=>'苏州颂唐地产','a'=>'sz','l'=>true],
                ['n'=>'无锡颂唐地产','a'=>'wx','l'=>true],
                ['n'=>'南京颂唐地产','a'=>'nj','l'=>true],
                ['n'=>'安徽颂唐地产','a'=>'ah','l'=>true],
                ['n'=>'苏北颂唐地产','a'=>'sb','l'=>true]
            ],
            'hyfw'=>[
                ['n'=>'苏州汉佑房屋','a'=>'sz','l'=>true],
                ['n'=>'无锡汉佑房屋','a'=>'wx','l'=>true]
            ],
            'zqjj'=>[
                ['n'=>'上海致秦经纪','a'=>'sh','l'=>true],
                ['n'=>'苏州致秦经纪','a'=>'sz','l'=>true],
                ['n'=>'无锡致秦经纪','a'=>'wx','l'=>true],
                ['n'=>'南京致秦经纪','a'=>'nj','l'=>true],
                ['n'=>'合肥致秦经纪','a'=>'hf','l'=>true]
            ],
            'mzzy'=>[
                ['n'=>'上海明致置业','a'=>'sh','l'=>true],
                ['n'=>'南京明致置业','a'=>'nj','l'=>true]
            ],
            'rxsy'=>[
                ['n'=>'上海日鑫商业','a'=>'sh','l'=>true],
                ['n'=>'苏州日鑫商业','a'=>'sz','l'=>true],
                ['n'=>'无锡日鑫商业','a'=>'wx','l'=>true],
                ['n'=>'南京日鑫商业','a'=>'nj','l'=>true],
                ['n'=>'安徽日鑫商业','a'=>'ah','l'=>true],
                ['n'=>'苏北日鑫商业','a'=>'sb','l'=>true]
            ],
            'stgg'=>[
                ['n'=>'上海颂唐广告','a'=>'sh','l'=>true],
                ['n'=>'苏州颂唐广告','a'=>'sz','l'=>true],
                ['n'=>'南京颂唐广告','a'=>'nj','l'=>true],
                ['n'=>'安徽颂唐广告','a'=>'ah','l'=>true]
            ],
            'sjgg'=>[
                ['n'=>'苏州尚晋公关','a'=>'sz','l'=>true]
            ],
            'yshd'=>[
                ['n'=>'上海元素互动','a'=>'sh','l'=>true]
            ],
            'zdwy'=>[
                ['n'=>'苏州周道物业','a'=>'sz','l'=>true]
            ]
        ];

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
            ['n'=>'致秦经纪','a'=>'zqjj','l'=>true],
            ['n'=>'明致置业','a'=>'mzzy','l'=>true],
            ['n'=>'日鑫商业','a'=>'rxsy','l'=>true],
            ['n'=>'颂唐广告','a'=>'stgg','l'=>true],
            ['n'=>'尚晋公关','a'=>'sjgg','l'=>true],
            ['n'=>'元素互动','a'=>'yshd','l'=>true],
            ['n'=>'周道物业','a'=>'zdwy','l'=>true]
        ];

        $this->arr_yt2 = [
            ['n'=>'颂唐机构','a'=>'stjg','c'=>$this->arr_diyu['stjg']],
            ['n'=>'市场策略中心','a'=>'scclzx','c'=>$this->arr_diyu['scclzx']],
            ['n'=>'华麦建筑','a'=>'hmjz','c'=>$this->arr_diyu['hmjz']],
            ['n'=>'颂唐地产','a'=>'stdc','c'=>$this->arr_diyu['stdc']],
            ['n'=>'汉佑房屋','a'=>'hyfw','c'=>$this->arr_diyu['hyfw']],
            ['n'=>'致秦经纪','a'=>'zqjj','c'=>$this->arr_diyu['zqjj']],
            ['n'=>'明致置业','a'=>'mzzy','c'=>$this->arr_diyu['mzzy']],
            ['n'=>'日鑫商业','a'=>'rxsy','c'=>$this->arr_diyu['rxsy']],
            ['n'=>'颂唐广告','a'=>'stgg','c'=>$this->arr_diyu['stgg']],
            ['n'=>'尚晋公关','a'=>'sjgg','c'=>$this->arr_diyu['sjgg']],
            ['n'=>'元素互动','a'=>'yshd','c'=>$this->arr_diyu['yshd']],
            ['n'=>'周道物业','a'=>'zdwy','c'=>$this->arr_diyu['zdwy']]
        ];


        $this->arr_company = [
            ['n'=>'公司A','a'=>'gs_a','l'=>true],
            ['n'=>'公司B','a'=>'gs_b','l'=>true],
            ['n'=>'公司C','a'=>'gs_c','l'=>true],
        ];

        $this->arr_xiangmu = [
            ['n'=>'项目A','a'=>'xm_a','l'=>true],
            ['n'=>'项目B','a'=>'xm_b','l'=>true],
            ['n'=>'项目C','a'=>'xm_c','l'=>true]
        ];

        $this->arr_yt3 = [
            ['n'=>'颂唐机构','a'=>'stjg','c'=>$this->arr_company],
            ['n'=>'市场策略中心','a'=>'scclzx','c'=>$this->arr_company],
            ['n'=>'华麦建筑','a'=>'hmjz','c'=>$this->arr_company],
            ['n'=>'颂唐地产','a'=>'stdc','c'=>$this->arr_company],
            ['n'=>'汉佑房屋','a'=>'hyfw','c'=>$this->arr_company],
            ['n'=>'致秦经纪','a'=>'zqjj','c'=>$this->arr_company],
            ['n'=>'明致置业','a'=>'mzzy','c'=>$this->arr_company],
            ['n'=>'日鑫商业','a'=>'rxsy','c'=>$this->arr_company],
            ['n'=>'颂唐广告','a'=>'stgg','c'=>$this->arr_company],
            ['n'=>'尚晋公关','a'=>'sjgg','c'=>$this->arr_company],
            ['n'=>'元素互动','a'=>'yshd','c'=>$this->arr_company],
            ['n'=>'周道物业','a'=>'ydwy','c'=>$this->arr_company]
        ];

        $this->arr1 = [
            ['n'=>'企宣管控中心','a'=>'qxgkzx','c'=>[
                ['n'=>'公司简介','a'=>'gsjj','pm'=>[11=>['single'=>['admin']],12=>'all'],'c'=>$this->arr_yt1],
                ['n'=>'VI应用标准模板','a'=>'vi','pm'=>[11=>['single'=>['admin']],12=>'all'],'c'=>$this->arr_yt2]
            ]],
            ['n'=>'行政管控中心','a'=>'xzgkzx','c'=>[
                ['n'=>'公告通知','a'=>'ggtz','pm'=>[11=>['ytlocal2'=>['sh/zhglb']],12=>['ytlocal'=>'all']],'c'=>$this->arr_yt2],
                ['n'=>'行政管理制度','a'=>'xzglzd','pm'=>[11=>['ytlocal2'=>['sh/zhglb']],12=>['ytlocal'=>'all']],'c'=>$this->arr_yt2],
                ['n'=>'人事管理制度','a'=>'rsglzd','pm'=>[11=>['ytlocal2'=>['sh/zhglb']],12=>['ytlocal'=>'all']],'c'=>$this->arr_yt2],
                ['n'=>'管理表单范本','a'=>'glbdfb','pm'=>[11=>['single'=>['admin']],12=>['ytlocal'=>'all']],'c'=>$this->arr_yt1],
                ['n'=>'制度培训模板','a'=>'zdpxmb','pm'=>[11=>['ytlocal2'=>['sh/zhglb']],12=>['ytlocal'=>'all']],'c'=>$this->arr_yt2],
            ]],
            ['n'=>'财务管控中心','pm'=>[11=>['single'=>['admin']],12=>['ytlocal2'=>['sh/zjb','sz/zjb','wx/zjb','nj/zjb','sb/zjb','ah/zjb','hf/zjb','sh/cwb']]],'c'=>[
                ['n'=>'财务管理制度','a'=>'cwglzd','c'=>$this->arr_yt1],
                ['n'=>'财务表单范本','a'=>'cwbdfb','c'=>$this->arr_yt1]
            ]],
            ['n'=>'法务管控中心','a'=>'fwgkzx','pm'=>[
                11=>['single'=>['admin']],
                12=>[
                    'ytlocal2'=>['sh/zjb','sz/zjb','wx/zjb','nj/zjb','sb/zjb','ah/zjb','hf/zjb']
                    ]
                ],
                'c'=>[
                    ['n'=>'合同范本','a'=>'htfb','c'=>$this->arr_yt1],
                    ['n'=>'信函范本','a'=>'xhfb','c'=>$this->arr_yt1]
                ]
            ]
        ];

        $this->arr2 = [
            ['n'=>'颂唐-人才资源中心','pm'=>[
                11=>['ytlocal2'=>['sh/zhglb']],
                12=>[
                    'ytlocal2'=>['sh/zhglb'],
                    'ytlocal'=>['zjb']
                    ]
                ],'a'=>'st-rczyzx','c'=>[
                    ['n'=>'在职员工档案','a'=>'zzygda','c'=>$this->arr_yt2],
                    ['n'=>'离职员工档案','a'=>'lzygda','c'=>$this->arr_yt2],
                    ['n'=>'应聘员工档案','a'=>'ypygda','c'=>$this->arr_yt2],
                    ['n'=>'行业人才档案','a'=>'hyrcda','c'=>$this->arr_yt2]
                ]
            ],
            ['n'=>'颂唐-客户资源中心','a'=>'st-khzyzx','c'=>[
                ['n'=>'甲方人员档案','a'=>'jfryda','c'=>$this->arr_company]
            ]],
            ['n'=>'颂唐-供应商资源中心','a'=>'st-gyszyzx','pm'=>[
                    11=>['ytlocal2'=>['sh/zjb','sz/zjb','wx/zjb','nj/zjb','sb/zjb','ah/zjb','hf/zjb']],
                    12=>['ytlocal2'=>['sh/zjb','sz/zjb','wx/zjb','nj/zjb','sb/zjb','ah/zjb','hf/zjb']]
                ],'c'=>[
                ['n'=>'供应商档案','a'=>'gysda','c'=>$this->arr_yt3]
            ]],
            ['n'=>'颂唐地产-客户资源中心','a'=>'stdc-khzyzx','c'=>[
                ['n'=>'购房客户档案','a'=>'gfkhda','l'=>true]
            ]],
            ['n'=>'日鑫商业-商家资源中心','a'=>'rxsy-sjzyzx','c'=>[
                ['n'=>'商家档案','a'=>'sjda','l'=>true]
            ]]
        ];

        $this->arr3 = [
            ['n'=>'颂唐地产','a'=>'stdc','c'=>[
                ['n'=>'开发拓展部工具箱','a'=>'kftzbgjx','c'=>[
                    ['n'=>'工作流程规范','a'=>'gzlcgf','pm'=>[
                        11=>['single'=>'admin'],
                        12=>['ytlocal2'=>['sh/zjb','sz/zjb','wx/zjb','nj/zjb','sb/zjb','ah/zjb','hf/zjb']],
                    ],'l'=>true],
                    ['n'=>'工作文件范本','a'=>'gzwjfb','pm'=>[
                        11=>['single'=>'admin'],
                        12=>['ytlocal2'=>$this->localPositionArr['zjb']],
                    ],'l'=>true],
                    ['n'=>'工作文件档案','a'=>'gzwjda','pm'=>[
                        11=>['ytlocal2'=>ArrayHelper::merge($this->localPositionArr['zjb'],$this->localPositionArr['kftzb'])],
                        //12=>['ytlocal2'=>$this->localPositionArr['zjb']]
                    ],'c'=>$this->arr_diyu['stdc']]
                ]],
                ['n'=>'市场策划部工具箱','a'=>'scchbgjx','c'=>[
                    ['n'=>'工作流程规范','pm'=>[
                        11=>['single'=>'scclzx/shzbpt/zj'],
                        12=>['ytlocal2'=>ArrayHelper::merge($this->localPositionArr['zjb'],$this->localPositionArr['scchb'])]
                    ],'a'=>'gzlcgf','l'=>true],
                    ['n'=>'工作报告模板','pm'=>[
                        11=>['single'=>'scclzx/shzbpt/zj'],
                        12=>['ytlocal2'=>ArrayHelper::merge($this->localPositionArr['zjb'],$this->localPositionArr['scchb'])]
                    ],'a'=>'gzbgmb','l'=>true],
                    ['n'=>'工作表单范本','pm'=>[
                        11=>['single'=>'scclzx/shzbpt/zj'],
                        12=>['ytlocal2'=>ArrayHelper::merge($this->localPositionArr['zjb'],$this->localPositionArr['scchb'])]
                    ],'a'=>'gzbdfb','l'=>true],
                    ['n'=>'产品定位资源库','pm'=>[
                        11=>['single'=>'scclzx/shzbpt/zj'],
                        12=>['ytlocal2'=>ArrayHelper::merge($this->localPositionArr['zjb'],$this->localPositionArr['scchb'])]
                    ],'a'=>'cpdwzyk','l'=>true],
                    ['n'=>'工作报告档案库','pm'=>[
                        11=>['single'=>'scclzx/shzbpt/zj'],
                        12=>['ytlocal2'=>ArrayHelper::merge($this->localPositionArr['zjb'],ArrayHelper::merge($this->localPositionArr['scchb'],$this->localPositionArr['kftzb']))]
                    ],'a'=>'gzbgdak','l'=>true]
                ]],
                ['n'=>'销售业务部工具箱','a'=>'xsywbgjx','c'=>[
                    ['n'=>'工作流程规范','pm'=>[
                        11=>['single'=>'admin'],
                        12=>['ytlocal2'=>$this->localPositionArr['zjb']]
                    ],'a'=>'gzlcgf','l'=>true],
                    ['n'=>'工作报告范本','pm'=>[
                        11=>['single'=>'admin'],
                        12=>['ytlocal2'=>$this->localPositionArr['zjb']]
                    ],'a'=>'gzbgfb','l'=>true],
                    ['n'=>'工作表单范本','pm'=>[
                        11=>['single'=>'admin'],
                        12=>['ytlocal2'=>$this->localPositionArr['zjb']]
                    ],'a'=>'gzbdfb','l'=>true],
                    ['n'=>'活动方案资源库','pm'=>[
                        11=>['single'=>'admin'],
                        12=>['ytlocal2'=>$this->localPositionArr['zjb']]
                    ],'a'=>'hdfazyk','l'=>true]
                ]]
            ]],
            ['n'=>'颂唐广告','a'=>'stgg','pm'=>[
                11=>['single'=>'admin'],
                12=>['single'=>'stgg']
            ],'c'=>[
                ['n'=>'AE策划部工具箱','a'=>'aechbgjx','c'=>[
                    ['n'=>'工作流程规范','a'=>'gzlcgf','l'=>true],
                    ['n'=>'工作报告模板','a'=>'gzbgmb','l'=>true],
                    ['n'=>'工作表单范本','a'=>'gzbdfb','l'=>true]
                ]],
                ['n'=>'创作部工具箱','a'=>'czbgjx','c'=>[
                    ['n'=>'工作流程规范','a'=>'gzlcgf','l'=>true],
                    ['n'=>'工作报告模板','a'=>'gzbgmb','l'=>true],
                    ['n'=>'工作表单范本','a'=>'gzbdfb','l'=>true]
                ]]
            ]],
            ['n'=>'日鑫商业','a'=>'rxsy','c'=>[
                ['n'=>'商业策划部工具箱','a'=>'sychbgjx','c'=>[
                    ['n'=>'工作流程规范','a'=>'gzlcgf','pm'=>[
                        11=>['single'=>'scclzx/shzbpt/zj'],
                        12=>['ytlocal2'=>ArrayHelper::merge($this->localPositionArr['zjb'],$this->localPositionArr['scchb'])]
                    ],'l'=>true],
                    ['n'=>'工作报告模板','a'=>'gzbgmb','pm'=>[
                        11=>['single'=>'scclzx/shzbpt/zj'],
                        12=>['ytlocal2'=>ArrayHelper::merge($this->localPositionArr['zjb'],$this->localPositionArr['scchb'])]
                    ],'l'=>true],
                    ['n'=>'工作表单范本','a'=>'gzbdfb','pm'=>[
                        11=>['single'=>'scclzx/shzbpt/zj'],
                        12=>['ytlocal2'=>ArrayHelper::merge($this->localPositionArr['zjb'],$this->localPositionArr['scchb'])]
                    ],'l'=>true],
                    ['n'=>'商业定位资源库','a'=>'sydwzyk','pm'=>[
                        11=>['single'=>'scclzx/shzbpt/zj'],
                        12=>['ytlocal2'=>ArrayHelper::merge($this->localPositionArr['zjb'],$this->localPositionArr['scchb'])]
                    ],'l'=>true],
                    ['n'=>'工作报告档案库','a'=>'gzbgdak','pm'=>[
                        11=>['single'=>'scclzx/shzbpt/zj'],
                        12=>['ytlocal2'=>ArrayHelper::merge($this->localPositionArr['zjb'],ArrayHelper::merge($this->localPositionArr['scchb'],$this->localPositionArr['kftzb']))]
                    ],'l'=>true]
                ]],
                ['n'=>'商业招商部工具箱','a'=>'syzsbgjx','pm'=>[
                    11=>['single'=>'admin'],
                    12=>['ytlocal2'=>$this->localPositionArr['zjb']]
                ],'c'=>[
                    ['n'=>'工作流程规范','a'=>'gzlcgf','l'=>true],
                    ['n'=>'工作文件模板','a'=>'gzwjmb','l'=>true],
                    ['n'=>'工作表单范本','a'=>'gzbdgf','l'=>true]
                ]]
            ]],
            ['n'=>'华麦建筑','a'=>'hmjz','c'=>[]],
            ['n'=>'汉佑房屋','a'=>'hyfw','c'=>[]],
            ['n'=>'致秦经纪','a'=>'zqjj','c'=>[]],
            ['n'=>'明致置业','a'=>'mzzy','c'=>[]],
            ['n'=>'尚晋公关','a'=>'sjgg','c'=>[]],
            ['n'=>'元素互动','a'=>'yshd','c'=>[]],
            ['n'=>'周道物业','a'=>'zdwy','c'=>[]]
        ];


        $this->arr4 = [
            ['n'=>'执行项目资料中心','a'=>'zxxmzlzx','c'=>[
                ['n'=>'颂唐地产','a'=>'stdc','pm'=>[
                    12=>['single'=>'stdc']
                ],'c'=>$this->arr_xiangmu],
                ['n'=>'颂唐广告','a'=>'stgg','pm'=>[
                    12=>['single'=>'stgg']
                ],'c'=>$this->arr_xiangmu],
                ['n'=>'日鑫商业','a'=>'rxsy','pm'=>[
                    12=>['single'=>'rxsy']
                ],'c'=>$this->arr_xiangmu],
                ['n'=>'明致置业','a'=>'mzzy','pm'=>[
                    12=>['single'=>'mzzy']
                ],'c'=>$this->arr_xiangmu],
            ]],
            ['n'=>'历史项目资料中心','a'=>'lsxmzlzx','pm'=>[],'c'=>$this->arr_xiangmu]
        ];


        $this->arr5 = [
            ['n'=>'公司推荐学习资料库','a'=>'gstjxxzlk','pm'=>[11=>['single'=>'admin'],12=>'all'],'l'=>true],
            ['n'=>'员工推荐学习资料库','a'=>'ygtjxxzlk','pm'=>[11=>'all',12=>'all'],'l'=>true],
        ];
    }
    public function install() {
        try {
            $exist = Dir::find()->one();
            if($exist){
                throw new yii\base\Exception('Dir has installed');
            }

            self::initDirTop($this->arr0);

            $this->initDir($this->arr1,1,2,1);

            $this->initDir($this->arr2,2,2,2);

            $this->initDir($this->arr3,3,2,3);

            $this->initDir($this->arr4,4,2,4);

            $this->initDir($this->arr5,5,2,5);
            return true;
        }catch (\Exception $e)
        {
            echo  'Dir install failed<br />';
            $message = $e->getMessage() . "\n";
            $errorInfo = $e instanceof \PDOException ? $e->errorInfo : null;
            echo $message;
            echo '<br/><br/>';
            var_dump($e);
            echo '<br/><br/>';
            var_dump($errorInfo);

            //throw new \Exception($message, $errorInfo, (int) $e->getCode(), $e);
            return false;
        }
    }

    public function initDir($arr,$pid,$level,$type,$pm=[],$yt='',$local='',$position=''){
        $sqlbase = "INSERT IGNORE INTO `dir`(`name`,`alias`,`p_id`,`type`,`is_leaf`,`level`,`is_last`,`ord`,`status`)
                VALUES";
        $ord = 99;
        $i = 1;
        foreach($arr as $a){
            $isLast = $i == count($arr)?1:0;
            $leaf = isset($a['l']) && $a['l']==1?1:0;
            $name = isset($a['n']) && $a['n']!=''?$a['n']:'默认名称';
            $alias = isset($a['a']) && $a['a']!=''?$a['a']:'默认别名';
            if(isset($a['pm']))
                $pm = $a['pm'];

            if(in_array($alias,$this->ytArr))
                $yt = $alias;

            if(in_array($alias,$this->localArr))
                $local = $alias;

            if(in_array($alias,$this->positionArr))
                $position = $alias;

            $sql = $sqlbase."('".$name."','".$alias."',$pid,$type,$leaf,$level,$isLast,$ord,1)";
            $cmd = Yii::$app->db->createCommand($sql);
            $cmd->execute();
            $lastId = Yii::$app->db->lastInsertID;
            if($leaf==0){
                if(isset($a['c']) && !empty($a['c'])){
                    $this->initDir($a['c'],$lastId,$level+1,$type,$pm,$yt,$local,$position);
                }
            }else{
                $this->initPm($lastId,$pm,$yt,$local,$position);
            }


            $ord--;
            $i++;
        }
    }

    public function initPm($dir_id,$pmArr,$yt,$local,$position){
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
                            if($pmItem2=='all'){
                                //业态是唯一的 业态下的地方公司也是唯一的
                                if(in_array($yt,$this->ytArr)){
                                    $pArr = [];
                                    $sql = $sqlBase;
                                    //根据业态获取position
                                    $pos1 = Position::find()->where(['alias'=>$yt])->one();
                                    if($pos1){
                                        if($local!=''){
                                            if(in_array($local,$this->localArr)){
                                                //业态的下面一层就是地方公司
                                                $pos2 = Position::find()->where(['alias'=>$local,'p_id'=>$pos1->id])->one();
                                                if($pos2){
                                                    //现在的yt-local = $pos1->alias.'-'.$pos2->alias  例如: stgg-sh stdc-sh
                                                    /*$arrTmp = PositionFunc::getAllLeafChildrenIds($pos2->id);
                                                    $pYtLocalArr = ArrayHelper::merge($pLocalArr,$arrTmp);*/
                                                    $pArr = PositionFunc::getAllLeafChildrenIds($pos2->id);
                                                }
                                            }
                                        }else{
                                            $pArr = PositionFunc::getAllLeafChildrenIds($pos1->id);
                                        }
                                    }
                                    if(!empty($pArr)){
                                        $sqlValueArr = [];
                                        foreach($pArr as $p){
                                            $sqlValueArr[] = '("'.$p.'","'.$dir_id.'","'.$k.'")';
                                        }
                                        $sql .= implode(',',$sqlValueArr);
                                        $cmd = Yii::$app->db->createCommand($sql);
                                        $cmd->execute();
                                    }
                                }
                            }elseif(is_array($pmItem2) && !empty($pmItem2)){


                                //业态是唯一的 业态下的地方公司也是唯一的
                                if(in_array($local,$this->localArr) && in_array($yt,$this->ytArr) ){
                                    $pArr = [];
                                    $sql = $sqlBase;
                                    //根据业态获取position
                                    $pos1 = Position::find()->where(['alias'=>$yt])->one();
                                    if($pos1){
                                        //业态的下面一层就是地方公司
                                        $pos2 = Position::find()->where(['alias'=>$local,'p_id'=>$pos1->id])->one();
                                        if($pos2){
                                            //地方公司下面是部门
                                            foreach($pmItem2 as $posAlias){
                                                if(in_array($posAlias,$this->positionArr)){
                                                    $pos3 = Position::find()->where(['alias'=>$posAlias,'p_id'=>$pos2->id])->one();
                                                    if($pos3){
                                                        $pArr = ArrayHelper::merge($pArr,PositionFunc::getAllLeafChildrenIds($pos3->id));
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    if(!empty($pArr)){
                                        $sqlValueArr = [];
                                        foreach($pArr as $p){
                                            $sqlValueArr[] = '("'.$p.'","'.$dir_id.'","'.$k.'")';
                                        }
                                        $sql .= implode(',',$sqlValueArr);
                                        $cmd = Yii::$app->db->createCommand($sql);
                                        $cmd->execute();
                                    }
                                }
                            }
                        }elseif($type == 'ytlocal2'){
                            //业态是唯一的 业态下的地方公司也是唯一的
                            if(in_array($yt,$this->ytArr)){
                                $pArr = [];

                                //根据业态获取position
                                $pos1 = Position::find()->where(['alias'=>$yt])->one();
                                if($pos1){
                                    foreach($pmItem2 as $posAlias){
                                        $posAliasTmp = $yt.'/'.$posAlias;
                                        $posId = PositionFunc::getIdByAlias($posAliasTmp);
                                        /*var_dump($posId);var_dump($posAliasTmp);
                                        echo "<br/><br/>";*/
                                        //PositionFunc::getAllLeafChildrenIds($posId);
                                        if($posId!==false)
                                            $pArr = ArrayHelper::merge($pArr,PositionFunc::getAllLeafChildrenIds($posId));
                                    }
                                }
                                if(!empty($pArr)){

                                    $pArr = CommonFunc::arrayDivide($pArr);
                                    foreach($pArr as $pArrOne){
                                        /*var_dump(count($pArrOne));
                                        echo "<br/><br/>";*/
                                        $sql = $sqlBase;
                                        $sqlValueArr = [];
                                        foreach($pArrOne as $p){
                                            $sqlValueArr[] = '("'.$p.'","'.$dir_id.'","'.$k.'")';
                                        }
                                        $sql .= implode(',',$sqlValueArr);
                                        $cmd = Yii::$app->db->createCommand($sql);
                                        $cmd->execute();
                                    }
                                    /*echo "<br/><br/>";*/
                                }
                            }
                        }elseif($type == 'single'){
                            $sql = $sqlBase;
                            $sqlValueArr = [];
                            $pids = [];
                            if(is_array($pmItem2) && !empty($pmItem2)){
                                foreach($pmItem2 as $p){
                                    $p_id = PositionFunc::getIdByAlias($p);
                                    if($p_id!==false){
                                        $ids = PositionFunc::getAllLeafChildrenIds($p_id);
                                        $pids = ArrayHelper::merge($pids,$ids);
                                    }
                                }
                            }else{
                                $p_id = PositionFunc::getIdByAlias($pmItem2);
                                if($p_id!==false){
                                    $ids = PositionFunc::getAllLeafChildrenIds($p_id);
                                    $pids = ArrayHelper::merge($pids,$ids);
                                }
                            }
                            if(!empty($pids)){
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