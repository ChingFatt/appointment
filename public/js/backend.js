jQuery(function () {
    One.helpers(['maxlength', 'select2', 'datepicker', 'fullcalendar','sparkline', 'table-tools-checkable']);
});
jQuery('.modal').on('hidden.bs.modal', function () {
    jQuery('.modal form')[0].reset();
    jQuery(this).find('.is-invalid').removeClass('is-invalid');
    jQuery(this).validate().resetForm();
});