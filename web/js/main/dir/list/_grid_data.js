$('#list-main').on('mouseenter','.grid-style',function(){
    $(this).find('.file-check').show();
}).on('mouseleave','.grid-style',function(){
    $(this).find('.file-check').hide();
});

$('#list-main').on('click','.is-dir',function(){
    location.href = '/dir?p_id='+$(this).attr('data-id');
});
