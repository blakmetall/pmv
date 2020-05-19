export function multiSelect(className) {
    var placeholder = $(className).data('placeholder');
    $(className).fastselect({
        placeholder: placeholder,
    });
}
