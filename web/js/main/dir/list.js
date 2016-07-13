var loading_files_flag = true;
var loading_files = function(){
    _page = $('#var_page').val();
    _page_size = $('#var_page_size').val();
    _count = $('#var_count').val();
    $.ajax({
        url: '/dir/get-files',
        type: 'get',
        data: {
            dir_id:$('#var_dir_id').val(),
            p_id:$('#var_p_id').val(),
            order:$('#var_order').val(),
            page:_page,
            page_size:_page_size,
            list_type:$('#var_list_type').val()
        },
        success: function (data) {
            $('#list-main').append(data);
            loading_num = parseInt(_page) * parseInt(_page_size);
            if(loading_num>=_count){
                $('.loading_num').html('加载完毕');
                loading_files_flag = false;
            }else{
                $('.loading_num').html('已加载'+loading_num+'个');
                $('#var_page').val(parseInt(_page)+1);
            }


        }
    });
};

loading_files();

$(window).scroll( function() {
    /*console.log("滚动条到顶部的垂直高度: "+$(document).scrollTop());
    console.log("页面的文档高度 ："+$(document).height());
    console.log('浏览器的高度：'+$(window).height());*/

    if(loading_files_flag){
        scroll_loading();
    }

});

var totalheight = 0;     //定义一个总的高度变量
function scroll_loading()
{
    totalheight = parseFloat($(window).height()) + parseFloat($(window).scrollTop());     //浏览器的高度加上滚动条的高度

    if ($(document).height() <= totalheight)     //当文档的高度小于或者等于总的高度的时候，开始动态加载数据
    {
        //加载数据
        loading_files();
    }
}
$('.list-checkbox').mouseenter(function(){
    $('#file_head ul li.head_col_filename').addClass('list-oncheck');
}).mouseleave(function(){
    $('#file_head ul li.head_col_filename').removeClass('list-oncheck');
});

$('#file_head ul ').on('click','li.head_col_filename:not(".list-oncheck"), li.head_col_filesize, li.head_col_uploadtime',function(){
    location.href = $(this).attr('data-url');
});


$('#list-main').on('mouseenter','.dir-item.file-item2',function(){
    $(this).find('.click_btns').show();
}).on('mouseleave','.dir-item.file-item2',function(){
    $(this).find('.click_btns').hide();
});


/*$('.dir-item.file-item').mouseenter(function(){
    $(this).find('.icon').addClass('hover');
    $(this).find('.file-check').show();
}).mouseleave(function(){
    if($(this).hasClass('file-checked')==false){
        $(this).find('.icon').removeClass('hover');
        $(this).find('.file-check').hide();
    }
});*/

$('.file-check').click(function(){
    if($(this).prop('checked')==false){
        $('.file-item').removeClass('file-checked');
        $('.file-check').prop('checked',false);
    }else{
        $('.file-item').removeClass('file-checked');
        $('.file-check').prop('checked',false);
        $(this).prop('checked',true);
        $(this).parents('.file-item').addClass('file-checked');
    }
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

/*$('#order_select').change(function(){
    location.href = $('#link_'+$(this).val()).val();
});*/

/*$('#list_type_select').change(function(){
    location.href = $('#link2_'+$(this).val()).val();
});*/

$('.list-grid-switch a').click(function(){
    location.href = $(this).attr('data-url');
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


