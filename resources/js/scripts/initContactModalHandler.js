export function initContactModalHandler() {
    var modals = $(".app-contact-modal");

    modals.each(function () {
        var id = $(this).attr("id");
        var modal = $("#" + id);
        var container = $(this).find(".app-contact-modal-container");
        var url = container.data("url");

        modal.on("show.bs.modal", function (e) {
            $.get(url, function (html) {
                container
                    .html(html)
                    .promise()
                    .done(function () {
                        modal.modal("handleUpdate");
                    });
            });
        });
    });
}
