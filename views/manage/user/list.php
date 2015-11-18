<?php
    use yii\bootstrap\BaseHtml;
    use app\components\CommonFunc;
    use app\components\PositionFunc;
?>

        <?=BaseHtml::a('新增职员',['user-add-and-edit'],['class'=>'btn btn-primary'])?>
        <p></p>
        <table class="table table-bordered">
            <thead>
            <tr>
                <form id="searchForm" method="post">
                    <th>#</th>
                    <th><input id="s_username" name="search[username]" value="<?=$search['username']?>" size="14" /></th>
                    <th><input id="s_name" name="search[name]" value="<?=$search['name']?>" size="10"  /></th>
                    <th>
                        <?=$this->render('/manage/_position')?>
                    </th>
                    <th>
                        <select id="s_gender" name="search[gender]" >
                            <option value="">----</option>
                            <option value="0" <?=$search['gender']!=='' && $search['gender']==0?'selected="selected"':''?>>N/A</option>
                            <option value="1" <?=$search['gender']!=='' && $search['gender']==1?'selected="selected"':''?>>男</option>
                            <option value="2" <?=$search['gender']!=='' && $search['gender']==2?'selected="selected"':''?>>女</option>
                        </select>
                    </th>
                    <th>
                        <input id="s_mobile" name="search[mobile]" value="<?=$search['mobile']?>" size="10"  />
                    </th>
                    <th>
                        <input id="s_phone" name="search[phone]" value="<?=$search['phone']?>" size="10"  />
                    </th>
                    <th>
                        <select id="s_status" name="search[status]" >
                            <option value="">----</option>
                            <option value="0" <?=$search['status']!=='' && $search['status']==0?'selected="selected"':''?>>禁用</option>
                            <option value="1" <?=$search['status']!=='' && $search['status']==1?'selected="selected"':''?>>正常</option>
                        </select>
                    </th>
                    <th><button id="searchBtn">检索</button></th>
                    <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
                </form>
            </tr>
            </thead>
            <thead>
                <tr>
                    <th>#</th>
                    <th>用户名(邮箱)</th>
                    <th>姓名</th>
                    <th>职位</th>
                    <th>性别</th>
                    <th>联系电话(手机)</th>
                    <th>联系电话(座机)</th>
                    <th>状态</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
            <?php if(!empty($list)):?>
            <?php foreach($list as $l):?>
                <tr>
                    <th scope="row"><?=$l->id?></th>
                    <td><?=$l->username?></td>
                    <td><?=$l->name?></td>
                    <td><?=PositionFunc::getFullRoute($l->position_id)?></td>
                    <td><?=CommonFunc::getGender($l->gender)?></td>
                    <td><?=$l->mobile?></td>
                    <td><?=$l->phone?></td>
                    <td><?=$l->status==1?'正常':'禁用'?></td>
                    <td><?=BaseHtml::a('编辑',['user-add-and-edit','id'=>$l->id],['class'=>'btn btn-primary btn-xs'])?></td>
                </tr>
            <?php endforeach;?>
            <?php endif;?>
            </tbody>
        </table>
