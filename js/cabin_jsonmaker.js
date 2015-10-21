var task = {
    "0" : {
        "conditions" : {"ru" : "", "en" : "", "ua" : ""},
        "title" : "",
        "points" : "",
        "input" : "",
        "output" : "",
        "examples" : {
        "input" : "",
        "output" : "" 
        }
    },
    "1" : {
        "conditions" : {"ru" : "", "en" : "", "ua" : ""},
        "title" : "",
        "points" : "",
        "input" : "",
        "output" : "",
        "examples" : {
        "input" : "",
        "output" : "" 
        }
    },
    "2" : {
        "conditions" : {"ru" : "", "en" : "", "ua" : ""},
        "title" : "",
        "points" : "",
        "input" : "",
        "output" : "",
        "examples" : {
        "input" : "",
        "output" : "" 
        }
    },
    "3" : {
        "conditions" : {"ru" : "", "en" : "", "ua" : ""},
        "title" : "",
        "points" : "",
        "input" : "",
        "output" : "",
        "examples" : {
        "input" : "",
        "output" : "" 
        }
    },
    "4" : {
        "conditions" : {"ru" : "", "en" : "", "ua" : ""},
        "title" : "",
        "points" : "",
        "input" : "",
        "output" : "",
        "examples" : {
        "input" : "",
        "output" : "" 
        }
    },
};

console.log(task);

var sender = function(){
    
    for(var i = 0; i < 5; i++){
        task[i]['conditions']['ua'] = $('#zd' + i + '>.condition[data-lang=ua]').val();
        task[i]['conditions']['ru'] = $('#zd' + i + '>.condition[data-lang=ru]').val();
        task[i]['conditions']['en'] = $('#zd' + i + '>.condition[data-lang=en]').val();
        task[i]['input'] = $('#zd' + i + '>.input').val();
        task[i]['examples']['input'] = $('#zd' + i + '>.input').val();
        task[i]['output'] = $('#zd' + i + '>.output').val();
        task[i]['examples']['output'] = $('#zd' + i + '>.output').val();
    }
    
    var data = new FormData();
    data.append('jsonstring', JSON.stringify(task));
    data.append('filename', $('#current').data('name'));
    data.append('wswd', 'EDIT');
    
    $.ajax({
        url: "../php//fileworker.php",
        data: data,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (resp) {
            alert(resp);
            $('#save').on('click', sender);
        }
    });
};

$(document).ready(function(){
    $('#save').on('click', sender);
});