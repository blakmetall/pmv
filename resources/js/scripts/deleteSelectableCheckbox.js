export function initDeleteSelectableCheckbox() {
    $('.delete-selectable-checkbox').each(function() {
        var checkbox = $(this);
        var checkboxItems = $(this).closest('table').find('.delete-selectable-option');
        var deleteAction = $(this).closest('table').find('.delete-selectable-action');

        // change event on checkbox table
        checkbox.on('change', function(e) {
            if($(this).is(':checked')) {
                checkboxItems.each(function(){
                    $(this).prop('checked', true);
                });
            }else {
                checkboxItems.each(function(){
                    $(this).prop('checked', false);
                });
            }
        });

        // delete trigger action
        deleteAction.on('click', function(e){
            e.preventDefault();
            
            var url = deleteAction.data('tpl-route') + '/';
            
            checkboxItems.each(function() {
                if($(this).is(':checked')) {
                    url = url + '_' + $(this).val();
                }
            });

            document.location = url;
        });
    });
}
