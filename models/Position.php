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
    public function install() {
        try {
            $exist = Position::find()->one();
            if($exist){
                throw new yii\base\Exception('Position has installed');
            }


            $arr1 = array(
                array('n'=>'总经办','cl'=>true,'c'=>array(
                    array('n'=>'总经理','l'=>true),
                    array('n'=>'副总经理','l'=>true),
                    array('n'=>'策划总监','l'=>true),
                    array('n'=>'总经理助理','l'=>true)
                )
                ),
                array('n'=>'综合管理平台','cl'=>true,'c'=>array(
                    array('n'=>'财务部','cl'=>true,'c'=>array(
                        array('n'=>'总监','l'=>true),
                        array('n'=>'副总监','l'=>true),
                        array('n'=>'经理','l'=>true),
                        array('n'=>'主管','l'=>true),
                        array('n'=>'专员','l'=>true)
                    )
                    ),
                    array('n'=>'行政部','cl'=>true,'c'=>array(
                        array('n'=>'总监','l'=>true),
                        array('n'=>'副总监','l'=>true),
                        array('n'=>'经理','l'=>true),
                        array('n'=>'主管','l'=>true),
                        array('n'=>'专员','l'=>true)
                    )
                    ),
                    array('n'=>'人事部','cl'=>true,'c'=>array(
                        array('n'=>'总监','l'=>true),
                        array('n'=>'副总监','l'=>true),
                        array('n'=>'经理','l'=>true),
                        array('n'=>'主管','l'=>true),
                        array('n'=>'专员','l'=>true)
                    )
                    ),
                    array('n'=>'后勤部','cl'=>true,'c'=>array(
                        array('n'=>'经理','l'=>true),
                        array('n'=>'主管','l'=>true),
                        array('n'=>'专员','l'=>true)
                    )
                    ),
                )
                ),
                array('n'=>'开发拓展部','cl'=>true,'c'=>array(
                    array('n'=>'总监','l'=>true),
                    array('n'=>'副总监','l'=>true),
                    array('n'=>'经理','l'=>true),
                    array('n'=>'主管','l'=>true),
                    array('n'=>'专员','l'=>true)
                )
                ),
                array('n'=>'市场策划部','cl'=>true,'c'=>array(
                    array('n'=>'总监','l'=>true),
                    array('n'=>'副总监','l'=>true),
                    array('n'=>'经理','l'=>true),
                    array('n'=>'主管','l'=>true),
                    array('n'=>'专员','l'=>true)
                )
                ),
                array('n'=>'销售业务部','cl'=>true,'c'=>array(
                    array('n'=>'项目案场[A]','c'=>array(
                        array('n'=>'项目管理','c'=>array(
                            array('n'=>'总监','l'=>true),
                            array('n'=>'副总监','l'=>true),
                            array('n'=>'经理','l'=>true),
                        )
                        ),
                        array('n'=>'案场策划','c'=>array(
                            array('n'=>'副总监','l'=>true),
                            array('n'=>'经理','l'=>true),
                            array('n'=>'主管','l'=>true),
                            array('n'=>'专员','l'=>true)
                        )
                        ),
                        array('n'=>'案场销售','c'=>array(
                            array('n'=>'客户主管','l'=>true),
                        )
                        ),
                        array('n'=>'案场客服','c'=>array(
                            array('n'=>'客户代表','l'=>true),
                        )
                        ),
                        array('n'=>'案场行政','c'=>array(
                            array('n'=>'主管','l'=>true),
                            array('n'=>'专员','l'=>true),
                        )
                        ),
                    )
                    ),
                    array('n'=>'项目案场[B]','c'=>array(
                        array('n'=>'项目管理','c'=>array(
                            array('n'=>'总监','l'=>true),
                            array('n'=>'副总监','l'=>true),
                            array('n'=>'经理','l'=>true),
                        )
                        ),
                        array('n'=>'案场策划','c'=>array(
                            array('n'=>'副总监','l'=>true),
                            array('n'=>'经理','l'=>true),
                            array('n'=>'主管','l'=>true),
                            array('n'=>'专员','l'=>true)
                        )
                        ),
                        array('n'=>'案场销售','c'=>array(
                            array('n'=>'客户主管','l'=>true),
                        )
                        ),
                        array('n'=>'案场客服','c'=>array(
                            array('n'=>'客户代表','l'=>true),
                        )
                        ),
                        array('n'=>'案场行政','c'=>array(
                            array('n'=>'主管','l'=>true),
                            array('n'=>'专员','l'=>true),
                        )
                        ),
                    )
                    ),
                )
                )
            );
            $arr1x = array(
                array('n'=>'总经办','cl'=>true),
                array('n'=>'综合管理平台','cl'=>true,'c'=>array(
                    array('n'=>'财务部','cl'=>true),
                    array('n'=>'行政部','cl'=>true),
                    array('n'=>'人事部','cl'=>true),
                    array('n'=>'后勤部','cl'=>true),
                )
                ),
                array('n'=>'开发拓展部','cl'=>true),
                array('n'=>'市场策划部','cl'=>true),
                array('n'=>'销售业务部','cl'=>true),
            );
            $arr2 = array(
                array('n'=>'总经办','cl'=>true,'c'=>array(
                    array('n'=>'总经理','l'=>true),
                    array('n'=>'副总经理','l'=>true),
                    array('n'=>'总经理助理','l'=>true)
                )
                ),
                array('n'=>'综合管理平台','cl'=>true,'c'=>array(
                    array('n'=>'财务部','cl'=>true,'c'=>array(
                        array('n'=>'总监','l'=>true),
                        array('n'=>'副总监','l'=>true),
                        array('n'=>'经理','l'=>true),
                        array('n'=>'主管','l'=>true),
                        array('n'=>'专员','l'=>true)
                    )
                    ),
                    array('n'=>'行政部','cl'=>true,'c'=>array(
                        array('n'=>'总监','l'=>true),
                        array('n'=>'副总监','l'=>true),
                        array('n'=>'经理','l'=>true),
                        array('n'=>'主管','l'=>true),
                        array('n'=>'专员','l'=>true)
                    )
                    ),
                    array('n'=>'人事部','cl'=>true,'c'=>array(
                        array('n'=>'总监','l'=>true),
                        array('n'=>'副总监','l'=>true),
                        array('n'=>'经理','l'=>true),
                        array('n'=>'主管','l'=>true),
                        array('n'=>'专员','l'=>true)
                    )
                    ),
                    array('n'=>'后勤部','cl'=>true,'c'=>array(
                        array('n'=>'经理','l'=>true),
                        array('n'=>'主管','l'=>true),
                        array('n'=>'专员','l'=>true)
                    )
                    ),
                )
                ),
                array('n'=>'开发拓展部','cl'=>true,'c'=>array(
                    array('n'=>'总监','l'=>true),
                    array('n'=>'副总监','l'=>true),
                    array('n'=>'经理','l'=>true),
                    array('n'=>'主管','l'=>true),
                    array('n'=>'专员','l'=>true)
                )
                ),
                array('n'=>'AE策划部','cl'=>true,'c'=>array(
                    array('n'=>'总监','l'=>true),
                    array('n'=>'副总监','l'=>true),
                    array('n'=>'经理','l'=>true),
                    array('n'=>'主管','l'=>true),
                    array('n'=>'专员','l'=>true)
                )
                ),
                array('n'=>'创意部','cl'=>true,'c'=>array(
                    array('n'=>'部门管理','c'=>array(
                        array('n'=>'总监','l'=>true),
                        array('n'=>'副总监','l'=>true),
                        array('n'=>'经理','l'=>true),
                    )
                    ),
                    array('n'=>'设计','c'=>array(
                        array('n'=>'指导','l'=>true),
                        array('n'=>'师','l'=>true),
                        array('n'=>'专员','l'=>true),
                        array('n'=>'助理','l'=>true),
                    )
                    ),
                    array('n'=>'文案','c'=>array(
                        array('n'=>'指导','l'=>true),
                        array('n'=>'师','l'=>true),
                        array('n'=>'专员','l'=>true),
                        array('n'=>'助理','l'=>true),
                    )
                    ),
                )
                ),
                array('n'=>'创作部','cl'=>true,'c'=>array(
                    array('n'=>'创作1部','c'=>array(
                        array('n'=>'部门管理','c'=>array(
                            array('n'=>'总监','l'=>true),
                            array('n'=>'副总监','l'=>true),
                            array('n'=>'经理','l'=>true),
                        )
                        ),
                        array('n'=>'设计','c'=>array(
                            array('n'=>'指导','l'=>true),
                            array('n'=>'师','l'=>true),
                            array('n'=>'专员','l'=>true),
                            array('n'=>'助理','l'=>true),
                        )
                        ),
                        array('n'=>'文案','c'=>array(
                            array('n'=>'指导','l'=>true),
                            array('n'=>'师','l'=>true),
                            array('n'=>'专员','l'=>true),
                            array('n'=>'助理','l'=>true),
                        )
                        ),
                    )
                    ),
                    array('n'=>'创作2部','c'=>array(
                        array('n'=>'部门管理','c'=>array(
                            array('n'=>'总监','l'=>true),
                            array('n'=>'副总监','l'=>true),
                            array('n'=>'经理','l'=>true),
                        )
                        ),
                        array('n'=>'设计','c'=>array(
                            array('n'=>'指导','l'=>true),
                            array('n'=>'师','l'=>true),
                            array('n'=>'专员','l'=>true),
                            array('n'=>'助理','l'=>true),
                        )
                        ),
                        array('n'=>'文案','c'=>array(
                            array('n'=>'指导','l'=>true),
                            array('n'=>'师','l'=>true),
                            array('n'=>'专员','l'=>true),
                            array('n'=>'助理','l'=>true),
                        )
                        ),
                    )
                    ),
                )
                )
            );
            $arr2x = array(
                array('n'=>'总经办','cl'=>true),
                array('n'=>'综合管理平台','cl'=>true,'c'=>array(
                    array('n'=>'财务部','cl'=>true),
                    array('n'=>'行政部','cl'=>true),
                    array('n'=>'人事部','cl'=>true),
                    array('n'=>'后勤部','cl'=>true),
                )
                ),
                array('n'=>'开发拓展部','cl'=>true),
                array('n'=>'AE策划部','cl'=>true),
                array('n'=>'创意部','cl'=>true),
                array('n'=>'创作部','cl'=>true)
            );
            $arr = array(
                array('n'=>'管理员','cl'=>true,'l'=>true),
                array('n'=>'颂唐控股','cl'=>true,'c'=>array(
                    array('n'=>'总部平台','cl'=>true,'c'=>array(
                        array('n'=>'发展资源中心','cl'=>true),
                        array('n'=>'企业形象中心','cl'=>true),
                        array('n'=>'行政管控中心','cl'=>true),
                        array('n'=>'财务管控中心','cl'=>true),
                        array('n'=>'市场研究中心','cl'=>true),
                    )
                    ),
                )
                ),
                array('n'=>'颂唐地产研究院','cl'=>true),
                array('n'=>'华麦建筑','cl'=>true),
                array('n'=>'颂唐地产','cl'=>true,'c'=>array(
                    array('n'=>'颂唐地产(总公司)','cl'=>true,'c'=>$arr1x),
                    array('n'=>'上海颂唐地产','cl'=>true,'c'=>$arr1),
                    array('n'=>'苏州颂唐地产','cl'=>true,'c'=>$arr1),
                    array('n'=>'无锡颂唐地产','cl'=>true,'c'=>$arr1),
                    array('n'=>'南京颂唐地产','cl'=>true,'c'=>$arr1),
                    array('n'=>'安徽颂唐地产','cl'=>true,'c'=>$arr1),
                    array('n'=>'苏北颂唐地产','cl'=>true,'c'=>$arr1),
                )
                ),
                array('n'=>'XX房屋','cl'=>true),
                array('n'=>'XX经纪','cl'=>true),
                array('n'=>'XX置业','cl'=>true),
                array('n'=>'日鑫商业','cl'=>true),
                array('n'=>'颂唐广告','cl'=>true,'c'=>array(
                    array('n'=>'颂唐广告(总公司)','cl'=>true,'c'=>$arr2x),
                    array('n'=>'苏州颂唐广告','cl'=>true,'c'=>$arr2),
                    array('n'=>'南京颂唐广告','cl'=>true,'c'=>$arr2),
                    array('n'=>'安徽颂唐广告','cl'=>true,'c'=>$arr2),
                )
                ),
                array('n'=>'XX公关'),
                array('n'=>'XX数码互动'),
                array('n'=>'XX物业'),
            );
            $this->array2value($arr,0,1);
            return true;
        }catch (\Exception $e)
        {
            echo  'Position install failed<br />';
            $message = $e->getMessage() . "\n";
            $errorInfo = $e instanceof \PDOException ? $e->errorInfo : null;
            echo $message;
            /*echo '<br/><br/>';
            var_dump($errorInfo);*/

            //throw new \Exception($message, $errorInfo, (int) $e->getCode(), $e);
            return false;
        }
    }

    public function install2() {
        try {
            $exist = Position::find()->one();
            if($exist){
                throw new yii\base\Exception('Position has installed');
            }

            $zhiji1 = [
                ['n'=>'总监','l'=>true],
                ['n'=>'副总监','l'=>true],
                ['n'=>'经理','l'=>true],
                ['n'=>'主管','l'=>true],
                ['n'=>'专员','l'=>true]
            ];

            $zhiji2 = [
                ['n'=>'总经理','l'=>true],
                ['n'=>'副总经理','l'=>true],
                ['n'=>'总监','l'=>true],
                ['n'=>'总经理助理','l'=>true]
            ];

            $zhiji3 = [
                ['n'=>'总监','l'=>true],
                ['n'=>'副总监','l'=>true],
                ['n'=>'经理','l'=>true]
            ];

            $zhiji4 = [
                ['n'=>'指导','l'=>true],
                ['n'=>'师','l'=>true],
                ['n'=>'专员','l'=>true],
                ['n'=>'助理','l'=>true]
            ];

            $anchang1 = [
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

            $guanggao = [
                ['n'=>'部门管理','c'=>$zhiji3],
                ['n'=>'设计','c'=>$zhiji4],
                ['n'=>'文案','c'=>$zhiji4],
            ];
            $bumen1 = [
                ['n'=>'总经办','c'=>$zhiji2],
                ['n'=>'财务部','c'=>$zhiji1],
                ['n'=>'综合管理部','c'=>$zhiji1],
                ['n'=>'开发拓展部','c'=>$zhiji1],
                ['n'=>'市场策划部','c'=>$zhiji1],
                ['n'=>'销售业务部','c'=>[
                    ['n'=>'项目案场[A]','c'=>$anchang1],
                    ['n'=>'项目案场[B]','c'=>$anchang1],
                    ['n'=>'项目案场[C]','c'=>$anchang1]
                ]]
            ];
            $bumen2 = [
                ['n'=>'销售业务部','c'=>[
                    ['n'=>'项目案场[A]','c'=>$zhiji1],
                    ['n'=>'项目案场[B]','c'=>$zhiji1]
                ]]
            ];

            $bumen3 = [
                ['n'=>'总经办','c'=>[
                   ['n'=>'总经理','l'=>true],
                   ['n'=>'副总经理','l'=>true],
                   ['n'=>'总经理助理','l'=>true]
                ]],
                ['n'=>'财务部','c'=>$zhiji1],
                ['n'=>'综合管理部','c'=>$zhiji1],
                ['n'=>'开发拓展部','c'=>$zhiji1],
                ['n'=>'AE策划部','c'=>$zhiji1],
                ['n'=>'创意部','c'=>$guanggao],
                ['n'=>'创作部','c'=>[
                    ['n'=>'创作1部','c'=>$guanggao],
                    ['n'=>'创作2部','c'=>$guanggao],
                    ['n'=>'创作3部','c'=>$guanggao]
                ]],


            ];




            $arr = [
                ['n'=>'管理员','l'=>true],
                ['n'=>'颂唐机构','c'=>[
                    ['n'=>'上海总部平台','c'=>[
                        ['n'=>'企宣管控中心','c'=>$zhiji1],
                        ['n'=>'发展管控中心','c'=>$zhiji1],
                        ['n'=>'行政管控中心','c'=>$zhiji1],
                        ['n'=>'财务管控中心','c'=>$zhiji1]
                    ]]
                ]],
                ['n'=>'市场策略中心','c'=>[
                    ['n'=>'上海总部平台','c'=>$zhiji1]
                ]],
                ['n'=>'华麦建筑','c'=>[
                    ['n'=>'上海华麦建筑']
                ]],
                ['n'=>'颂唐地产','c'=>[
                    ['n'=>'上海颂唐地产','c'=>$bumen1],
                    ['n'=>'苏州颂唐地产','c'=>$bumen1],
                    ['n'=>'无锡颂唐地产','c'=>$bumen1],
                    ['n'=>'南京颂唐地产','c'=>$bumen1],
                    ['n'=>'安徽颂唐地产','c'=>$bumen1],
                    ['n'=>'苏北颂唐地产','c'=>$bumen1],
                ]],
                ['n'=>'汉佑房屋','c'=>[
                    ['n'=>'苏州汉佑房屋','c'=>[
                        ['n'=>'新湖明珠店','c'=>$zhiji1],
                        ['n'=>'石湖店','c'=>$zhiji1]
                    ]],
                    ['n'=>'无锡汉佑房屋']
                ]],
                ['n'=>'致秦经纪','c'=>[
                   ['n'=>'上海致秦经纪','c'=>$bumen2],
                   ['n'=>'苏州致秦经纪','c'=>$bumen2],
                   ['n'=>'无锡致秦经纪','c'=>$bumen2],
                   ['n'=>'南京致秦经纪','c'=>$bumen2],
                   ['n'=>'合肥致秦经纪','c'=>$bumen2],
                ]],
                ['n'=>'明致置业','c'=>[
                   ['n'=>'上海明致置业'],
                   ['n'=>'南京明致置业']
                ]],
                ['n'=>'日鑫商业','c'=>[
                    ['n'=>'上海日鑫商业','c'=>$bumen1],
                    ['n'=>'苏州日鑫商业','c'=>$bumen1],
                    ['n'=>'无锡日鑫商业','c'=>$bumen1],
                    ['n'=>'南京日鑫商业','c'=>$bumen1],
                    ['n'=>'安徽日鑫商业','c'=>$bumen1],
                    ['n'=>'苏北日鑫商业','c'=>$bumen1],
                ]],
                ['n'=>'颂唐广告','c'=>[
                    ['n'=>'上海颂唐广告','c'=>$bumen3],
                    ['n'=>'苏州颂唐广告','c'=>$bumen3],
                    ['n'=>'南京颂唐广告','c'=>$bumen3],
                    ['n'=>'安徽颂唐广告','c'=>$bumen3]
                ]],
                ['n'=>'尚晋公关','c'=>[
                    ['n'=>'苏州尚晋公关','c'=>$zhiji1],
                ]],
                ['n'=>'元素互动','c'=>[
                    ['n'=>'上海元素互动','c'=>$zhiji1],
                ]],
                ['n'=>'周道物业','c'=>[
                    ['n'=>'苏州周道物业','c'=>$zhiji1],
                ]]
            ];


            $this->array2value($arr,0,1);
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

        $sqlbase = "INSERT IGNORE INTO `position`(`name`,`p_id`,`is_leaf`,`is_class`,`level`,`ord`,`status`)
                VALUES";
        $ord = 99;
        foreach($arr as $a){
            $is_leaf = isset($a['l']) && $a['l']==1?1:0;
            $is_class = isset($a['cl']) && $a['cl']==1?1:0;

            $sql =$sqlbase."('".$a['n']."',$pid,$is_leaf,$is_class,$level,$ord,1)";
            $cmd = Yii::$app->db->createCommand($sql);
            $cmd->execute();

            //$lastId = Yii::app()->db->lastInsertID;
            if(isset($a['c']) && !empty($a['c'])){
                $this->array2value($a['c'],Yii::$app->db->lastInsertID,$level+1);
            }
            $ord--;
        }
    }
}