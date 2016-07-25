$('#list-main').on('mouseenter','.grid-style',function(){
    $(this).find('.file-check').show();
}).on('mouseleave','.grid-style',function(){
    $(this).find('.file-check').hide();
});


var _checkboxClickFlag = false;
$('#list-main').on('click','.file-checkbox',function(){
    _checkboxClickFlag = true;
});


$('#list-main').on('click','.is-dir',function(){
    if(_checkboxClickFlag==false){
        location.href = '/dir?p_id='+$(this).attr('data-id');
    }else{
        _checkboxClickFlag = false;
    }


});
