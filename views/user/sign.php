<?php
    use yii\helpers\BaseHtml;
    app\assets\AppAsset::addCssFile($this,'css/main/user/sign.css');
    app\assets\AppAsset::addJsFile($this,'js/main/user/sign.js');
?>
<section id="calendar">
    <div id="cal-title" class="clearfix">
        <span class="prev-btn"><?=BaseHtml::a('< 上一月',$prevLink)?></span>
        <span class="ym"><?=$y?> 年 <?=$m?> 月</span>
        <span class="next-btn"><?=BaseHtml::a('下一月 >',$nextLink)?></span>
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
                    if(in_array($d,$signList)){
                        echo '<td class="signed">';
                    }elseif($today==$y.'-'.$m.'-'.$d){
                        echo '<td class="today">';
                    }else{
                        echo '<td>';
                    }
                    echo $d.'</td>';
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
</section>