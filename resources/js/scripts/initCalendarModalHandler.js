export function initCalendarModalHandler() {
    var modals = $(".app-modal-calendar");

    modals.each(function() {
        var id = $(this).attr("id");
        var modal = $("#" + id);
        var container = $(this).find(".app-modal-calendar-container");
        var url = container.data("url");

        modal.on("show.bs.modal", function(e) {
            var data = {
                'id': $(e.relatedTarget).data("source"),
                'year' : $(e.relatedTarget).data("year"),
            };
            $.ajax({
                url: url,
                type: "GET",
                data:{"source": data}
            }).done(function(data) {
                container.html(data.calendar);
                $('.modal-prev').attr("data-year", data.prev);
                $('.modal-current').html(data.current);
                $('.modal-next').attr("data-year", data.next);
                setTimeout(function(){
                    $('.modal-prev, .modal-next').on('click', function(e){
                        var dataNew = {
                            'id': e.currentTarget.attributes[1].value,
                            'year' : e.currentTarget.attributes[2].value,
                        };
                        $.ajax({
                            url: url,
                            type: "GET",
                            data:{"source": dataNew}
                        }).done(function(data) {
                            $('.modal-prev').attr("data-year", data.prev);
                            $('.modal-current').html(data.current);
                            $('.modal-next').attr("data-year", data.next);
                            container.html(data.calendar);
                        });
                    });
                }, 500);
            });
        });
    });

}
