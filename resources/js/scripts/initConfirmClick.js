export function initConfirmClick() {
    $('.app-confirm').each(function() {

        var link = $(this);

        var confirmLabel = link.data('label');

        link.click(function(e) {
            if(confirm(confirmLabel)) {
                return true;
            }

            e.preventDefault();
            return false;
        });
    });
}
