// $(document).ready(function () {
//     $('#upload_avatar').click(function () {
//         var form_data = new FormData();
//         // Read selected files
//         var totalfiles = document.getElementById('files').files.length;
//         for (var index = 0; index < totalfiles; index++) {
//             form_data.append("files[]", document.getElementById('files').files[index]);
//         }
//         // AJAX request
//         $.ajax({
//             url: '?controller=admin&action=add_avatar',
//             type: 'post',
//             data: form_data,
//             dataType: 'json',
//             contentType: false,
//             processData: false,
//             success: function (response) {
//                 for (var index = 0; index < response.length; index++) {
//                     var src = response[index];
//                     // Add img element in <div id='preview'>
//                     $('#preview').append('<img src="' + src + '" width="100px;" height="100px">');
//                 }
//             }, error: function (request, error) {
//                 console.log(arguments);
//                 alert(" Can't do because: " + error);
//             },
//         });
//     });
// });


$(function () {
    var inputFile = $('#file');
    $('#upload_single_bt').click(function (event) {
        var fileToUpload = inputFile[0].files[0];
        var formData = new FormData();
        formData.append('file', fileToUpload);
        $.ajax({
            url: '?controller=admin&action=addAvatar',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                if (data.status == 'true') {
                    showThumbUpload(data);
                    $('#thumbnail_url').val(data.file_path);
                } else {
                    alert(data.error);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });
        return false;
    });

    function  showThumbUpload(data) {
        var items;
        items = '<img src="' + data.file_path + '"/>';
        $('#show_list_file').html(items);
    }

});


