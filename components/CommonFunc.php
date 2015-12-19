<?php
namespace app\components;

use yii\base\Component;
use yii;

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
        $arr = ['day'=>null,'yearMonth'=>null];
        $joinTimestamp = strtotime($join_date);
        if($joinTimestamp > 0){
            $now = strtotime(date('y-m-d'));
            if($now-$joinTimestamp > -1){
                $day = intval(abs($now-$joinTimestamp)/86400);
                $arr['day'] = $day;
                $joinday = date('y-m-d',$joinTimestamp);
                $today = date('y-m-d');
                $ymdArr =self::diffDate($joinday,$today);
                $arr['yearMonth'] = $ymdArr[0].'年'.$ymdArr[1].'个月'.$ymdArr[2].'天';
            }
        }
        return $arr;
    }

    public static function getContractDay($contract_date){
        $arr = ['day'=>null,'yearMonth'=>null];
        $contractTimestamp = strtotime($contract_date);
        if($contractTimestamp > 0){
            $now = strtotime(date('y-m-d'));
            if($contractTimestamp - $now > -1){
                $day = intval(abs($contractTimestamp - $now)/86400);
                $arr['day'] = $day;
                $contractday = date('y-m-d',$contractTimestamp);
                $today = date('y-m-d');
                $ymdArr =self::diffDate($today,$contractday);
                $arr['yearMonth'] = $ymdArr[0].'年'.$ymdArr[1].'个月'.$ymdArr[2].'天';
            }
        }
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

    public static function imgUrl($img_url){
        if($img_url!='' && strpos($img_url,'http')===false)
            $img_url = yii::$app->params['qiniu-domain-beaut'].$img_url;
        return $img_url;
    }

    public static function array2string($arr){
        $str = null;
        if(is_array($arr) && !empty($arr)){
            $str = implode(',',$arr);
        }
        return $str;
    }

    public static function arrayDivide($arr,$num=200){
        $arr_obj = [];
        $count = count($arr);
        $i=1;
        $times = ceil($count/$num);
        while($i<=$times){
            $start = ($i-1)*$num;
            $arrTmp = array_slice($arr,$start,$num);
            $arr_obj[] = $arrTmp;
            $i++;
        }
        return $arr_obj;
    }
}