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
            var txtCustomMsg = $(e.relatedTarget).data("text-custom-msg");
            $.ajax({
                url: url,
                type: "GET",
                data:{"source": source}
            }).done(function(html) {
                container.html(html);
                container.append(`<form action="${route}">
                <br>
                <label for="custom_msg" style="display:block;">${txtCustomMsg}</label>
                <textarea name="custom_msg" id="custom_msg" rows="5" style="width:100%"></textarea>
                <button type="submit" class="btn btn-primary m-1">${txtButton}</button>
                </form>`);
            });
        });
    });
}
