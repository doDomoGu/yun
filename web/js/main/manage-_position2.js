var p_id;
//var p_id2;
$(function(){
    $.ajax({
        url: '/manage/position-select-ajax',
        type: 'get',
        data: {

        },
        //dataType:'json',
        success: function (data) {
            $('#pos-select-div').html(data);
        }
    });


    $('#pos-select-div').on('change','.pos-select-group',function(){
        p_id = $(this).val();
        $('#pos_id_div').html(p_id);
        $(this).nextAll().remove();
        if(p_id>0){
            $.ajax({
                url: '/manage/position-select-ajax',
                type: 'get',
                data: {
                    p_id:p_id
                },
                //dataType:'json',
                success: function (data) {
                    if(data!=''){
                        $('#pos-select-div').append(data);
                    }
                }
            });
        }
    });
});

