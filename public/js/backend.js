jQuery(function () {
    One.helpers(['maxlength', 'select2', 'datepicker', 'fullcalendar','sparkline', 'table-tools-checkable']);
});
jQuery('.modal').on('hidden.bs.modal', function () {
    jQuery('.modal form')[0].reset();
    jQuery(this).find('.is-invalid').removeClass('is-invalid');
    jQuery(this).validate().resetForm();
});
jQuery('.js-datatable').DataTable({
    order: [],
    pageLength: 10,
    lengthMenu: [[5, 10, 15, 20], [5, 10, 15, 20]],
    autoWidth: false,
    language: {
        lengthMenu: "_MENU_",
        search: "_INPUT_",
        searchPlaceholder: "Search..",
        info: "Page <strong>_PAGE_</strong> of <strong>_PAGES_</strong>",
        paginate: {
            first: '<i class="fa fa-angle-double-left"></i>',
            previous: '<i class="fa fa-angle-left"></i>',
            next: '<i class="fa fa-angle-right"></i>',
            last: '<i class="fa fa-angle-double-right"></i>'
        }
    }
});
jQuery('.js-datatable-ajax').DataTable({
    order: [],
    pageLength: 10,
    lengthMenu: [[5, 10, 15, 20], [5, 10, 15, 20]],
    autoWidth: false,
    processing: true,
    serverSide: true,
    columns: [
        { "data": "id" },
        { "data": "name" },
        { "data": "merchant_code" },
        { "data": "industry_id" },
        { "data": "is_publish" },
        { "data": "action" }
    ],
    language: {
        lengthMenu: "_MENU_",
        search: "_INPUT_",
        searchPlaceholder: "Search..",
        info: "Page <strong>_PAGE_</strong> of <strong>_PAGES_</strong>",
        paginate: {
            first: '<i class="fa fa-angle-double-left"></i>',
            previous: '<i class="fa fa-angle-left"></i>',
            next: '<i class="fa fa-angle-right"></i>',
            last: '<i class="fa fa-angle-double-right"></i>'
        }
    }
});
jQuery('.js-datatable-button').DataTable({
    order: [],
    pageLength: 10,
    lengthMenu: [[5, 10, 15, 20], [5, 10, 15, 20]],
    autoWidth: false,
    language: {
        lengthMenu: "_MENU_",
        search: "_INPUT_",
        searchPlaceholder: "Search..",
        info: "Page <strong>_PAGE_</strong> of <strong>_PAGES_</strong>",
        paginate: {
            first: '<i class="fa fa-angle-double-left"></i>',
            previous: '<i class="fa fa-angle-left"></i>',
            next: '<i class="fa fa-angle-right"></i>',
            last: '<i class="fa fa-angle-double-right"></i>'
        }
    },
    buttons: [
        { extend: 'copy', className: 'btn btn-sm btn-alt-primary' },
        { extend: 'csv', className: 'btn btn-sm btn-alt-primary' },
        { extend: 'print', className: 'btn btn-sm btn-alt-primary' }
    ],
    dom: "<'row'<'col-sm-12'<'text-center bg-body-light py-2 mb-2'B>>>" +
        "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>"
});