$('#_submit').on('click', function(){
    
    var data = new FormData();
    data.append('SelectedFile', $("#_file")[0].files[0]);
    data.append('taskNumber', $('#_task').val());
    data.append('sessionUsername', $('#hidden').data('username'));
    
    $.ajax({
        url: "uploader.php",
        data: data,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (resp) {
            $('#output').html(resp + resp.data);
            prettyPrint(); /* global prettyPrint */
        }
    });
});