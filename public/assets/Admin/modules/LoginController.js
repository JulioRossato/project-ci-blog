
function regenerateToken(header, token, hash) {
    $("meta[name='" + header + "']").attr('content', hash);
    $("[name='" + token + "']").val(hash);
    csrf_header = header;
    csrf_token = token;
    csrf_hash = hash;
}

iziToast.settings({
    position: 'topRight',
});

$(document).on('submit', "[data-module='LoginController']", function (e) {
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

            location.reload();
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

            grecaptcha.reset(widgetId2);

            regenerateToken(csrf_header, csrf_token, csrf_hash);

            button_submit.attr('disabled', false).html(button_text);
        }
    });
});