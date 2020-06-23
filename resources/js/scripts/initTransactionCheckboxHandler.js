function prepareBtnUrl(btn) {
    var checkboxesValues = [];
    var checkboxes = btn.closest('.app-checkbox-actions').find('.app-checkbox-actions-item');
    var baseUrl = btn.data('base-url');

    checkboxes.each(function() {
        var checkbox = $(this);
        if(checkbox.is(':checked')) {
            checkboxesValues.push(checkbox.val());
        }
    });

    return baseUrl + '/' + checkboxesValues.join('_');
}

function hasCheckedCheckboxes(btn) {
    var hasCheckedCheckbox = false;
    var checkboxes = btn.closest('.app-checkbox-actions').find('.app-checkbox-actions-item');  
    if(checkboxes.length) {
        checkboxes.each(function() {
            if($(this).prop('checked')) {
                hasCheckedCheckbox = true;
            }
        }); 
    }
    return hasCheckedCheckbox;
}

export function initTransactionCheckboxHandler() {
    $('.app-checkbox-actions-btn').each(function() {
        var btn = $(this);
        var confirmLabel = btn.data('confirm-label');

        btn.click(function(e) {
            e.preventDefault();
            if(confirm(confirmLabel) && hasCheckedCheckboxes(btn)) {
                var url = prepareBtnUrl($(this));
                window.location.href = url;
                return true;
            }
            return false;
        });
    });

    $('.app-checkbox-actions-header').each(function() {
        var checkbox = $(this);

        checkbox.change(function() {
            var checkedStatus = $(this).prop('checked');

            var childCheckboxes = $(this).closest('.app-checkbox-actions').find('.app-checkbox-actions-item');
            childCheckboxes.each(function() {
                var childCheckbox = $(this);
                childCheckbox.prop('checked', checkedStatus);
            });
        });
    });
}
