export function initNotificationsModalHandler() {
    var modals = $(".app-modal-notification");

    modals.each(function() {
        var id = $(this).attr("id");
        var modal = $("#" + id);
        var container = $(this).find(".app-modal-notification-container");
        var url = container.data("url");

        modal.on("show.bs.modal", function(e) {
            var source = $(e.relatedTarget).data("source");
            var route = $(e.relatedTarget).data("route");
            var txtButton = $(e.relatedTarget).data("text-button");
            $.ajax({
                url: url,
                type: "GET",
                data:{"source": source}
            }).done(function(html) {
                container.html(html);
                container.append('<a href="'+route+'" class="btn btn-primary m-1">'+txtButton+'</a>')
            });
        });
    });
}
