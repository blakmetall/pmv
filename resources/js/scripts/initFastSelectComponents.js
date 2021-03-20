export function initFastSelectComponents(className) {
    $(".app-fast-select").each(function() {
        var elem = $(this);
        var placeholder = elem.data('placeholder');
        elem.fastselect({
            placeholder: placeholder,
        });
    });
}
