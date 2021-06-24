export function orderingImages() {
    var orderingInputs = $(".app-ordering-input");

    orderingInputs.on('keyup', function(e) {
        if(e.keyCode == '13') {
            var data = '';

            orderingInputs.each(function() {
                var imageId = $(this).data('image-id');
                var value = parseInt($(this).val());

                data += imageId + '-' + value + '__';
            });

            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                type: "POST",
                url: '/system/properties/orderPropertyImages',
                dataType: "json",
                data: {ordering: data},
            }).done(function(res) {
                window.location.reload();
            });
        }
    })
}
