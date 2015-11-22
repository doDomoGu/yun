<?php
namespace app\components;

use yii\base\Component;

class PermissionFunc extends Component {
    /*
     * 权限类型
     * param reverse  键值交换,默认false为 数字对应名称
     * param lang   显示语言 默认为en
     */

    public static function getPermissionTypeArr($reverse=false,$lang='en'){
        if($lang=='cn'){
            $arr = [
                11=>'上传(公共)',  //普通通用权限
                12=>'下载(公共)',  //下载，查看
                13=>'修改(公共)',
                14=>'删除(公共)',

                21=>'上传(个人)',  //限制个人 自己的文件其他人不可见（除拥有最高权限）
                22=>'下载(个人)',
                23=>'修改(个人)',
                24=>'删除(个人)',

                31=>'上传(最高)',  //最高权限 可看全部，特别是属于个人的文件
                32=>'下载(最高)',
                33=>'修改(最高)',
                34=>'删除(最高)',
            ];
        }else{
            $arr = [
                11=>'upload',
                12=>'download',
                13=>'edit',
                14=>'delete',

                21=>'upload_person',
                22=>'download_person',
                23=>'edit_person',
                24=>'delete_person',

                31=>'upload_all',
                32=>'download_all',
                33=>'edit_all',
                34=>'delete_all',
            ];
        }
        if($reverse){
            $arr = array_flip($arr);
        }
        return $arr;
    }

    public static function getPermissionTypeId($word,$lang='en'){
        $arr = self::getPermissionTypeArr(true,$lang);
        return isset($arr[$word])?$arr[$word]:false;
    }

    public static function getPermissionTypeNameCn($word){
        $tid = self::getPermissionTypeId($word);
        if($tid){
            $arr2 = self::getPermissionTypeArr(false,'cn');
            return isset($arr2[$tid])?$arr2[$tid]:false;
        }else
            return false;
    }

}