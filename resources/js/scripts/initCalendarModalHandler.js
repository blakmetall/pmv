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

            var propData = data;

            $.ajax({
                url: url,
                type: "GET",
                data:{"source": data}
            }).done(function(data) {
                container.html(data.calendar);
                $('.modal-name').html(data.name);
                $('.modal-prev').attr("data-year", data.prev);
                $('.modal-current').html(data.current);
                $('.modal-next').attr("data-year", data.next);
                setTimeout(function(){
                    $('.modal-prev, .modal-next').on('click', function(e){
                        var dataNew = {
                            'id': propData.id,
                            'year' : e.currentTarget.attributes[2].value,
                        };

                        // console.log(dataNew);

                        $.ajax({
                            url: url,
                            type: "GET",
                            data:{"source": dataNew}
                        }).done(function(data) {
                            $('.modal-prev').attr("data-source", propData.id);
                            $('.modal-prev').attr("data-year", data.prev);
                            $('.modal-current').html(data.current);
                            $('.modal-next').attr("data-source", propData.id);
                            $('.modal-next').attr("data-year", data.next);
                            container.html(data.calendar);
                        });
                    });
                }, 1500);
            });
        });
    });

}
