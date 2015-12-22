<?php
namespace app\components;

use app\models\Position;
use yii\base\Component;
use yii\helpers\ArrayHelper;
use yii\helpers\BaseArrayHelper;

class PositionFunc extends Component {
    /*
     * 函数getFullRoute ,实现根据position_id(Position表 id字段)获取完整的部门/职位的中文路径
     *
     * @param position_id 位置id
     * @param separator 分隔符 (默认 '>' )
     * return string/null
     */
    public static function getFullRoute($position_id,$separator=' > '){
        $position = Position::find()->where(['id'=>$position_id])->one();
        if($position!==NULL){
            $str = '';
            $str.= self::getFullRoute($position->p_id,$separator);
            if($str!=null){
                $str.= $separator;
            }
            $str.= $position->name;
            return $str;
        }else{
            return null;
        }
    }

    public static function getRouteArr($position_id,$separator=' > '){
        $arr = [
            1 => '--',
            2 => '--',
            3 => '--',
            4 => '--'
        ];
        $position = Position::find()->where(['id'=>$position_id,'is_leaf'=>1])->one();
        if($position){
            $temp = [];
            $parents = self::getParents($position_id);
            for($i=1;$i<=count($parents);$i++){
                if(isset($parents[$i])){
                    $temp[$i] = $parents[$i]->name;
                }
            }

            $count = count($temp);

            if($count==1){
                $arr[4] = $temp[1];
            }elseif($count==2){
                $arr[3] = $temp[1];
                $arr[4] = $temp[2];
            }elseif($count==3){
                $arr[2] = $temp[1];
                $arr[3] = $temp[2];
                $arr[4] = $temp[3];
            }elseif($count==4){
                $arr[1] = $temp[1];
                $arr[2] = $temp[2];
                $arr[3] = $temp[3];
                $arr[4] = $temp[4];
            }elseif($count>4){
                $arr[1] = $temp[1];
                $arr[2] = $temp[2];
                $arr[3] = $temp[3];
                for($j=4;$j<$count;$j++)
                    $arr[3] .= $separator . $temp[$j];
                $arr[4] = $temp[$count];
            }
        }
        return $arr;
    }

    /*
     * 函数getIsLeaf ,实现根据is_leaf(Position表 is_leaf字段) 判断是部门还是职位
     *
     * @param is_leaf  (1, 0, null) 是否为叶子的标志为  1为职位 0为部门 , null= N/A
     * return string/null
     */
    public static function getIsLeaf($is_leaf=NULL){
        if($is_leaf===1){
            return '<span class="label label-info">职位</span>';
        }elseif($is_leaf===0){
            return '<span class="label label-default">部门</span>';
        }else{
            return 'N/A';
        }
    }


    /*
     * 函数getDropDownList ,实现根据is_leaf(Position表 is_leaf字段) 判断是部门还是职位
     *
     * @param integer p_id 父id (默认 0 )
     * @param boolean showLeaf 是否显示叶子层级的标志位 (默认true)
     * @param boolean includeSelf 是否包含自己本身的标志位 (默认false)
     * @param integer level  显示层级数限制 (默认false,不限制)
     * return string/null
     */
    public static function getDropDownList($p_id=0,$showLeaf=true,$includeSelf=false,$level=false){
        $arr = array();

        $list = self::getListArr($p_id,$showLeaf,false,$includeSelf,$level);
        if(!empty($list)){
            foreach($list as $l){
                $prefix = '';
                if($l->p_id>0){
                    for($i=0;$i<$l->level;$i++){
                        $prefix .='&emsp;';
                    }
                    if($l->is_last>0){
                        $prefix .='└';
                    }else{
                        $prefix .='├';
                    }
                }
                $arr[$l->id] = $prefix.$l->name;
            }
        }
        return $arr;
    }


    /*
     * 函数getDropDownList ,实现根据is_leaf(Position表 is_leaf字段) 判断是部门还是职位
     *
     * @param integer p_id 父id (默认 0 )
     * @param boolean showLeaf 是否显示叶子层级的标志位 (默认true)
     * @param boolean includeSelf 是否包含自己本身的标志位 (默认false)
     * @param integer level  显示层级数限制 (默认false,不限制)
     * return array
     */
    public static function getListArr($p_id=0,$showLeaf=true,$showTree=false,$includeSelf=false,$level=false){
        $arr = [];
        $level = $level===false?false:intval($level);
        $position = NULL;
        if($p_id>0){
            //根据p_id(父id)查找对应父对象
            $position = Position::find()->where(['id'=>$p_id])->one();
            if($position==NULL || $position->status==0){ //不存在或者状态禁用则返回空数组
                return [];
            }else if($includeSelf===true){ //将自己本身添加至数组
                $arr[$position->id]= $position;
            }
        }

        if($level>0 || $level===false){  //level正整数 或者 false不限制

            $list = self::getChildren($p_id,$showLeaf);

            if(!empty($list)){
                $nlevel = $level===false?false: intval($level - 1);
                foreach($list as $l){

                    $arr[$l->id] = $l;
                    if($showTree){
                        $prefix = '';
                        if($l->level>1){
                            for($i=1;$i<$l->level;$i++){
                                $prefix.='&emsp;';
                            }
                            if($l->is_last>0){
                                $prefix.='└─ ';
                            } else{
                                $prefix.='├─ ';
                            }
                        }
                        $arr[$l->id]->name = $prefix.$l->name;
                    }

                    if($nlevel === false || $nlevel > 0){
                        $children = self::getListArr($l->id,$showLeaf,$showTree,false,$nlevel);
                        $childrenIds = array();
                        if(!empty($children)){
                            foreach($children as $child){
                                $arr[$child->id] = $child;
                                $childrenIds[]=$child->id;
                            }
                        }
                        $arr[$l->id]->childrenIds = $childrenIds;
                    }

                }
            }
        }
        return $arr;
    }

