var p_id;
//var p_id2;


$('#pos-select').change(function(){
    p_id = $(this).val();

    alert(p_id);
});

/*
$('#pos-select-2').change(function(){
    p_id2 = $(this).val();
    if(p_id2>0)
        location.href = 'position?p_id='+p_id2;
    else{
        p_id = $('#pos-select-1').val();
        if(p_id>0)
            location.href = 'position?p_id='+p_id;
        else
            location.href = 'position';
    }

});*/
