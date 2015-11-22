<?php
namespace app\components;

use yii\base\Component;

class CommonFunc extends Component {
    public static function getGender($type){
        if($type==1){
            return '男';
        }elseif($type==2){
            return '女';
        }else{
            return 'N/A';
        }
    }

    public static function getJoinDay($join_date){
        $arr = array();
        $joinTimestamp = strtotime($join_date);
        $now = time();
        $arr['day'] = intval(abs($now-$joinTimestamp)/86400);
        $join_date = date('y-m-d',$joinTimestamp);
        $today = date('y-m-d');
        $ymdArr =self::diffDate($join_date,$today);
        $arr['yearMonth'] = $ymdArr[0].'年'.$ymdArr[1].'个月'.$ymdArr[2].'天';
        return $arr;
    }

    public static function diffDate($date1, $date2) {
        if (strtotime($date1) > strtotime($date2)) {
            $ymd = $date2;
            $date2 = $date1;
            $date1 = $ymd;
        }
        list($y1, $m1, $d1) = explode('-', $date1);
        list($y2, $m2, $d2) = explode('-', $date2);
        $y = $m = $d = $_m = 0;
        $math = ($y2 - $y1) * 12 + $m2 - $m1;
        $y = intval($math / 12);
        $m = intval($math % 12);
        $d = (mktime(0, 0, 0, $m2, $d2, $y2) - mktime(0, 0, 0, $m2, $d1, $y2)) / 86400;
        if ($d < 0) {
            $m -= 1;
            $d += date('j', mktime(0, 0, 0, $m2, 0, $y2));
        }
        $m < 0 && $y -= 1;
        return array($y, $m, $d);
    }

    /*
     * 权限类型
     * param reverse  键值交换,默认false为 数字对应名称
     * param lang   显示语言 默认为en
     */

    public static function permission_type($reverse=false,$lang='en'){
        if($lang=='zh_cn'){
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

}