    /*
     * 函数getChildren ,实现根据 p_id 获取子层级 （单层）
     *
     * @param integer p_id 父id (默认 0 )
     * @param boolean showLeaf 是否显示叶子层级的标志位 (默认true)
     * @param boolean status 状态 (默认1)
     * @param string orderBy  排序方法
     * return array
     */
    public static function getChildren($p_id,$showLeaf=true,$status=1,$orderBy='ord DESC,id DESC'){
        if($p_id === false){
            return [];
        }else{
            $where['p_id'] = $p_id;
            $where['status'] = $status;
            if($showLeaf==false)
                $where['is_leaf'] = 0;
            return Position::find()->where($where)->orderBy($orderBy)->all();
        }

    }

    public static function getAllChildrenIds($p_id){
        $arr = [];
        $children = self::getChildren($p_id);
        if($children && !empty($children)){
            foreach($children as $c){
                $arr[] = $c->id;
                $children2 = self::getAllChildrenIds($c->id);
                $arr = ArrayHelper::merge($arr,$children2);
            }
        }
        return $arr;
    }

    public static function getAllLeafChildrenIds($p_id){
        $arr = [];
        $curPos = Position::find()->where(['id'=>$p_id])->one();
        if($curPos){
            if($curPos->is_leaf){
                $arr[] = $curPos->id;
            }else{
                $children = self::getChildren($p_id);
                if($children && !empty($children)){
                    foreach($children as $c){
                        if($c->is_leaf==1){
                            $arr[] = $c->id;
                        }else{
                            $children2 = self::getAllLeafChildrenIds($c->id);
                            $arr = ArrayHelper::merge($arr,$children2);
                        }
                    }
                }
            }
        }

        return $arr;
    }

    /*
     * 函数getParents ,实现根据 当前position_id 递归获取全部父层级 id
     *
     * @param integer position_id
     * return array
     */
    public static function getParents($position_id){
        $arr = [];
        $curPos = Position::find()->where(['id'=>$position_id,'status'=>1])->one();
        if($curPos){
            $arr[$curPos->level] = $curPos;
            $arr2 = self::getParents($curPos->p_id);
            $arr = BaseArrayHelper::merge($arr,$arr2);
        }
        ksort($arr);
        return $arr;
    }

    /*
    * 函数 handleIsLastAndIsLeaf , 修改了职位信息后，批量更新is_last，is_leaf字段
    *
    * @param integer p_id  父id
    * no return
    */
    public static function handleIsLastAndIsLeaf($p_id=0){
        $where['p_id']=$p_id;
        $where['status']=1;
        $positions = Position::find()->where($where)->orderBy('ord Desc,id DESC')->all();
        if(!empty($positions)){
            Position::updateAll(['is_last'=>0],['p_id'=>$p_id]);
            $count = count($positions);
            $i = 0;
            foreach($positions as $p){
                $i++;
                self::handleIsLastAndIsLeaf($p->id);
                if($i==$count){
                    Position::updateAll(['is_last'=>1],['id'=>$p->id]);
                }
            }
        }else{
            //Position::updateAll(['is_leaf'=>1],['id'=>$p_id]);
        }
    }

    public static function getAdminName($adminId){
        $adminId = intval($adminId);
        switch ($adminId){
            case 0:
                $name ='否';break;
            case 1:
                $name ='超级管理员';break;
            case 2:
                $name ='普通管理员';break;
            default:
                $name = 'N/A';
        }
        return $name;
    }

    public static function getIdByAlias($alias,$p_id=false){
        $returnId = false;
        $aliasArr = explode('/',$alias);
        //if(count($aliasArr)>1){
        if($p_id===false){
            $p_id = 0;
            foreach($aliasArr as $a){
                $p_id = self::getIdByAlias($a,$p_id);
                if($p_id===false)
                    break;
            }
            $returnId = $p_id;
        }else{
            $pos = Position::find()->where(['alias'=>$alias,'p_id'=>$p_id])->one();
            if($pos){
                $returnId = $pos->id;
            }
        }
        return $returnId;
    }
}