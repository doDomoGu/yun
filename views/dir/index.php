<div class="row">

<?php foreach($list as $l):?>
    <div class="col-md-3">
        <div>
            <a href="/dir?dir_id=<?=$l->id?>">
                <!--<span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>-->
                <img src="/images/fileicon/dir.png">
            </a>
        </div>
        <div class="name">
            <a href="/dir?dir_id=<?=$l->id?>">
                <?=$l->name?>
            </a>
        </div>
    </div>
<?php endforeach;?>
</div>