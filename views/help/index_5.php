<?php
    use yii\bootstrap\Html;
?>



<div style="padding:10px;">
    <div class="bg-primary" style="padding:10px 0;">
        <ul >
            <li>5 上传和下载</li>
            <li>5.1 上传权限: 公共上传和个人上传</li>
            <li>5.2 上传主要分为以下4个按钮  *每个职员对于各个板块目录都有相应的上传、下载权限
                <ul>
                    <li>1）“上传”：上传公共文件，有公共或者最高下载权限的职员可下载</li>
                    <li>2）“新建文件夹”：新建公共文件夹，有公共或者最高下载权限的职员可打开</li>
                    <li>3）“上传（个人）”：上传个人（私人）文件，文件上传者和有最高下载权限的职员可下载</li>
                    <li>4）“新建文件夹（个人）”：上传公共文件，文件上传者和有最高下载权限的职员可打开</li>
                </ul>
            </li>

        </ul>
    </div>
    <p class="text-center">
        <img src="/images/help/5.jpg" class="img-thumbnail">
    </p>
    <div  class="bg-primary" style="padding:10px 0;">
        <ul >
            <li>
                5.3 文件上传对话框
                <ul >
                    <li>直接点击“浏览”选择要上传的文件</li>
                </ul>
            </li>
        </ul>
    </div>
    <p class="text-center">
        <img src="/images/help/5-2.jpg" class="img-thumbnail">
    </p>
    <div class="bg-primary" style="padding:10px 0;">
        <ul >
            <li>5.4 文件下载权限：公共下载和最高下载 （个人上传权限，附带可下载自己上传的文件的权限)</li>
            <li>5.5 文件下载：点击文件可直接下载文件
                <ul>
                    <li>上传类型为：公共的文件，只要有公共下载（或者有最高下载）的权限即可下载</li>
                    <li>上传类型为：个人的文件，职员自己通过个人上传权限上传的文件或者有最高下载权限</li>
                </ul>
            </li>
        </ul>
    </div>
    <p class="text-center">
        <img src="/images/help/5-3.jpg" class="img-thumbnail">
    </p>
</div>