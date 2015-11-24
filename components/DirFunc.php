<?php
namespace app\components;

use app\models\Dir;
use yii\base\Component;
use yii\helpers\BaseArrayHelper;

class DirFunc extends Component {
    /*
     * 函数getFullRoute ,实现根据dir_id(Dir表 id字段)获取完整的板块目录路径
     *
     * @param dir_id 位置id
     * @param separator 分隔符 (默认 '>' )
     * return string/null
     */
    public static function getFullRoute($dir_id,$separator=' > '){
        $dir = Dir::find()->where(['id'=>$dir_id])->one();
        if($dir!==NULL){
            $str = '';
            $str.= self::getFullRoute($dir->p_id,$separator);
            if($str!=null){
                $str.= $separator;
            }
            $str.= $dir->name;
            return $str;
        }else{
            return null;
        }
    }

    /*
     * 函数getIsLeaf ,实现根据is_leaf(dir表 is_leaf字段) 判断是不是底层文件夹
     *
     * @param is_leaf  (1, 0, null) 是否为叶子的标志为
     * return string/null
     */
    public static function getIsLeaf($is_leaf=NULL){
        if($is_leaf===1){
            return '<span class="label label-info">底层目录</span>';
        }elseif($is_leaf===0){
            return '<span class="label label-default">目录</span>';
        }else{
            return 'N/A';
        }
    }

    /*
    * 函数 handleIsLast , 修改了职位信息后，批量更新is_last字段
    *
    * @param integer p_id  父id
    * no return
    */
    public static function getCatalogType($reverse=false){
        $arr = [
            1=>'operator',
            2=>'resource',
            3=>'tool',
            4=>'project',
            5=>'share',
        ];
        if($reverse){
            $arr = array_flip($arr);
        }
        return $arr;
    }

    /*
    * 函数 handleIsLast , 修改了职位信息后，批量更新is_last字段
    *
    * @param integer p_id  父id
    * no return
    */
    /*
     *  获取指定type_id 和 p_id 的当前层所有目录id和name   (既只获取一层目录)
     */

    /*
     * 函数getDropDownList ,实现根据is_leaf(Position表 is_leaf字段) 判断是部门还是职位
     *
     * @param integer p_id 父id (默认 0 )
     * @param boolean showLeaf 是否显示叶子层级的标志位 (默认true)
     * @param boolean includeSelf 是否包含自己本身的标志位 (默认false)
     * @param integer level  显示层级数限制 (默认false,不限制)
     * return string/null
     */

    //public function getDropDownListOne($pid,$type,$showLeaf,$includeSelf=false){

    public static function getDropDownList($p_id=0,$showLeaf=true,$includeSelf=false,$level=false){
        $arr = [];

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

        /*$arr = array();

        $list = $this->getListArrOne($pid,$type,$showLeaf,false,$includeSelf);
        if(!empty($list)){
            foreach($list as $l){
                $prefix = '';
                if($l['p_id']>0){
                    for($i=0;$i<$l['level'];$i++){
                        $prefix .='&emsp;';
                    }
                    if($l['is_last']>0){
                        $prefix .='└';
                    }else{
                        $prefix .='├';
                    }
                }
                $arr[$l['id']] = $prefix.$l['name'];
            }
        }
        return $arr;*/
    }


    /*
     * 函数getDropDownList ,实现根据is_leaf(Dir表 is_leaf字段) 底层
     *
     * @param integer p_id 父id (默认 0 )
     * @param boolean showLeaf 是否显示叶子层级的标志位 (默认true)
     * @param boolean includeSelf 是否包含自己本身的标志位 (默认false)
     * @param integer level  显示层级数限制 (默认false,不限制)
     * return array
     */

    public static function getListArr($p_id=0,$showLeaf=true,$showTree=false,$includeSelf=false,$level=false){
        $arr = [];
        $dir = NULL;
        if($p_id>0){
            //根据p_id(父id)查找对应父对象
            $dir = Dir::find()->where(['id'=>$p_id])->one();
            if($dir==NULL || $dir->status==0){ //不存在或者状态禁用则返回空数组
                return [];
            }else if($includeSelf===true){ //将自己本身添加至数组
                $arr[$dir->id]= $dir;
            }
        }

        $level = $level===false?false:intval($level);
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
     * 函数getDropDownArr ,实现根据is_leaf(Dir表 is_leaf字段) 底层
     *
     * @param integer p_id 父id (默认 0 )
     * @param boolean showLeaf 是否显示叶子层级的标志位 (默认true)
     * @param boolean includeSelf 是否包含自己本身的标志位 (默认false)
     * @param integer level  显示层级数限制 (默认false,不限制)
     * return array  递归
     */

    public static function getChildrenArr($p_id=0,$showLeaf=true,$showTree=false,$includeSelf=false,$level=false){
        $arr = [];
        $dir = NULL;
        if($p_id>0){
            //根据p_id(父id)查找对应父对象
            $dir = Dir::find()->where(['id'=>$p_id])->one();
            if($dir==NULL || $dir->status==0){ //不存在或者状态禁用则返回空数组
                return [];
            }else if($includeSelf===true){ //将自己本身添加至数组
                $arr[$dir->id]= $dir;
            }
        }

        $level = $level===false?false:intval($level);
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
                        $children = self::getChildrenArr($l->id,$showLeaf,$showTree,false,$nlevel);
                        $childrenIds = [];
                        $childrenList = [];
                        if(!empty($children)){
                            foreach($children as $child){
                                //$arr[$child->id] = $child;
                                $childrenIds[]=$child->id;
                                $childrenList[]=$child;
                            }
                        }
                        $arr[$l->id]->childrenIds = $childrenIds;
                        $arr[$l->id]->childrenList = $childrenList;
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
    public static function getChildren($p_id,$showLeaf=true,$status=1,$orderBy='ord DESC,id DESC',$limit=false){
        $where['p_id'] = $p_id;
        $where['status'] = $status;
        if($showLeaf==false)
            $where['is_leaf'] = 0;
        return Dir::find()->where($where)->orderBy($orderBy)->limit($limit)->all();
    }

    /*
     * 函数getParents ,实现根据 当前dir_id 递归获取全部父层级 id
     *
     * @param integer dir_id
     * return array
     */
    public static function getParents($dir_id){
        $arr = [];
        $curDir = Dir::find()->where(['id'=>$dir_id,'status'=>1])->one();
        if($curDir){
            $arr[$curDir->level] = $curDir;
            $arr2 = self::getParents($curDir->p_id);
            $arr = BaseArrayHelper::merge($arr,$arr2);
        }
        ksort($arr);
        return $arr;
    }

    /*
    * 函数 handleIsLastAndIsLeaf , 修改了职位信息后，批量更新is_last,is_leaf字段
    *
    * @param integer p_id  父id
    * no return
    */
    public static function handleIsLastAndIsLeaf($p_id=0){
        $where['p_id']=$p_id;
        $where['status']=1;
        $dirs = Dir::find()->where($where)->orderBy('ord Desc,id DESC')->all();
        if(!empty($dirs)){
            Dir::updateAll(['is_last'=>0],['p_id'=>$p_id]);
            $count = count($dirs);
            $i = 0;
            foreach($dirs as $d){
                $i++;
                self::handleIsLastAndIsLeaf($d->id);
                if($i==$count){
                    Dir::updateAll(['is_last'=>1],['id'=>$d->id]);
                }
            }
        }else{
            Dir::updateAll(['is_leaf'=>1],['id'=>$p_id]);
        }
    }
}