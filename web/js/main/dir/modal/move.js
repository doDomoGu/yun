$('#moveModalContent button.btn').click(function(){
    new_dir_id = $('#moveModalContent .move_dir_id_new').val();
    new_p_id = $('#moveModalContent .move_p_id_new').val();
    if(new_dir_id!='' || new_p_id !=''){
        _c = $('#list-main .file-checkbox:checked').length;
        //_c2 = $('#list-main .filetype .file-checkbox:checked').length;
        _c4 = $('#list-main .delete-enable .file-checkbox:checked').length;
        if(_c>0){
            if(_c!=_c4){
                $('#moveModalContent .move-error').html('<span style="color:red;">有文件不能移动！</span>');
            }else{
                if(confirm('确认要移动这些文件么')){
                    var file_ids = new Array();
                    $('#list-main .file-checkbox:checked').each(function(){
                        file_ids.push($(this).parents('.list-item').attr('data-id'));
                    });
                    /*console.log(file_ids);
                    return false;*/
                    $.ajax({
                        url: '/dir/move-file',
                        type: 'post',
                        data: {
                            new_dir_id:new_dir_id,
                            new_p_id:new_p_id,
                            file_ids:file_ids
                        },
                        dataType:'json',
                        success: function (data) {
                            if(data.result){
                                if(new_p_id>0){
                                    location.href='/dir?p_id='+new_p_id;
                                }else{
                                    location.href='/dir?dir_id='+new_dir_id;
                                }
                            }else{
                                $('#moveModalContent .move-error').html('<span style="color:red;">'+data.error+'</span>');
                            }
                        }
                    });
                }else{
                    return false;
                }
            }
        }else{
            $('#moveModalContent .move-error').html('<span style="color:red;">操作错误！</span>');
        }
    }else{
        $('#moveModalContent .move-error').html('<span style="color:red;">不能为空！</span>');
    }
});