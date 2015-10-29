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
            return '--';
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
}