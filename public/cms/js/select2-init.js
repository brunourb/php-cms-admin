/**
 * Created by mosaddek on 3/9/15.
 */

// Select2

var placeholder = "Selecione uma opção";
$('.select2, .select2-multiple').select2({
    placeholder: placeholder
});

$('.select2-allow-clear').select2({
    allowClear: true,
    placeholder: placeholder
});
$('button[data-select2-open]').click(function() {
    $('#' + $(this).data('select2-open')).select2('open');
});

