/*$('.dir-item').mouseenter(function(){
    $(this).find('.info').addClass('hover');
}).mouseleave(function(){
    $(this).find('.info').removeClass('hover');
});*/

$('.dir-item .icon').mouseenter(function(){
    $(this).parent('.dir-item').addClass('hover');
}).mouseleave(function(){
    $(this).parent('.dir-item').removeClass('hover');
});

$('.dir-item .info').mouseenter(function(){
    $(this).parent('.dir-item').addClass('hover');
}).mouseleave(function(){
    $(this).parent('.dir-item').removeClass('hover');
});

/*$('.dir-item').click(function(){
    if($(this).attr('download-check')=='enable'){
        if($(this).attr('data-is-dir')=='1'){
            location.href='/dir?p_id='+$(this).attr('data-id');
        }else{
            _download_times = parseInt($(this).find('.download_times span').html())+1;
            $(this).find('.download_times span').html(_download_times);
            location.href='/dir/download?id='+$(this).attr('data-id');
        }
    }else{
        if($(this).attr('data-is-dir')=='1'){
            alert('没有权限打开');
        }else{
            alert('没有下载权限');
        }
    }
});*/

/*$('.clickarea').click(function(){
    _this = $(this).parent('.dir-item');
    if(_this.attr('download-check')=='enable'){
        if(_this.attr('data-is-dir')=='1'){
            location.href='/dir?p_id='+_this.attr('data-id');
        }else{
            _download_times = parseInt(_this.find('.download_times span').html())+1;
            _this.find('.download_times span').html(_download_times);
            location.href='/dir/download?id='+_this.attr('data-id');
        }
    }else{
        if(_this.attr('data-is-dir')=='1'){
            alert('没有权限打开');
        }else{
            alert('没有下载权限');
        }
    }
});*/

$('.downloadBtn').click(function(){
    if(confirm('确认是否要下载这个文件?')){
        _this = $(this).parents('.info');
        _download_times = parseInt(_this.find('.download_times').html())+1;
        _this.find('.download_times').html(_download_times);
        location.href = '/dir/download?id='+$(this).attr('data-id');
    }
});

$('.openBtn').click(function(){
    location.href='/dir?p_id='+$(this).attr('data-id');
});


$('.deleteBtn').click(function(e){
    e.preventDefault();
    if(confirm('确认是否要删除这个文件（移入回收站）?')){
        location.href = $(this).attr('link');
    }
});

$('.previewBtn').click(function(){
    $.ajax({
        url: '/dir/download',
        type: 'get',
        data: {
            id:$(this).attr('data-id'),
            preview:true
        },
        success: function (data) {
            $('#previewContent').html(data);
            $('#previewModal').modal('show');
        }
    });

});

$('#order_select').change(function(){
    location.href = $('#link_'+$(this).val()).val();
});

$('#list_type_select').change(function(){
    location.href = $('#link2_'+$(this).val()).val();
});



$('#createDirModalContent button.btn').click(function(){
    _dirname = $('#createDirModalContent .dirname').val();
    /*console.log(_dirname);*/
    if(_dirname!=''){
        _dir_id = $('#dir_id').val();
        _p_id = $('#p_id').val();
        $.ajax({
            url: '/dir/save',
            type: 'post',
            data: {
                dir_id:_dir_id,
                filename_real:_dirname,
                filename:_dirname,
                filetype:0,
                filesize:0,
                flag:1,
                p_id:_p_id
            },
            dataType:'json',
            success: function (data) {
                if(data.result){
                    if(_dir_id>0){
                        location.href='/dir?dir_id='+_dir_id;
                    }
                    if(_p_id>0){
                        location.href='/dir?p_id='+_p_id;
                    }
                }else{
                    $('#createDirModalContent .create-dir-error').html('<span style="color:red;">没有上传权限</span>');
                }
            }
        });
    }else{
        $('#createDirModalContent .create-dir-error').html('<span style="color:red;">文件夹名不能为空！</span>');
    }
});

$('#createDirModalContent2 button.btn').click(function(){
    _dirname = $('#createDirModalContent2 .dirname').val();
    if(_dirname!='' && _dirname!=undefined){
        _dir_id = $('#dir_id').val();
        _p_id = $('#p_id').val();
        $.ajax({
            url: '/dir/save',
            type: 'post',
            data: {
                dir_id:_dir_id,
                filename_real:_dirname,
                filename:_dirname,
                filetype:0,
                filesize:0,
                flag:2,
                p_id:_p_id
            },
            dataType:'json',
            success: function (data) {
                if(data.result){
                    if(_dir_id>0){
                        location.href='/dir?dir_id='+_dir_id;
                    }
                    if(_p_id>0){
                        location.href='/dir?p_id='+_p_id;
                    }
                }else{
                    $('#createDirModalContent2 .create-dir-error').html('<span style="color:red;">没有上传权限</span>');
                }
            }
        });
    }else{
        $('#createDirModalContent2 .create-dir-error').html('<span style="color:red;">文件夹名不能为空！</span>');
    }
});


