$(document).ready(function(){
    $.ajax({
        url: "../php//fileworker.php",
        type: "POST",
        data: "wswd=GETLIST",
        success: function(resp){
            $('#preshka').html(resp.list);
            reset();
        } 
    });
});

var reset = function(){
    $("#_create").on('click', createFile);
    $('._delete').on('click', deleteFile);
}

var deleteFile = function(){
        $.ajax({
            url: "../php//fileworker.php",
            type: "POST",
            data: "filename=" + $(this).data('filename') + "&wswd=DELETE",
            success: function(resp){
                $('#preshka').html(resp.list); reset();
            }
        });
}

var createFile = function(){
        $.ajax({
            url: "../php//fileworker.php",
            type: "POST",
            data: "filename=" + $('#_textfield').val() + "&wswd=CREATE",
            success: function(resp){
                $('#preshka').html(resp.list); reset();
            }
    });
}