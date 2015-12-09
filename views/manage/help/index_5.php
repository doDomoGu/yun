<?=$this->render('_nav')?>
<div style="padding:10px;">
    <div class="bg-primary" style="padding:10px 0;">
        <ul >
            <li>5 目录权限</li>
            <li>5.1 进入目录权限管理页面：<br/>通过 “职位/部门”列表页，点击某个职位的“目录权限”按钮，进入当前职位的目录权限管理页面</li>
            <!--<li>5.1 管理列表：显示所有职员</li>
            <li>5.2 职员资料
                <ul>
                    <li>用户名（邮箱）：用来作为登录系统的用户名</li>
                    <li>姓名：职员姓名</li>
                    <li>职位：职员对应职位（一个职员只能对应一个职位）</li>
                    <li>性别</li>
                    <li>联系电话：手机</li>
                    <li>联系电话：座机</li>
                    <li>状态</li>
                </ul>
            </li>-->

        </ul>
    </div>
    <p class="text-center">
        <img src="/images/manage-help/5.jpg" class="img-thumbnail">
    </p>
    <div  class="bg-primary" style="padding:10px 0;">
        <ul >
            <li>
                5.2 目录权限管理页面
                <ul>
                    <li>目录权限为一个职位和一个目录对应的权限关系</li>
                    <li>权限分为4种，上传（公共）、下载（公共）、上传（个人）、下载（最高）
                        <ul>
                            <li>上传（公共）：通过此上传的文件需要有对应的“下载（公共）”权限进行下载</li>
                            <li>下载（公共）：下载通过“上传（公共）”上传的文件</li>
                            <li>上传（个人）：通过此上传的文件，只有自己本人可以下载，或者有最高下载权限</li>
                            <li>下载（最高）：可下载通过各种权限上传的文件</li>
                        </ul>
                    </li>

                </ul>
            </li>
        </ul>
    </div>
    <p class="text-center">
        <img src="/images/manage-help/5-2.jpg" class="img-thumbnail">
    </p>
</div>