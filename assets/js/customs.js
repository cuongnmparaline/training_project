$(document).ready(function () {
    $('#upload_avatar').click(function () {
        var form_data = new FormData();

        // Read selected files
        var totalfiles = document.getElementById('files').files.length;
        for (var index = 0; index < totalfiles; index++) {
            form_data.append("files[]", document.getElementById('files').files[index]);
        }

        // AJAX request
        $.ajax({
            url: '?controller=admin&action=add_avatar',
            type: 'post',
            data: form_data,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function (response) {
                for (var index = 0; index < response.length; index++) {
                    var src = response[index];
                    // Add img element in <div id='preview'>
                    $('#preview').append('<img src="' + src + '" width="100px;" height="100px">');
                }
            }, error: function (request, status, error) {
                alert(request.responseText);
            }
        });
    });
});



$(document).ready(function (){
    $('.column-sort').onclick(function (){
        var column_name = $(this).attr("id");
        var order = $(this).data("order");
        // glyphicon glyphicon-arrow-down
        // glyphicon glyphicon-arrow-up
        var arrow = '';
        if(order == 'desc'){
            arrow = '&nbsp;<span class="glyphicon glyphicon-arrow-down"></span>';
        } else {
            arrow = '&nbsp;<span class="glyphicon glyphicon-arrow-up"></span>';
        }

        $.ajax({
            url: "?controller=admin&action=sort",
            method: "POST",
            data: {column_name: column_name, order: order},
            success:function (data){
                $('#admin-table').html(data);
                $('#'+column_name+'').append(arrow);
            }
        })
    });
});