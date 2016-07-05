/*$('.dir-item').mouseenter(function(){
    $(this).find('.info').addClass('hover');
}).mouseleave(function(){
    $(this).find('.info').removeClass('hover');
});*/

/*$('.dir-item .icon').mouseenter(function(){
    $(this).parent('.dir-item').addClass('hover');
}).mouseleave(function(){
    $(this).parent('.dir-item').removeClass('hover');
});

$('.dir-item .info').mouseenter(function(){
    $(this).parent('.dir-item').addClass('hover');
}).mouseleave(function(){
    $(this).parent('.dir-item').removeClass('hover');
});*/

$('.filetype').mouseenter(function(){
    $(this).find('.click_btns').show();
}).mouseleave(function(){
    $(this).find('.click_btns').hide();
});


$('.dir-item.file-item').mouseenter(function(){
    $(this).find('.icon').addClass('hover');
    $(this).find('.file-check').show();
}).mouseleave(function(){
    if($(this).hasClass('file-checked')==false){
        $(this).find('.icon').removeClass('hover');
        $(this).find('.file-check').hide();
    }
});

$('.file-check').click(function(){
    if($(this).prop('checked')==false){
        $('.file-item').removeClass('file-checked');
        $('.file-check').prop('checked',false);
        /*$(this).find('.icon').removeClass('hover');
        $(this).find('.file-check').hide();*/
    }else{
        $('.file-item').removeClass('file-checked');
        $('.file-check').prop('checked',false);
        $(this).prop('checked',true);
        $(this).parents('.file-item').addClass('file-checked');
    }

    //$('.file-check').attr('checked',false);
    //$('.file-item').removeClass('file-checked');

        //$(this).attr('checked',true);
});

$('.dir-item.dl_enable.is-dir').click(function(){
    location.href='/dir?p_id='+$(this).attr('data-id');
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

$(function(){
   $('.filethumb').each(function(){
       _filethumbId = $(this).attr('data-id');
       $.ajax({
           url: '/dir/download',
           type: 'get',
           async : false,
           data: {
               id:_filethumbId,
               preview:true,
               imgUrl:true
           },
           success: function (data) {
                $('.filethumb-'+_filethumbId).attr('src',data);
           }
       });
   })
});

$('#order_select').change(function(){
    location.href = $('#link_'+$(this).val()).val();
});

$('#list_type_select').change(function(){
    location.href = $('#link2_'+$(this).val()).val();
});





/*$('#createDirModalContent2 button.btn').click(function(){
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
});*/


