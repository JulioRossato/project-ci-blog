var current_selected_image;

function regenerateToken(header, token, hash) {
    $("meta[name='" + header + "']").attr('content', hash);
    $("[name='" + token + "']").val(hash);
    csrf_header = header;
    csrf_token = token;
    csrf_hash = hash;
}

function mediaParams(p) {
    return {
        'type': $('#media_type').val(),
        limit: p.limit,
        sort: p.sort,
        order: p.order,
        offset: p.offset,
        search: p.search
    };
}


iziToast.settings({
    position: 'topRight',
});

if ($('.select2').length) {
    $('.select2').select2({
        theme: "bootstrap-5",
        placeholder: $(this).data('placeholder'),
    });
}

if (document.getElementById('dropzone')) {

    Dropzone.autoDiscover = false;
    var myDropzone = new Dropzone("#dropzone", {
        url: base_url + 'admin/media/save',
        paramName: "documents",
        autoProcessQueue: false,
        parallelUploads: 12,
        maxFiles: 12,
        maxFilesize: 500,
        autoDiscover: false,
        addRemoveLinks: true,
        timeout: 180000,
        dictRemoveFile: '<b class="text-danger text-decoration-none">x Remover</b>',
        dictMaxFilesExceeded: 'Apenas 12 arquivos podem ser carregados por vez ',
        dictResponseError: 'Error',
        dictCancelUpload: 'Cancelar Upload',
        uploadMultiple: true,
        dictDefaultMessage: '<p><button type="submit" class="btn btn-secondary mb-1"><i class="fa-solid fa-folder"></i> Selecionar Arquivos</button> <br> ou <br> arraste e solte arquivos de mídia aqui</p>',
    });
    myDropzone.on("addedfile", function (file) {
        var i = 0;
        if (this.files.length) {
            var _i, _len;
            for (_i = 0, _len = this.files.length; _i < _len - 1; _i++) {
                if (this.files[_i].name === file.name && this.files[_i].size === file.size && this.files[_i].lastModifiedDate.toString() === file.lastModifiedDate.toString()) {
                    this.removeFile(file);
                    i++;
                }
            }
        }
    });
    myDropzone.on('sending', function (file, xhr, formData) {
        formData.append(csrf_token, csrf_hash);
        xhr.onreadystatechange = function () {

            var response = JSON.parse(this.response || "[]");


            if (this.readyState == 4 && this.status == 200) {

                regenerateToken(response.csrf_header, response.csrf_token, response.csrf_hash);
                if (response['error'] == false) {
                    Dropzone.forElement('#dropzone').removeAllFiles(true);
                    $('#table').bootstrapTable('refresh');
                    $('#media-upload-table').bootstrapTable('refresh');
                    iziToast.success({
                        message: response['message'],
                    });
                } else {
                    iziToast.error({
                        message: response['message'],
                    });
                }

            }

            $(file.previewElement).find('.dz-error-message').text(response['message']);
        };
    });

    $('#upload-files-btn').on('click', function (e) {
        e.preventDefault();
        myDropzone.processQueue();
    });
}

var mediaModal = document.getElementById('media-upload-modal');

mediaModal.addEventListener('show.bs.modal', function (event) {

    var triggerElement = $(event.relatedTarget);
    current_selected_image = triggerElement;
    var input = $(current_selected_image).data('input');
    var isremovable = $(current_selected_image).data('isremovable');
    var ismultipleAllowed = $(current_selected_image).data('is-multiple-uploads-allowed');
    var media_type = ($(current_selected_image).is('[data-media_type]')) ? $(current_selected_image).data('media_type') : 'image';
    $('#media_type').val(media_type);

    if (ismultipleAllowed == 1) {
        $('#media-upload-table').bootstrapTable('refreshOptions', {
            singleSelect: false,
        });
    } else {
        $('#media-upload-table').bootstrapTable('refreshOptions', {
            singleSelect: true,
        });
    }

    $(this).find('input[name="current_input"]').val(input);
    $(this).find('input[name="remove_state"]').val(isremovable);
    $(this).find('input[name="multiple_images_allowed_state"]').val(ismultipleAllowed);
});




$('#upload-media').on('click', function () {
    var $result = $('#media-upload-table').bootstrapTable('getSelections');

    var path = base_url + $result[0].subDirectory + $result[0].name;
    var subDirectory = $result[0].subDirectory + $result[0].name;
    var media_type = $('#media-upload-modal').find('input[name="media_type"]').val();
    var input = $('#media-upload-modal').find('input[name="current_input"]').val();
    var is_removable = $('#media-upload-modal').find('input[name="remove_state"]').val();
    var ismultipleAllowed = $('#media-upload-modal').find('input[name="multiple_images_allowed_state"]').val();
    var removable_btn = (is_removable == '1') ? '<button type="button" class="remove-image btn btn-sm btn-danger rounded-0 mt-3">Remover</button>' : '';

    $(current_selected_image).closest('.form-group').find('.image').removeClass('d-none');

    if (ismultipleAllowed == '1') {
        for (let index = 0; index < $result.length; index++) {
            $(current_selected_image).closest('.form-group').find('.image-upload-section').append('<div class="col-md-3 p-2 text-center shadow bg-white image"><div class="image-upload-div"><img class="img-fluid" alt="' + $result[index].name + '" title="' + $result[index].name + '" src=' + base_url + $result[index].subDirectory + $result[index].name + ' ><input type="hidden" name=' + input + ' value=' + $result[index].subDirectory + $result[index].name + '></div>' + removable_btn + '</div>');
        }
    } else {
        path = (media_type != 'image') ? base_url + '/assets/Admin/img/' + media_type + '-file.png' : path;
        $(current_selected_image).closest('.form-group').find('.image-upload-section').html('<div class="col-md-3 p-2 text-center shadow bg-white image"><div class="image-upload-div"><img class="img-fluid" alt="' + $result[0].name + '" title="' + $result[0].name + '" src=' + path + ' ><input type="hidden" name=' + input + ' value=' + subDirectory + '></div>' + removable_btn + '</div>');
    }

    current_selected_image = '';
    $('#media-upload-modal').modal('hide');
});

$(document).on('click', '.remove-image', function (e) {
    e.preventDefault();
    $(this).closest('.image').remove();
});

if ($(".tags").length) {
// The DOM element you wish to replace with Tagify
    var input = document.querySelector('.tags');
// initialize Tagify on the above input node reference
    new Tagify(input)
}