$(document).ready(function() {
    $('.select-parent-cat').change(function() {
        var parent_cat = $(this).find(":selected").val();
        var data = { parent_cat: parent_cat };
        console.log(data);
        $.ajax({
            url: '?mod=product&controller=product_cat&action=select_brand',
            method: 'POST',
            data: data,
            dataType: 'text',
            success: function(data) {
                $('.select-brand').html(data);
            },
            error: function(xhr, ajaxoptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            },
        });
    });
});