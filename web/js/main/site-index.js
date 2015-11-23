$(function(){
    $('#site-index .item-one table td').click(function(){
        location.href = $(this).find('a').attr('href');
    });
    $('#site-index .item-one .panel-heading').click(function(){
        location.href = $(this).find('a').attr('href');
    });

});