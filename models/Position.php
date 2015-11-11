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
            [['id, status, p_id, ord, is_leaf, is_last, level, is_class'], 'integer'],
            ['name', 'string', 'max'=>100],
            [['describe'],'safe']
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
            if(isset($a['c'])){
                $this->array2value($a['c'],Yii::$app->db->lastInsertID,$level+1);
            }
            $ord--;
        }
    }
}