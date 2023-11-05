"use strict";

var index = function () {
    var datatable;

    var initDatatable = () => {
        datatable = $('.table-index').DataTable({
            processing: true,
            responsive: true,
            dom: 'rtip',
            ajax: {
                url: "/transaction/datatable",
                type: "POST",
                data: function (d) {
                    d.code = $('input[name="code"]').val();
                },
                dataSrc: function (json) {
                    console.log(json);
                    var data = json.data;
                    var grandTotal = 0;
                    data.forEach(element => {
                        grandTotal += parseInt(element.sub_total.split('.').join(""));
                    });
                    $('.grand-total').text(toRupiah(grandTotal));
                    return data;
                }
            },
            columns: [
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
                    class: 'text-right'
                },
                {
                    name: "action",
                    data: "action",
                },
            ]
        });

        $('input[name="search"]').keyup(function (e) {
            e.preventDefault();
            datatable.search(e.target.value).draw();
        });
    }

    var toRupiah = (bilangan) => {
        var number_string = bilangan.toString(),
            sisa = number_string.length % 3,
            rupiah = number_string.substr(0, sisa),
            ribuan = number_string.substr(sisa).match(/\d{3}/g);

        if (ribuan) {
            var separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        return rupiah;
    }

    var handleForm = () => {
        $('.btn-save-transaction').on('click', function (e) {
            e.preventDefault();
            var postData = new FormData($(".form-transaction")[0]);
            $.ajax({
                type: "POST",
                url: `/transaction/store`,
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
                        $('select[name="customer_id"]').val('').trigger('change');
                        $('.btn-save').data('model', '');
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

    var cart = () => {
        $('select[name="product_id"]').change(function (e) {
            e.preventDefault();
            var product = $(this).val();
            var code = $('input[name="code"]').val();
            $.ajax({
                type: "GET",
                url: `/transaction/product/${code}/${product}`,
                dataType: "JSON",
                success: function (response) {
                    $('input[name="price"]').val(response.price);
                    $('input[name="stock"]').val(response.stock);
                    var price = $('input[name="price"]').val();
                    var quantity = $('input[name="quantity"]').val();
                    var result = quantity * parseInt(price.split('.').join(""));
                    $('input[name="sub_total"]').val(result).trigger('input');
                }
            });
        });

        $('input[name="quantity"]').change(function (e) {
            e.preventDefault();
            var val = $(this).val();
            var stock = $('input[name="stock"]').val();
            if (parseInt(val) > parseInt(stock)) {
                $('input[name="quantity"]').val(stock);
                val = stock;
                alert('Stok yang tersedia tidak cukup!');
            }
            var price = $('input[name="price"]').val();
            var result = val * parseInt(price.split('.').join(""));
            $('input[name="sub_total"]').val(result).trigger('input');
        });

        $('.btn-save').on('click', function (e) {
            e.preventDefault();
            var model = $(this).data('model');
            var postData = new FormData($(".form-model")[0]);
            postData.append('code', $('input[name="code"]').val());
            postData.append('id', model);
            $.ajax({
                type: "POST",
                url: `/transaction/cart/store`,
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
                        $('#cart-modal').modal('hide');
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

        $('.table-index').on('click', '.btn-edit', function (e) {
            e.preventDefault();
            var model = $(this).data('model');
            $.ajax({
                type: "GET",
                url: `/transaction/cart/${model}/edit`,
                dataType: "JSON",
                success: function (response) {
                    $('.btn-save').data('model', model);
                    $('select[name="product_id"]').val(response.product_id).trigger('change');
                    $('input[name="price"]').val(response.product_price).trigger('input');
                    $('input[name="quantity"]').val(response.quantity);
                    $('input[name="sub_total"]').val(response.quantity * response.product_price).trigger('input');
                    $('#cart-modal').modal('show');
                },
                error: function (param) { }
            });
        });

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
                    url: `/transaction/cart/${model}/destroy`,
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


    var clearData = () => {
        $('#cart-modal').on('hidden.bs.modal', function () {
            $('.btn-save').data('model', '');
            $('select[name="product_id"]').val('').trigger('change');
            $('input[name="price"]').val('').trigger('input');
            $('input[name="quantity"]').val('');
            $('input[name="sub_total"]').val('').trigger('input');
        });
    }

    var initPlugins = () => {
        $('.money').mask('0.000.000.000', {
            reverse: true
        });
    }

    return {
        init: function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            handleForm();
            initDatatable();
            cart();
            initPlugins();
            clearData();
        }
    }
}();

$(document).ready(function () {
    index.init();
});
