/*$('.recycleBtn').modal('show');*/
$('.recycleBtn').click(function(e){
    e.preventDefault();
    if(confirm('确认是否要还原这个文件?')){
        window.location = $(this).attr('href');
    }


});