var qiniuDomain = $('#qiniuDomain').val();
var pickfileId = $('#pickfileId').val();
var fileurlId = $('#fileurlId').val();
var uploader = Qiniu.uploader({
    runtimes: 'html5,flash,html4',    //上传模式,依次退化
    browse_button: pickfileId,       //上传选择的点选按钮，**必需**
    uptoken_url: '/dir/get-uptoken',
    //Ajax请求upToken的Url，**强烈建议设置**（服务端提供）
    // uptoken : '<Your upload token>',
    //若未指定uptoken_url,则必须指定 uptoken ,uptoken由其他程序生成
    unique_names: true,
    // 默认 false，key为文件名。若开启该选项，SDK会为每个文件自动生成key（文件名）
    // save_key: true,
    // 默认 false。若在服务端生成uptoken的上传策略中指定了 `sava_key`，则开启，SDK在前端将不对key进行任何处理
    domain: qiniuDomain,
    //bucket 域名，下载资源时用到，**必需**
    container: pickfileId+'_container',           //上传区域DOM ID，默认是browser_button的父元素，
    max_file_size: '2000mb',           //最大文件体积限制
    flash_swf_url: '/js/qiniu/Moxie.swf',  //引入flash,相对路径
    max_retries: 0,                   //上传失败最大重试次数
    dragdrop: true,                   //开启可拖曳上传
    drop_element: pickfileId+'_container',       //拖曳上传区域元素的ID，拖曳文件或文件夹后可触发上传
    chunk_size: '4mb',                //分块上传时，每片的体积
    auto_start: true,                 //选择文件后自动上传，若关闭需要自己绑定事件触发上传
    init: {
        'FilesAdded': function(up, files) {

            plupload.each(files, function(file) {
                // 文件添加进队列后,处理相关的事情
                _file = file;
                /*console.log('11111');
                console.log(up);
                console.log(file);*/
            });
            $('#upload-progress-1').show();
            $('#'+fileurlId+'_upload_txt').html('<span style="color:#894A38">上传中,请稍等...</span>');

        },
        'BeforeUpload': function(up, file) {
            // 每个文件上传前,处理相关的事情

        },
        'UploadProgress': function(up, file) {
            // 每个文件上传时,处理相关的事情
            //console.log('22222');
            //console.log(up);
            //console.log(file);
            $('#upload-progress-1 .progress-bar').css('width',file.percent+'%');
            $('#upload-progress-1 .progress-bar').html(file.percent+'% <span class="sr-only"></span>');
            //$('#upload-progress-1 .progress-bar .sr-only').html(file.percent+'%');
            $('#'+fileurlId+'_upload_txt').html('<span style="color:#894A38">上传中,请稍等...&nbsp;&nbsp;'+file.loaded+'/'+file.size+'</span>');
        },
        'FileUploaded': function(up, file, info) {
            var res = $.parseJSON(info);
            /*alert(res.key);
             alert(info);*/
            $('#'+fileurlId+'').val(res.key);
            //$('#'+fileurlId+'_preview').attr('src','').attr('src',qiniu_domain+res.key);
            $('#'+fileurlId+'_upload_txt').html('<span style="color:green;">上传成功</span>');
            // 每个文件上传成功后,处理相关的事情
            // 其中 info 是文件上传成功后，服务端返回的json，形式如
            // {
            //    "hash": "Fh8xVqod2MQ1mocfI4S4KpRL6D98",
            //    "key": "gogopher.jpg"
            //  }
            // 参考http://developer.qiniu.com/docs/v6/api/overview/up/response/simple-response.html
            // var domain = up.getOption('domain');
            // var res = parseJSON(info);
            // var sourceLink = domain + res.key; 获取上传成功后的文件的Url
            //$('#save-submit').click();

//console.log(res);
            _dir_id = $('#dir_id').val();
            _p_id = $('#p_id').val();
            $.ajax({
                url: '/dir/save',
                type: 'post',
                data: {
                    dir_id:_dir_id,
                    filename_real:res.key,
                    filename:_file.name,
                    filesize:_file.size,
                    flag:1,
                    p_id:_p_id
                },
                dataType:'json',
                success: function (data) {
                    if(data.result){
                        if(_dir_id>0){
                            location.href='/dir?dir_id='+_dir_id;
                        }
                        if(_p_id>0){
                            location.href='/dir?p_id='+_p_id;
                        }
                    }else{
                        $('#'+fileurlId+'_upload_txt').html('<span style="color:red;">没有上传权限</span>');
                    }
                }
            });


        },
        'Error': function(up, err, errTip) {
            //上传出错时,处理相关的事情
            $('#'+fileurlId+'_upload_txt').html('<span style="color:red">上传出错</span>');
            /*console.log(up);
             console.log(err);
             console.log(errTip);*/
        },
        'UploadComplete': function() {
            //队列文件处理完毕后,处理相关的事情
        },
        'Key': function(up, file) {
            // 若想在前端对每个文件的key进行个性化处理，可以配置该函数
            // 该配置必须要在 unique_names: false , save_key: false 时才生效
            //var key = "";
            // do something with key here
            //return key
        }
    }
});


