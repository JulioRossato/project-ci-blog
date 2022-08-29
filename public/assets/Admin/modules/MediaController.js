var $table = $('#table');



window.operateEvents = {
    'click .copy': function (e, value, row, index) {

        navigator.clipboard.writeText(row.link);

        iziToast.success({
            message: 'Link do arquivo copiado para a área de transferência',
        });

    },
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
                        url: base_url + '/admin/media/delete',
                        data: dataJson,
                        dataType: 'json',
                        success: function (result) {
                            regenerateToken(result['csrf_header'], result['csrf_token'], result['csrf_hash']);
                            if (result['error'] == false) {
                                $('table').bootstrapTable('refresh');
                                Swal.fire('Success', 'Arquivo excluído!', 'success');
                                $table.bootstrapTable('remove', {
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

