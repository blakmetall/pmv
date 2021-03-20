export function initDeleteImageModalHandler() {
    var modals = $(".app-modal-delete-image");

    modals.each(function() {
        var id = $(this).attr("id");
        var modal = $("#" + id);
        var container = $(this).find(".app-modal-delete-image-container");
        var url = container.data("url");

        modal.on("show.bs.modal", function(e) {
            var source = $(e.relatedTarget).data("source");
            var route = $(e.relatedTarget).data("route");
            var txtButton = $(e.relatedTarget).data("text-button");
            var cancelButton = $(e.relatedTarget).data("cancel-button");
            $.ajax({
                url: url,
                type: "GET",
                data:{"source": source}
            }).done(function(html) {
                container.html(html);
                container.append(`<form action="${route}">
                <br>
                <button type="button" class="btn btn-primary m-1" data-dismiss="modal">${cancelButton}</button>
                <button type="submit" class="btn btn-danger m-1">${txtButton}</button>
                </form>`);
            });
        });
    });
}
