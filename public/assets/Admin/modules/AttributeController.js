$(document).on('submit', "[data-module='AttributeController']", function (e) {
    e.preventDefault();

    var form = $(this);
    var form_action = form.attr('action');
    var form_method = form.attr('method');
    var form_data = form.serialize();

    var button_submit = $(this).closest('form').find(':submit');
    var button_text = button_submit.html();

    $.ajax({
        url: form_action,
        type: form_method,
        data: form_data,
        dataType: 'json',
        beforeSend: function (xhr) {
            button_submit.attr('disabled', true).html('<i class="fas fa-cog fa-spin"></i> Aguarde...');
        },
        success: function (data, textStatus, jqXHR) {

            iziToast.success({
                message: data.message,
            });

            if (!$('[name="id"]').val()) {
                $(".select2").val(null).trigger("change");
                $(form).trigger("reset");
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            var title = (jqXHR.responseJSON.title) ? jqXHR.responseJSON.title : textStatus;
            var message = (jqXHR.responseJSON.message) ? jqXHR.responseJSON.message : errorThrown;
            var typeAlert = (jqXHR.responseJSON.type) ? jqXHR.responseJSON.type : 'DANGER';

            if (typeAlert == 'DANGER') {
                iziToast.error({
                    message: message,
                });
            } else {
                iziToast.warning({
                    message: message,
                });
            }

        },
        complete: function (jqXHR, textStatus) {
            var csrf_header = jqXHR.responseJSON.csrf_header;
            var csrf_token = jqXHR.responseJSON.csrf_token;
            var csrf_hash = jqXHR.responseJSON.csrf_hash;

            regenerateToken(csrf_header, csrf_token, csrf_hash);

            button_submit.attr('disabled', false).html(button_text);
        }
    });
});


window.operateEvents = {
    'click .remove': function (e, value, row, index) {
        var dataJson = {
            [csrf_token]: csrf_hash,
            id: [row.id]
        };

        Swal.fire({
            title: 'Tem certeza?',
            text: "Você não será capaz de reverter isso!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, exclua!',
            showLoaderOnConfirm: true,
            preConfirm: function () {
                return new Promise((resolve, reject) => {
                    $.ajax({
                        type: 'POST',
                        url: '/admin/attribute/delete',
                        data: dataJson,
                        dataType: 'json',
                        success: function (result) {

                            if (result['error'] == false) {
                                $('table').bootstrapTable('refresh');
                                Swal.fire('Success', 'Registro excluído!', 'success');
                                $('table').bootstrapTable('remove', {
                                    field: 'id',
                                    values: [row.id]
                                })
                            } else {
                                Swal.fire('Oops...', result['message'], 'error');
                            }
                        }
                        ,
                        complete: function (jqXHR, textStatus) {

                            var csrf_header = jqXHR.responseJSON.csrf_header;
                            var csrf_token = jqXHR.responseJSON.csrf_token;
                            var csrf_hash = jqXHR.responseJSON.csrf_hash;

                            regenerateToken(csrf_header, csrf_token, csrf_hash);

                        }
                    }
                    );
                }
                );
            },
            allowOutsideClick: false
        }).then((result) => {
            if (result.dismiss === Swal.DismissReason.cancel) {
                Swal.fire('Cancelado!', 'Seus dados estão seguros.', 'error');
            }
        });

    }
}
