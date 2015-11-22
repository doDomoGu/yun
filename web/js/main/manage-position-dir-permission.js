var dir_id;
var dir_id2;
var position_id;
var _url;

$('#dir-select-1').change(function(){
    dir_id = $(this).val();
    position_id = $('#position_id').val();
    _url = 'position-dir-permission?position_id='+position_id;
    if(dir_id>0)
         _url = _url +'&dir_id='+dir_id;
    location.href = _url;
});

$('#dir-select-2').change(function(){
    dir_id2 = $(this).val();
    position_id = $('#position_id').val();
    _url = 'position-dir-permission?position_id='+position_id;
    if(dir_id2>0)
        _url = _url +'&dir_id='+dir_id2;
    else{
        dir_id = $('#dir-select-1').val();
        if(dir_id>0)
            _url = _url +'&dir_id='+dir_id;
    }
    location.href = _url;

});