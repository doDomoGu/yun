$(function(){
    $('#searchBtn').click(function(){
        $('#s_position_id').val($('#test_pos_id').html());
        $('#searchForm').submit();
    })
});