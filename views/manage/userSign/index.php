<?php
use yii\helpers\BaseHtml;
use app\components\CommonFunc;
app\assets\AppAsset::addCssFile($this,'css/manage/user-sign.css');
app\assets\AppAsset::addJsFile($this,'js/manage/user-sign.js');
?>
<section id="calendar">
    <div id="cal-title" class="clearfix">
        <span class="prev-btn"><?=BaseHtml::a('< 上月',$prevLink,['class'=>'btn btn-primary btn-xs'])?></span>
        <span class="ym"><?=$y?> 年 <?=$m?> 月</span>
        <span class="next-btn"><?=BaseHtml::a('下月 >',$nextLink,['class'=>'btn btn-primary btn-xs'])?></span>
    </div>

    <table class="table-bordered">
        <tr>
            <th>日</th>
            <th>一</th>
            <th>二</th>
            <th>三</th>
            <th>四</th>
            <th>五</th>
            <th>六</th>
        </tr>
        <tr>
            <?php for($i=0;$i<$weekdayFirst;$i++):?>
                <td></td>
            <?php endfor;?>
            <?php for($d=1;$d<=$dayNum;$d++):?>
                <?php
                if($i>6){
                    $i=0;
                    echo '<tr>';
                }
                $thisDay = $y.'-'.$m.'-'.($d>9?$d:'0'.$d);
                $isHoliday = CommonFunc::isHoliday($thisDay,$i);

                if($isHoliday){//节假日
                    echo '<td class="holiday">';
                }/*elseif(in_array($d,$signList)){//已签到
                    echo '<td class="signed">';
                }*/elseif($today==$thisDay){//今天
                    echo '<td class="today" this-day="'.$thisDay.'">';
                }else{
                    echo '<td class="day" this-day="'.$thisDay.'">';
                }
                echo $d;
                if($isHoliday){//节假日

                }/*elseif(in_array($d,$signList)){//已签到
                    echo '<td class="signed">';
                }*/elseif($today==$thisDay){//今天
                    echo '<br/><span class="sign_num">'.$signNum[$d].'</span>';
                }else{
                    echo '<br/><span class="sign_num">'.$signNum[$d].'</span>';
                }
                echo '</td>';
                if($i==6){
                    echo '</tr>';
                }
                $i++;
                ?>
            <?php endfor;?>
            <?php for($j=$i;$j<7;$j++):?>
                <td></td>
                <?php
                if($j==6){
                    echo '</tr>';
                }
                ?>

            <?php endfor;?>
    </table>
    <div style="text-align: right;">* 白底红字的日期为节假日，无需签到</div>
</section>