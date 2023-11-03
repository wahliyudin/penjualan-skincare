"use strict";

var index = function () {
    var datatable;

    var initDatatable = () => {
        datatable = $('.table-index').DataTable({
            processing: true,
            responsive: true,
            dom: 'frtip',
            ajax: {
                url: "/customer/datatable",
                type: "POST"
            },
            columns: [
                {
                    name: "code",
                    data: "code",
                },
                {
                    name: "name",
                    data: "name",
                },
                {
                    name: "phone_number",
                    data: "phone_number",
                },
                {
                    name: "address",
                    data: "address",
                },
                {
                    name: "action",
                    data: "action",
                },
            ]
        });
    }

    var handleAdd = () => {
        $('.btn-add').click(function (e) {
            e.preventDefault();
            $.ajax({
                type: "GET",
                url: "/customer/next-code",
                dataType: "JSON",
                success: function (response) {
                    $('input[name="code"]').val(response);
                },
                error: function (param) { }
            });
        });
    }

    var handleDelete = () => {
        $('.table-index').on('click', '.btn-delete', function (e) {
            e.preventDefault();
            var model = $(this).data('model');
            swal({
                title: "Apa kamu yakin?",
                text: "Anda tidak akan dapat memulihkan data ini!",
                type: "warning",
                showCancelButton: true,
                cancelButtonText: "Batal",
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Ya, hapus saja!",
                closeOnConfirm: false
            }, function () {
                $.ajax({
                    type: "DELETE",
                    url: `/customer/${model}/destroy`,
                    dataType: "JSON",
                    success: function (response) {
                        swal({
                            title: response.title,
                            text: response.message,
                            type: "success"
                        }, function () {
                            datatable.ajax.reload();
                        });
                    },
                    error: function (param) { }
                });
            });
        });
    }

    var handleEdit = () => {
        $('.table-index').on('click', '.btn-edit', function (e) {
            e.preventDefault();
            var model = $(this).data('model');
            $.ajax({
                type: "GET",
                url: `/customer/${model}/edit`,
                dataType: "JSON",
                success: function (response) {
                    $('.btn-save').data('model', model);
                    $('input[name="code"]').val(response.code);
                    $('input[name="name"]').val(response.name);
                    $('input[name="phone_number"]').val(response.phone_number);
                    $('textarea[name="address"]').val(response.address);
                    $('#customer-modal').modal('show');
                },
                error: function (param) { }
            });
        });
    }

    var clearData = () => {
        $('#customer-modal').on('hidden.bs.modal', function () {
            $('input[name="code"]').val('');
            $('input[name="name"]').val('');
            $('input[name="phone_number"]').val('');
            $('textarea[name="address"]').val('');
        });
    }

    var handleUpdateOrCreate = () => {
        $('.btn-save').on('click', function (e) {
            e.preventDefault();
            var model = $(this).data('model');
            var postData = new FormData($(".form-model")[0]);
            $.ajax({
                type: "POST",
                url: model ? `/customer/${model}/update` : `/customer/store`,
                processData: false,
                contentType: false,
                data: postData,
                success: function (response) {
                    swal({
                        title: response.title,
                        text: response.message,
                        type: "success"
                    }, function () {
                        datatable.ajax.reload();
                        $('.btn-save').data('model', '');
                        $('#customer-modal').modal('hide');
                    });
                },
                error: function (jqXHR) {
                    if (jqXHR.status == 422) {
                        swal('Peringatan!', JSON.parse(jqXHR.responseText).message, "warning");
                    } else {
                        swal('Error!', jqXHR.message, "error");
                    }
                }
            });
        });
    }

    var handleInitButtons = () => {
        handleDelete();
        handleEdit();
        handleUpdateOrCreate();
        handleAdd();
        clearData();
    }

    return {
        init: function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            handleInitButtons();
            initDatatable();
        }
    }
}();

$(document).ready(function () {
    index.init();
});
