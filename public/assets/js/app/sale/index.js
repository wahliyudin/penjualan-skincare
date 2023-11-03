"use strict";

var index = function () {
    var datatable;

    var initDatatable = () => {
        datatable = $('.table-index').DataTable({
            processing: true,
            responsive: true,
            dom: 'frtip',
            ajax: {
                url: "/sale/datatable",
                type: "POST"
            },
            columns: [
                {
                    name: "code",
                    data: "code",
                },
                {
                    name: "date",
                    data: "date",
                },
                {
                    name: "admin",
                    data: "admin",
                },
                {
                    name: "customer",
                    data: "customer",
                },
                {
                    name: "product",
                    data: "product",
                },
                {
                    name: "price",
                    data: "price",
                },
                {
                    name: "amount",
                    data: "amount",
                },
                {
                    name: "sub_total",
                    data: "sub_total",
                },
            ]
        });
    }

    return {
        init: function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            initDatatable();
        }
    }
}();

$(document).ready(function () {
    index.init();
});