var pickfileId2 = $('#pickfileId2').val();
var fileurlId2 = $('#fileurlId2').val();

var uploader2 = Qiniu.uploader({
    runtimes: 'html5,flash,html4',    //上传模式,依次退化
    browse_button: pickfileId2,       //上传选择的点选按钮，**必需**
    uptoken_url: '/dir/get-uptoken',
    //Ajax请求upToken的Url，**强烈建议设置**（服务端提供）
    // uptoken : '<Your upload token>',
    //若未指定uptoken_url,则必须指定 uptoken ,uptoken由其他程序生成
    unique_names: true,
    // 默认 false，key为文件名。若开启该选项，SDK会为每个文件自动生成key（文件名）
    // save_key: true,
    // 默认 false。若在服务端生成uptoken的上传策略中指定了 `sava_key`，则开启，SDK在前端将不对key进行任何处理
    domain: qiniuDomain,
    //bucket 域名，下载资源时用到，**必需**
    container: pickfileId2+'_container',           //上传区域DOM ID，默认是browser_button的父元素，
    max_file_size: '2000mb',           //最大文件体积限制
    flash_swf_url: '/js/qiniu/Moxie.swf',  //引入flash,相对路径
    max_retries: 0,                   //上传失败最大重试次数
    dragdrop: true,                   //开启可拖曳上传
    drop_element: pickfileId2+'_container',       //拖曳上传区域元素的ID，拖曳文件或文件夹后可触发上传
    chunk_size: '4mb',                //分块上传时，每片的体积
    auto_start: true,                 //选择文件后自动上传，若关闭需要自己绑定事件触发上传
    init: {
        'FilesAdded': function(up, files) {
            plupload.each(files, function(file) {
                // 文件添加进队列后,处理相关的事情
                _file = file;
            });
            $('#upload-progress-2').show();
            $('#'+fileurlId2+'_upload_txt').html('<span style="color:#894A38">上传中,请稍等...</span>');

        },
        'BeforeUpload': function(up, file) {
            // 每个文件上传前,处理相关的事情
        },
        'UploadProgress': function(up, file) {
            // 每个文件上传时,处理相关的事情
            $('#upload-progress-2 .progress-bar').css('width',file.percent+'%');
            $('#upload-progress-2 .progress-bar').html(file.percent+'% <span class="sr-only"></span>');
            $('#'+fileurlId2+'_upload_txt').html('<span style="color:#894A38">上传中,请稍等...&nbsp;&nbsp;'+file.loaded+'/'+file.size+'</span>');
        },
        'FileUploaded': function(up, file, info) {
            var res = $.parseJSON(info);
            /*alert(res.key);
             alert(info);*/
            $('#'+fileurlId2+'').val(res.key);
            //$('#'+fileurlId+'_preview').attr('src','').attr('src',qiniu_domain+res.key);
            $('#'+fileurlId2+'_upload_txt').html('<span style="color:green;">上传成功</span>');
            // 每个文件上传成功后,处理相关的事情
            // 其中 info 是文件上传成功后，服务端返回的json，形式如
            // {
            //    "hash": "Fh8xVqod2MQ1mocfI4S4KpRL6D98",
            //    "key": "gogopher.jpg"
            //  }
            // 参考http://developer.qiniu.com/docs/v6/api/overview/up/response/simple-response.html
            // var domain = up.getOption('domain');
            // var res = parseJSON(info);
            // var sourceLink = domain + res.key; 获取上传成功后的文件的Url
            //$('#save-submit').click();

//console.log(res);
            _dir_id = $('#dir_id').val();
            _p_id = $('#p_id').val();
            $.ajax({
                url: '/dir/save',
                type: 'post',
                data: {
                    dir_id:_dir_id,
                    filename_real:res.key,
                    filename:_file.name,
                    filesize:_file.size,
                    flag:2,
                    p_id:_p_id
                },
                dataType:'json',
                success: function (data) {
                    if(data.result){
                        if(_dir_id>0){
                            location.href='/dir?dir_id='+_dir_id;
                        }
                        if(_p_id>0){
                            location.href='/dir?p_id='+_p_id;
                        }
                    }else{
                        $('#'+fileurlId2+'_upload_txt').html('<span style="color:red;">没有上传权限</span>');
                    }
                }
            });


        },
        'Error': function(up, err, errTip) {
            //上传出错时,处理相关的事情
            $('#'+fileurlId2+'_upload_txt').html('<span style="color:red">上传出错</span>');
            /*console.log(up);
             console.log(err);
             console.log(errTip);*/
        },
        'UploadComplete': function() {
            //队列文件处理完毕后,处理相关的事情
        },
        'Key': function(up, file) {
            // 若想在前端对每个文件的key进行个性化处理，可以配置该函数
            // 该配置必须要在 unique_names: false , save_key: false 时才生效
            //var key = "";
            // do something with key here
            //return key
        }
    }
});