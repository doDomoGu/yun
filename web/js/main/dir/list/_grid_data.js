var grid_file_thumb = function(){
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
                $('.filethumb-'+_filethumbId).attr('src',data+'?imageView2/1/w/128/h/128/interlace/0/q/70');
            }
        });
    });
}
