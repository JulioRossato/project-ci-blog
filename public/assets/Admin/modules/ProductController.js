var counter = 0;
var attributes_values = [];
var attributes_values_selected = [];
var variant_values_selected = [];
var pre_selected_attr_values = [];
var pre_selected_attributes_name = [];
var variant_counter = 0;

const generalTabEl = document.querySelector('#general-tab');
const generalTab = new bootstrap.Tab(generalTabEl);

const productAttributesTabEl = document.querySelector('#product-attributes-tab');
const productAttributesTab = new bootstrap.Tab(productAttributesTabEl);

const productVariantsTabEl = document.querySelector('#product-variants-tab');
const productVariantsTab = new bootstrap.Tab(productVariantsTabEl);


$(function () {
    $('#view-tree').jstree({
        'core': {
            multiple: false,
            select_limit: 1,
            'data': {
                'url': '/admin/product-category/data-tree',
                'data': function (node) {
                    return {'parentId': node.id};
                }
            }
        },
        "plugins": ["checkbox"],
        "checkbox": {
            multiple: false,
            select_limit: 1,
            three_state: false,
            cascade: 'none'
        }

    });

});

$(document).on('change', "[name='videoType']", function (e) {
    e.preventDefault();
    if ($(this).val() == '') {
        $('.videoLink').addClass('d-none');
        $("[name='video']").val('');
    } else {
        $('.videoLink').removeClass('d-none');
    }
});

$(document).on('change', "[name='isCancelable']", function (e) {
    e.preventDefault();
    if (!$(this).is(':checked')) {
        $('.cancelableTill').addClass('d-none');
        $("[name='cancelableTill']").val('');
    } else {
        $('.cancelableTill').removeClass('d-none');
    }
});

function containsAll(needles, haystack) {
    for (var i = 0; i < needles.length; i++) {
        if ($.inArray(needles[i], haystack) == -1)
            return false;
    }
    return true;
}

function add_product_variant_html(type) {

    if (type == 'packet') {
        var html = "<div class='row offset-md-1 border-bottom ml-5 mr-5 mb-3'><div class='col-md-12 mt-2 remove_pro_btn'><div class='card-tools float-right'> <label>Remove</label> <button type='button' class='btn btn-tool' id='remove_product_btn'> <i class='text-danger far fa-times-circle fa-2x '></i> </button></div></div><div class='form-group col-md-4'> <label for='inputPassword' class='col-sm-4 col-form-label'>Measurement</label><div class='col-sm-10'> <span><input type='number' name='packet_measurement[]' ></span></div></div><div class='form-group col-md-4'> <label for='inputPassword' class='col-sm-6 col-form-label'>Unit</label><div class='col-sm-6'> <select class='form-control valid' name='packet_measurement_unit_id[]' aria-invalid='false'><option value='1'>kg</option><option value='2'>gm</option><option value='3'>ltr</option><option value='4'>ml</option><option value='5'>pack</option> </select></div></div><div class='form-group col-md-4'> <label for='inputPassword' class='col-sm-4 col-form-label'>Price</label><div class='col-sm-10'> <span><input type='number' class='price' name='packet_price[]'></span></div></div><div class='form-group col-md-4'> <label for='inputPassword' class='col-sm-4 col-form-label'>Discounted Price</label><div class='col-sm-10'> <span><input type='number' class='discount' name='packet_discnt[]'></span></div></div><div class='form-group col-md-4'> <label for='inputPassword' class='col-sm-4 col-form-label'>Stock</label><div class='col-sm-10'> <input type='number' name='packet_stock[]'></div></div><div class='form-group col-md-4'> <label for='inputPassword' class='col-sm-4 col-form-label'>Unit</label><div class='col-sm-6'> <select class='form-control valid' name='packet_stock_unit_id[]' aria-invalid='false'><option value='1'>kg</option><option value='2'>gm</option><option value='3'>ltr</option><option value='4'>ml</option><option value='5'>pack</option> </select></div></div><div class='form-group col-md-4'> <label for='inputPassword' class='col-sm-4 col-form-label'>Status</label><div class='col-sm-6'> <select name='packet_serve_for[]' class='form-control' required='' aria-invalid='false'><option value='Available'>Available</option><option value='Sold Out'>Sold Out</option> </select></div></div></div>";
        return html;
    } else {
        var html = '<div class="row offset-md-1 border-bottom ml-5 mr-5 mb-3"><div class="col-md-12 mt-2 remove_pro_btn"><div class="card-tools float-right"> <label>Remove</label> <button type="button" class="btn btn-tool" id="remove_product_btn"> <i class="text-danger far fa-times-circle fa-2x "></i> </button></div></div><div class="form-group col-md-3 col-12"> <label for="inputPassword" class="col-sm-12 col-form-label">Measurement</label><div class="col-12"> <span><input type="number" name="loose_measurement[]" class="col-12" ></span></div></div><div class="form-group col-md-3"> <label for="inputPassword" class="col-sm-6 col-form-label">Unit</label><div class="col-sm-12"> <select class="form-control valid" name="loose_measurement_unit_id[] col-12" aria-invalid="false"><option value="1">kg</option><option value="2">gm</option><option value="3">ltr</option><option value="4">ml</option><option value="5">pack</option> </select></div></div><div class="form-group col-md-3"> <label for="inputPassword" class="col-sm-4 col-form-label">Price</label><div class="col-sm-10"> <span><input type="number" name="loose_price[]" class="col-12 price"></span></div></div><div class="form-group col-md-3"> <label for="inputPassword" class="col-sm-12 col-form-label">Discounted Price</label><div class="col-sm-10"> <span><input type="number" name="loose_discnt[]" class="col-12 discount"></span></div></div></div>';
        return html;
    }

}

function save_attributes() {

    attributes_values = [];
    all_attributes_values = [];
    var tmp = $('.product-attr-selectbox');
    $.each(tmp, function (index) {
        var data = $(tmp[index]).closest('.row').find('.multiple_values').select2('data');
        var tmp_values = [];
        for (var i = 0; i < data.length; i++) {
            if (!$.isEmptyObject(data[i])) {
                tmp_values[i] = data[i].id;
            }
        }
        if (!$.isEmptyObject(data)) {
            all_attributes_values.push(tmp_values);
        }
        if ($(tmp[index]).find('.is_attribute_checked').is(':checked')) {
            if (!$.isEmptyObject(data)) {
                attributes_values.push(tmp_values);
            }
        }
    });


}

function create_variants(preproccessed_permutation_result = false) {

    var html = "";
    var is_appendable = false;
    var permutated_attribute_value = [];
    // console.log(preproccessed_permutation_result);
    if (preproccessed_permutation_result != false) {
        var response = preproccessed_permutation_result;
        is_appendable = true;
    } else {
        var response = getPermutation(attributes_values);
    }
    var selected_variant_ids = JSON.stringify(response);
    var selected_attributes_values = JSON.stringify(attributes_values);

    $('.no-variants-added').hide();
    $.ajax({
        type: 'GET',
        url: '/admin/product/get_variants_by_id',
        data: {
            variant_ids: selected_variant_ids,
            attributes_values: selected_attributes_values,
        },
        dataType: 'json',
        success: function (data) {
            var result = data['result'];

            $.each(result, function (a, b) {
                variant_counter++;
                var attr_name = 'pro_attr_' + variant_counter;
                html += '<div class="form-group move row my-auto p-2 border rounded bg-gray-light product-variant-selectbox"><div class="col-1 text-center my-auto"><i class="fas fa-sort"></i></div>';
                var tmp_variant_value_id = " ";
                $.each(b, function (key, value) {
                    tmp_variant_value_id = tmp_variant_value_id + " " + value.id;
                    html += '<div class="col-2"> <input type="text" class="col form-control" value="' + value.value + '" readonly></div>';
                });
                html += '<input type="hidden" name="variants_ids[]" value="' + tmp_variant_value_id + '"><div class="col my-auto row justify-content-center"> <a data-bs-toggle="collapse" class="btn btn-tool text-primary" data-bs-target="#' + attr_name + '" aria-expanded="true"><i class="fas fa-angle-down fa-2x"></i> </a> <button type="button" class="btn btn-tool remove_variants"> <i class="text-danger far fa-times-circle fa-2x "></i> </button></div><div class="col-12" id="variant_stock_management_html"><div id=' + attr_name + ' style="" class="collapse">';
                if ($('.variant_stock_status').is(':checked') && $('.variant-stock-level-type').val() == 'variable_level') {
                    html += '<div class="form-group row"><div class="col col-xs-12"><label class="control-label">Price :</label><input type="number" name="variant_price[]" class="col form-control price varaint-must-fill-field" min="0" step="0.01"></div><div class="col col-xs-12"><label class="control-label">Special Price :</label><input type="number" name="variant_special_price[]" class="col form-control discounted_price" min="0" step="0.01"></div><div class="col col-xs-12"> <label class="control-label">Sku :</label> <input type="text" name="variant_sku[]" class="col form-control varaint-must-fill-field"></div><div class="col col-xs-12"> <label class="control-label">Total Stock :</label> <input type="text" name="variant_total_stock[]" class="col form-control varaint-must-fill-field"></div><div class="col col-xs-12"> <label class="control-label">Stock Status :</label> <select type="text" name="variant_level_stock_status[]" class="col form-control varaint-must-fill-field"><option value="1">In Stock</option><option value="0">Out Of Stock</option> </select></div></div>';
                } else {
                    html += '<div class="form-group row"><div class="col col-xs-12"><label class="control-label">Price :</label><input type="number" name="variant_price[]" class="col form-control price varaint-must-fill-field" min="0" step="0.01"></div><div class="col col-xs-12"><label class="control-label">Special Price :</label><input type="number" name="variant_special_price[]" class="col form-control discounted_price" min="0" step="0.01"></div>';
                }
                html += '<div class="col-12 pt-3"><label class="control-label">Images :</label><div class="col-md-3"><a class="uploadFile img btn btn-primary text-white btn-sm"  data-input="variant_images[' + a + '][]" data-isremovable="1" data-is-multiple-uploads-allowed="1" data-bs-toggle="modal" data-bs-target="#media-upload-modal" value="Upload Photo"><i class="fa fa-upload"></i> Upload</a> </div><div class="container-fluid row image-upload-section"></div></div>';
                html += '</div></div></div></div></div>';
            });

            if (is_appendable == false) {
                $('#variants_process').html(html);
            } else {
                $('#variants_process').append(html);
            }
            $('#variants_process').unblock();
        }
    });
}

function create_attributes(value, selected_attr) {
    counter++;
    var $attribute = $('#attributes_values_json_data').find('.select_single');
    var $options = $($attribute).clone().html();
    var $selected_attrs = [];
    if (selected_attr) {
        $.each(selected_attr.split(","), function () {
            $selected_attrs.push($.trim(this));
        });
    }

    var attr_name = 'pro_attr_' + counter;

    // product-attr-selectbox
    if ($('#product-type').val() == 'simple_product') {
        var html = '<div class="form-group move row my-auto p-2 border rounded bg-gray-light product-attr-selectbox" id=' + attr_name + '><div class="col-md-1 col-sm-12 text-center my-auto"><i class="fas fa-sort"></i></div><div class="col-md-4 col-sm-12"> <select name="attribute_id[]" class="attributes select_single" data-placeholder=" Type to search and select attributes"><option value=""></option>' + $options + '</select></div><div class="col-md-4 col-sm-12"> <select name="attribute_value_ids[]" class="multiple_values" multiple="" data-placeholder=" Type to search and select attributes values"><option value=""></option> </select></div><div class="col-md-2 col-sm-6 text-center py-1 align-self-center"> <button type="button" class="btn btn-tool remove_attributes"> <i class="text-danger far fa-times-circle fa-2x "></i> </button></div></div>';
    } else {
        $('#note').removeClass('d-none');
        var html = '<div class="form-group row move my-auto p-2 border rounded bg-gray-light product-attr-selectbox" id=' + attr_name + '><div class="col-md-1 col-sm-12 text-center my-auto"><i class="fas fa-sort"></i></div><div class="col-md-4 col-sm-12"> <select name="attribute_id[]" class="attributes select_single" data-placeholder=" Type to search and select attributes"><option value=""></option>' + $options + '</select></div><div class="col-md-4 col-sm-12"> <select name="attribute_value_ids[]" class="multiple_values" multiple="" data-placeholder=" Type to search and select attributes values"><option value=""></option> </select></div><div class="col-md-2 col-sm-6 text-center py-1 align-self-center"><input type="checkbox" name="variations[]" class="is_attribute_checked custom-checkbox mt-2"></div><div class="col-md-1 col-sm-6 text-center py-1 align-self-center"> <button type="button" class="btn btn-tool remove_attributes"> <i class="text-danger far fa-times-circle fa-2x "></i> </button></div></div>';
    }
    $('#attributes_process').append(html);
    if (selected_attr) {
        if ($.inArray(value.name, $selected_attrs) > -1) {
            $("#attributes_process").find('.product-attr-selectbox').last().find('.is_attribute_checked').prop('checked', true).addClass('custom-checkbox mt-2');
            $("#attributes_process").find('.product-attr-selectbox').last().find('.remove_attributes').addClass('remove_edit_attribute').removeClass('remove_attributes');

        }
    }
    $("#attributes_process").find('.product-attr-selectbox').last().find(".attributes").select2({

        placeholder: $(this).data('placeholder'),
        allowClear: Boolean($(this).data('allow-clear')),
    }).val(value.name);

    $("#attributes_process").find('.product-attr-selectbox').last().find(".attributes").trigger('change');
    $("#attributes_process").find('.product-attr-selectbox').last().find(".select_single").trigger('select2:select');

    var multiple_values = [];
    $.each(value.ids.split(","), function () {
        multiple_values.push($.trim(this));
    });

    $("#attributes_process").find('.product-attr-selectbox').last().find(".multiple_values").select2({

        placeholder: $(this).data('placeholder'),
        allowClear: Boolean($(this).data('allow-clear')),
    }).val(multiple_values);
    $("#attributes_process").find('.product-attr-selectbox').last().find(".multiple_values").trigger('change');
}

function create_fetched_attributes_html() {
    var edit_id = $('input[name="edit_product_id"]').val();
    $.ajax({
        type: 'GET',
        url: '/admin/product/fetch_attributes_by_id',
        data: {
            edit_id: edit_id,
            [csrfName]: csrfHash,
        },
        dataType: 'json',
        success: function (data) {
            // console.log(data);
            csrfName = data['csrfName'];
            csrfHash = data['csrfHash'];
            var result = data['result'];

            if (!$.isEmptyObject(result.attr_values)) {

                $.each(result.attr_values, function (key, value) {
                    create_attributes(value, result.pre_selected_variants_names);
                });

                $.each(result['pre_selected_variants_ids'], function (key, val) {
                    // pre_selected_attr_values[key] = $.trim();
                    var tempArray = [];
                    if (val.variant_ids) {
                        $.each(val.variant_ids.split(','), function (k, v) {
                            tempArray.push($.trim(v));
                        });
                        pre_selected_attr_values[key] = tempArray;
                    }
                });

                if (result.pre_selected_variants_names) {
                    $.each(result.pre_selected_variants_names.split(','), function (key, value) {
                        pre_selected_attributes_name.push($.trim(value));
                    });
                }
            } else {
                $('.no-attributes-added').show();
                $('#save_attributes').addClass('d-none');
            }
        }
    });
    return $.Deferred().resolve();
}

function search_category_wise_products() {
    var category_id = $('#category_parent').val();
    if (category_id != '') {
        $.ajax({
            data: {
                'cat_id': category_id,
            },
            type: 'GET',
            url: '/admin/product/search_category_wise_products',
            dataType: 'json',
            success: function (result) {
                var html = "";
                var i = 0;
                if (!$.isEmptyObject(result)) {
                    $.each(result, function (index, value) {
                        html += '<li class="list-group-item d-flex bg-gray-light align-items-center h-25 ui-sortable-handle" id="product_id-' + value['id'] + '">';
                        html += '<div class="col-md-1"><span> ' + i + ' </span></div>';
                        html += '<div class="col-md-3"><span> ' + value['row_order'] + ' </span></div>';
                        html += '<div class="col-md-4"><span>' + value['name'] + '</span></div>';
                        html += '<div class="col-md-4"><img src="' + base_url + value['image'] + '"  class="w-25"></div>';
                        i++;
                    });
                    $('#sortable').html(html);
                } else {

                    iziToast.error({
                        message: 'No Products Are Available',
                    });

                    html += '<li class="list-group-item d-flex justify-content-center bg-gray-light align-items-center h-25 ui-sortable-handle" id="product_id-3"><div class="col-md-12 d-flex justify-content-center"><span>No Products  Are  Available</span></div></li>';
                    $('#sortable').html(html);
                }
            }
        });
    } else {
        iziToast.error({
            message: 'Category Field Should Be Selected',
        });
    }
}

function save_product(form) {

    $('input[name="product_type"]').val($('#product-type').val());
    if ($('.simple_stock_management_status').is(':checked')) {
        $('input[name="simple_product_stock_status"]').val($('#simple_product_stock_status').val());
    } else {
        $('input[name="simple_product_stock_status"]').val('');
    }
    $('#product-type').prop('disabled', true);
    $('.product-attributes').removeClass('disabled');
    $('.product-variants').removeClass('disabled');
    $('.simple_stock_management_status').prop('disabled', true);

    var catid = $('#product_category_tree_view_html').jstree("get_selected");
    var formData = new FormData(form);
    var submit_btn = $('#submit_btn');
    var btn_html = $('#submit_btn').html();
    var btn_val = $('#submit_btn').val();
    var button_text = (btn_html != '' || btn_html != 'undefined') ? btn_html : btn_val;
    save_attributes();
    formData.append(csrfName, csrfHash);

    formData.append('category_id', catid);
    formData.append('attribute_values', all_attributes_values);

    $.ajax({
        type: 'POST',
        url: $(form).attr('action'),
        data: formData,
        beforeSend: function () {
            submit_btn.html('Please Wait..');
            submit_btn.attr('disabled', true);
        },
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function (result) {
            csrfName = result['csrfName'];
            csrfHash = result['csrfHash'];

            if (result['error'] == true) {
                submit_btn.html(button_text);
                submit_btn.attr('disabled', false);
                iziToast.error({
                    message: result['message'],
                });

            } else {
                submit_btn.html(button_text);
                submit_btn.attr('disabled', false);
                iziToast.success({
                    message: result['message'],
                });
                // setTimeout(function () { location.reload(); }, 600);
            }
        }
    });
}

function get_variants(edit_id) {
    return $.ajax({
        type: 'GET',
        url: '/admin/product/fetch_variants_values_by_pid',
        data: {
            edit_id: edit_id
        },
        dataType: 'json'
    })
            .done(function (data) {
//                 console.log(data);
                return data.responseCode != 200 ?
                        $.Deferred().reject(data) : data;
            });

}

function create_fetched_variants_html(add_newly_created_variants = false) {

    var newArr1 = [];
    for (var i = 0; i < pre_selected_attr_values.length; i++) {
        var temp = newArr1.concat(pre_selected_attr_values[i]);
        newArr1 = [...new Set(temp)];

    }
    var newArr2 = [];
    for (var i = 0; i < attributes_values.length; i++) {
        newArr2 = newArr2.concat(attributes_values[i]);
    }


    current_attributes_selected = $.grep(newArr2, function (x) {
        return $.inArray(x, newArr1) < 0
    });

    if (containsAll(newArr1, newArr2)) {
        var temp = [];
        if (!$.isEmptyObject(current_attributes_selected)) {
            $.ajax({
                type: 'GET',
                url: '/admin/product/fetch_attribute_values_by_id',
                data: {
                    id: current_attributes_selected,
                },
                dataType: 'json',
                success: function (result) {
                    temp = result.variant_ids;

                    $.each(result.variant_ids, function (key, value) {
                        if (pre_selected_attributes_name.indexOf($.trim(value.name)) > -1) {
                            delete temp[key];
                        }
                    });

                    var resetArr = temp.filter(function () {
                        return true;
                    });
                    setTimeout(function () {
                        var edit_id = $('input[name="edit_product_id"]').val();
                        get_variants(edit_id).done(function (data) {
                            create_editable_variants(data.result, resetArr, add_newly_created_variants);
                        });
                    }, 1000);
                }
            });
        } else {
            if (attribute_flag == 0) {
                var edit_id = $('input[name="edit_product_id"]').val();
                get_variants(edit_id).done(function (data) {
                    create_editable_variants(data.result, false, add_newly_created_variants);
                });
            }
        }
    } else {
        var edit_id = $('input[name="edit_product_id"]').val();
        get_variants(edit_id).done(function (data) {
            create_editable_variants(data.result, false, add_newly_created_variants);
        });
}
}

function create_editable_variants(data, newly_selected_attr = false, add_newly_created_variants = false) {
    // console.log(data);
    if (data[0]?.variant_ids) {
        $('#reset_variants').show();
        var html = '';

        if (!$.isEmptyObject(attributes_values) && add_newly_created_variants == true) {
            var permuted_value_result = getPermutation(attributes_values);
        }

        $.each(data, function (a, b) {

            if (!$.isEmptyObject(permuted_value_result) && add_newly_created_variants == true) {
                var permuted_value_result_temp = permuted_value_result;
                var varinat_ids = b.variant_ids.split(',');
                $.each(permuted_value_result_temp, function (index, value) {
                    if (containsAll(varinat_ids, value)) {
                        permuted_value_result.splice(index, 1);
                    }
                });
            }

            variant_counter++;
            var attr_name = 'pro_attr_' + variant_counter;
            html += '<div class="form-group move row my-auto p-2 border rounded bg-gray-light product-variant-selectbox"><div class="col-1 text-center my-auto"><i class="fas fa-sort"></i></div>';
            html += '<input type="hidden" name="edit_variant_id[]" value=' + b.id + '>';
            var tmp_variant_value_id = "";
            var varaint_array = [];
            var varaint_ids_temp_array = [];
            var flag = 0;
            var variant_images = "";
            var image_html = "";
            if (b.images != "") {
                variant_images = JSON.parse(b.images);
            }

            $.each(b.variant_ids.split(","), function (key) {
                varaint_ids_temp_array[key] = $.trim(this);
            });

            $.each(b.variant_values.split(","), function (key) {
                varaint_array[key] = $.trim(this);
            });

            $.each(variant_images, function (img_key, img_value) {
                image_html += '<div class="col-md-3 col-sm-12 shadow bg-white rounded m-3 p-3 text-center grow"><div class="image-upload-div"><img src=' + base_url + img_value + ' alt="Image Not Found"></div> <a href="javascript:void(0)" class="delete-img m-3" data-id="' + b.id + '" data-field="images" data-img=' + img_value + ' data-table="product_variants" data-path="uploads/media/" data-isjson="true"> <span class="btn btn-block bg-gradient-danger btn-xs"><i class="far fa-trash-alt "></i> Delete</span></a> <input type="hidden" name="variant_images[' + a + '][]"  value=' + img_value + '></div>';
            });

            for (var i = 0; i < varaint_array.length; i++) {
                // html += '<div class="col-2 variant_col"> <a href="javascript:void(0)" class="remove_individual_variants" ><i class="far fa-times-circle icon-link-remove fa-md"></i></a><input type="hidden"  value="' + varaint_ids_temp_array[i] + '"><input type="text" class="col form-control" value="' + varaint_array[i] + '" readonly></div>';
                html += '<div class="col-2 variant_col"> <input type="hidden"  value="' + varaint_ids_temp_array[i] + '"><input type="text" class="col form-control" value="' + varaint_array[i] + '" readonly></div>';
            }
            if (newly_selected_attr != false && newly_selected_attr.length > 0) {
                for (var i = 0; i < newly_selected_attr.length; i++) {
                    var tempVariantsIds = [];
                    var tempVariantsValues = [];
                    $.each(newly_selected_attr[i].attribute_values_id.split(','), function () {
                        tempVariantsIds.push($.trim(this));
                    });
                    html += '<div class="col-2"><select class="col new-added-variant form-control" ><option value="">Select Attribute</option>';
                    $.each(newly_selected_attr[i].attribute_values.split(','), function (key) {
                        tempVariantsValues.push($.trim(this));
                        html += '<option value="' + tempVariantsIds[key] + '">' + tempVariantsValues[key] + '</option>';
                    });
                    html += '</select></div>';
                }
            }
            html += '<input type="hidden" name="variants_ids[]" value="' + b.attribute_value_ids + '"><div class="col my-auto row justify-content-center"> <a data-bs-toggle="collapse" class="btn btn-tool text-primary" data-bs-target="#' + attr_name + '" aria-expanded="true"><i class="fas fa-angle-down fa-2x"></i> </a> <button type="button" class="btn btn-tool remove_variants"> <i class="text-danger far fa-times-circle fa-2x "></i> </button></div><div class="col-12" id="variant_stock_management_html"><div id=' + attr_name + ' style="" class="collapse">';
            if ($('.variant_stock_status').is(':checked') && $('.variant-stock-level-type').val() == 'variable_level') {
                var selected = (b.availability == '0') ? 'selected' : ' ';
                html += '<div class="form-group row"><div class="col col-xs-12"><label class="control-label">Price :</label><input type="number" name="variant_price[]" class="col form-control price varaint-must-fill-field" value="' + b.price + '" min="0" step="0.01"></div><div class="col col-xs-12"><label class="control-label">Special Price :</label><input type="number" name="variant_special_price[]" class="col form-control discounted_price" min="0" value="' + b.special_price + '" step="0.01"></div><div class="col col-xs-12"> <label class="control-label">Sku :</label> <input type="text" name="variant_sku[]" class="col form-control varaint-must-fill-field"  value="' + b.sku + '" ></div><div class="col col-xs-12"> <label class="control-label">Total Stock :</label> <input type="text" name="variant_total_stock[]" class="col form-control varaint-must-fill-field" value="' + b.stock + '"></div><div class="col col-xs-12"> <label class="control-label">Stock Status :</label> <select type="text" name="variant_level_stock_status[]" class="col form-control varaint-must-fill-field"><option value="1">In Stock</option><option value="0"  ' + selected + '  >Out Of Stock</option> </select></div></div>';
            } else {
                html += '<div class="form-group row"><div class="col col-xs-12"><label class="control-label">Price :</label><input type="number" name="variant_price[]" class="col form-control price varaint-must-fill-field" value="' + b.price + '" min="0" step="0.01"></div><div class="col col-xs-12"><label class="control-label">Special Price :</label><input type="number" name="variant_special_price[]" class="col form-control discounted_price"  min="0" value="' + b.special_price + '" step="0.01"></div></div>';
            }
            html += '<div class="col-12 pt-3"><label class="control-label">Images :</label><div class="col-md-3"><a class="uploadFile img btn btn-primary text-white btn-sm"  data-input="variant_images[' + a + '][]" data-isremovable="1" data-is-multiple-uploads-allowed="1" data-bs-toggle="modal" data-bs-target="#media-upload-modal" value="Upload Photo"><i class="fa fa-upload"></i> Upload</a> </div><div class="container-fluid row image-upload-section"> ' + image_html + ' </div></div>';
            html += '</div></div></div>';

            $('#variants_process').html(html);
        });

        if (!$.isEmptyObject(attributes_values) && add_newly_created_variants == true) {
            create_variants(permuted_value_result);
        }

}
}

function getPermutation(args) {
    var r = [],
            max = args.length - 1;

    function helper(arr, i) {
        for (var j = 0, l = args[i].length; j < l; j++) {
            var a = arr.slice(0); // clone arr
            a.push(args[i][j]);
            if (i == max)
                r.push(a);
            else
                helper(a, i + 1);
        }
    }
    helper([], 0);
    return r;
}

$(document).on('click', '#variation_product_btn', function (e) {
    e.preventDefault();
    var radio = $("input[name='pro_input_type']:checked").val();
    var edit_product_id = $('input[name=edit_product_id]').val();
    var html = '';
    html = add_product_variant_html(radio);
    $('#product_variance_html').append(html);
    if (typeof edit_product_id != 'undefined') {
        $("#product_variance_html").children('div').last().append("<input type='hidden' name='edit_product_variant[]'>");
    }
});
$(document).on('click', '#remove_product_btn', function (e) {
    e.preventDefault();
    $(this).closest('.row').remove();
});
$(document).on('click', '.delete-img', function () {
    var isJson = false;
    var id = $(this).data('id');
    var path = $(this).data('path');
    var field = $(this).data('field');
    var img_name = $(this).data('img');
    var table_name = $(this).data('table');
    var t = this;
    var isjson = $(this).data('isjson');
    Swal.fire({
        title: 'Are You Sure!',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        showLoaderOnConfirm: true,
        preConfirm: function () {
            return new Promise((resolve, reject) => {
                $.ajax({
                    type: 'POST',
                    url: '/admin/home/delete_image',
                    data: {
                        id: id,
                        path: path,
                        field: field,
                        img_name: img_name,
                        table_name: table_name,
                        isjson: isjson,
                        [csrfName]: csrfHash
                    },
                    dataType: 'json',
                    success: function (result) {
                        csrfName = result['csrfName'];
                        csrfHash = result['csrfHash'];
                        // // console.log(result);
                        if (result['is_deleted'] == true) {
                            $(t).closest('div').remove();
                            Swal.fire('Success', 'Media Deleted !', 'success');
                        } else {
                            Swal.fire('Oops...', 'Something went wrong with ajax !', 'error');
                        }
                    }
                });
            });
        },
        allowOutsideClick: false
    }).then((result) => {
        if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire('Cancelled!', 'Your data is  safe.', 'error');
        }
    });
});
$(document).on('click', '.delete-media', function () {

    var id = $(this).data('id');
    var t = this;
    Swal.fire({
        title: 'Are You Sure!',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        showLoaderOnConfirm: true,
        preConfirm: function () {
            return new Promise((resolve, reject) => {
                $.ajax({
                    type: 'GET',
                    url: '/admin/media/delete/' + id,
                    dataType: 'json',
                    success: function (result) {
                        csrfName = result['csrfName'];
                        csrfHash = result['csrfHash'];
                        if (result['error'] == false) {
                            $('table').bootstrapTable('refresh');
                            Swal.fire('Success', 'File Deleted !', 'success');
                        } else {
                            Swal.fire('Oops...', result['message'], 'error');
                        }
                    }
                });
            });
        },
        allowOutsideClick: false
    }).then((result) => {
        if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire('Cancelled!', 'Your data is  safe.', 'error');
        }
    });
});

$(document).on('focusout', '.discounted_price', function () {
    var discount_amt = parseInt($(this).val());
    var price = parseInt($(this).closest('.form-group').siblings().find('.price').val());
    if (typeof price != 'undefined' && price != "") {
        if (discount_amt > price) {
            iziToast.error({
                message: "Special price can" + "'" + "t exceed price",
            });
            $(this).val('');
        }
    }
});
$(document).on('focusout', '.price', function () {
    var price = parseInt($(this).val());
    var discount_amt = parseInt($(this).closest('.form-group').siblings().find('.discounted_price').val());
    if (typeof discount_amt != 'undefined' && discount_amt != "") {
        if (discount_amt > price) {
            iziToast.error({
                message: "Special price can" + "'" + "t exceed price",
            });
            $(this).val('');
        }
    }
});

$(document).on('click', '.clear-product-variance', function () {
    var edit_product_id = $('input[name=edit_product_id]').val();
    var radio_val = $("input[name='pro_input_type']:checked").val();
    var t = this;
    Swal.fire({
        title: 'Are You Sure!',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        showLoaderOnConfirm: true,
        preConfirm: function () {
            return new Promise((resolve, reject) => {
                $.ajax({
                    url: '/admin/product/delete_product',
                    type: 'GET',
                    data: {
                        'id': edit_product_id
                    },
                    dataType: 'json'
                }).done(function (response, textStatus) {
                    Swal.fire('Deleted!', response.message);
                    if (radio_val == 'packet') {
                        html = add_product_variant_html(radio_val);
                        $('#product_variance_html').html(html);
                        $('#product_loose_html').hide();
                        $('.pro_loose').hide();
                        $('.remove_pro_btn').hide();
                        $(t).hide();
                    } else {
                        $('#product_variance_html').show();
                        html = add_product_variant_html(radio_val);
                        $('#product_loose_html').show();
                        $('#product_variance_html').html(html);
                        $('.remove_pro_btn').hide();
                    }
                }).fail(function (jqXHR, textStatus, errorThrown) {
                    Swal.fire('Oops...', 'Something went wrong with ajax !', 'error');
                });
            });
        },
        allowOutsideClick: false
    }).then((result) => {
        if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire('Cancelled!', 'Your data is  safe.', 'error');
        }
    });
});
$('#sortable').sortable({
    axis: 'y',
    opacity: 0.6,
    cursor: 'grab'
});
$(document).on('click', '#save_product_order', function () {
    var data = $('#sortable').sortable('serialize');
    $.ajax({
        data: data,
        type: 'GET',
        url: '/admin/product/update_product_order',
        dataType: 'json',
        success: function (response) {
            if (response.error == false) {
                iziToast.success({
                    message: response.message,
                });
            } else {
                iziToast.error({
                    message: response.message,
                });
            }
        }
    });
});
$(document).on('click', '#save_section_order', function () {
    var data = $('#sortable').sortable('serialize');
    $.ajax({
        data: data,
        type: 'GET',
        url: '/admin/featured_sections/update_section_order',
        dataType: 'json',
        success: function (response) {
            if (response.error == false) {
                iziToast.success({
                    message: response.message,
                });
            } else {
                iziToast.error({
                    message: response.message,
                });
            }
        }
    });
});

//form-submit-event
$(document).on('submit', '#save-product', function (e) {
    e.preventDefault();
    var product_type = $('#product-type').val();
    var counter = 0;
    if (product_type != 'undefined' && product_type != ' ') {

        if ($.trim(product_type) == 'simple_product') {
            if ($('.simple_stock_management_status').is(':checked')) {
                var len = 0
            } else {
                var len = 1
            }

            if ($('.stock-simple-mustfill-field').filter(function () {
                return this.value === '';
            }).length === len) {

                $('input[name="product_type"]').val($('#product-type').val());
                if ($('.simple_stock_management_status').is(':checked')) {
                    $('input[name="simple_product_stock_status"]').val($('#simple_product_stock_status').val());
                } else {
                    $('input[name="simple_product_stock_status"]').val('');
                }
                $('#product-type').prop('disabled', true);
                $('.product-attributes').removeClass('disabled');
                $('.product-variants').removeClass('disabled');
                $('.simple_stock_management_status').prop('disabled', true);

                save_product(this);
            } else {
                iziToast.error({
                    message: 'Please Fill All The Fields',
                });
            }
        }

        if ($.trim(product_type) == 'variable_product') {
            if ($('.variant_stock_status').is(":checked")) {
                var variant_stock_level_type = $('.variant-stock-level-type').val();
                if (variant_stock_level_type == 'product_level') {
                    if ($('.variant-stock-level-type').filter(function () {
                        return this.value === '';
                    }).length === 0 && $.trim($('.variant-stock-level-type').val()) != "") {

                        if ($('.variant-stock-level-type').val() == 'product_level' && $('.variant-stock-mustfill-field').filter(function () {
                            return this.value === '';
                        }).length !== 0) {
                            iziToast.error({
                                message: 'Please Fill All The Fields',
                            });
                        } else {
                            var varinat_price = $('input[name="variant_price[]"]').val();

                            if ($('input[name="variant_price[]"]').length >= 1) {

                                if ($('.varaint-must-fill-field').filter(function () {
                                    return this.value === '';
                                }).length == 0) {

                                    $('input[name="product_type"]').val($('#product-type').val());
                                    $('input[name="variant_stock_level_type"]').val($('#stock_level_type').val());
                                    $('input[name="varaint_stock_status"]').val("0");
                                    $('#product-type').prop('disabled', true);
                                    $('#stock_level_type').prop('disabled', true);
                                    $(this).removeClass('save-variant-general-settings');
                                    $('.product-attributes').removeClass('disabled');
                                    $('.product-variants').removeClass('disabled');
                                    $('.variant-stock-level-type').prop('readonly', true);
                                    $('#stock_status_variant_type').attr('readonly', true);
                                    $('.variant-product-level-stock-management').find('input,select').prop('readonly', true);
                                    $('#product-variants-tab').removeClass('d-none');
                                    $('.variant_stock_status').prop('disabled', true);
//                                    $('#product-tab a[href="#product-attributes"]').tab('show');
                                    productAttributesTab.show();

                                    save_product(this);

                                } else {
                                    $('.varaint-must-fill-field').each(function () {
                                        $(this).css('border', '');
                                        if ($(this).val() == '') {
                                            $(this).css('border', '2px solid red');
                                            $(this).closest('#variant_stock_management_html').find('div:first').addClass('show');
//                                            $('#product-tab a[href="#product-variants"]').tab('show');
                                            productVariantsTab.show();

                                            counter++;
                                        }
                                    });
                                }


                            } else {

                                Swal.fire('Variation Needed !', 'Atleast Add One Variation To Add The Product.', 'warning');
                            }
                        }
                    } else {
                        iziToast.error({
                            message: 'Please Fill All The Fields',
                        });
                    }
                } else {
                    if ($('input[name="variant_price[]"]').length >= 1) {

                        if ($('.varaint-must-fill-field').filter(function () {
                            return this.value === '';
                        }).length == 0) {
                            $('input[name="product_type"]').val($('#product-type').val());
                            $('.variant_stock_status').prop('disabled', true);
                            $('#product-type').prop('disabled', true);
                            $('.product-attributes').removeClass('disabled');
                            $('.product-variants').removeClass('disabled');
                            $('#product-variants-tab').removeClass('d-none');
                            save_product(this);
                        } else {
                            $('.varaint-must-fill-field').each(function () {
                                $(this).css('border', '');
                                if ($(this).val() == '') {
                                    $(this).css('border', '2px solid red');
                                    $(this).closest('#variant_stock_management_html').find('div:first').addClass('show');
//                                    $('#product-tab a[href="#product-variants"]').tab('show');
                                    productVariantsTab.show();
                                    counter++;
                                }
                            });
                        }

                    } else {

                        Swal.fire('Variation Needed !', 'Atleast Add One Variation To Add The Product.', 'warning');

                    }
                }
            } else {

                if ($('input[name="variant_price[]"]').length == 0) {
                    Swal.fire('Variation Needed !', 'Atleast Add One Variation To Add The Product.', 'warning');
                } else {
                    if ($('.varaint-must-fill-field').filter(function () {
                        return this.value === '';
                    }).length == 0) {
                        save_product(this);
                    } else {
                        $('.varaint-must-fill-field').each(function () {
                            $(this).css('border', '');
                            if ($(this).val() == '') {
                                $(this).css('border', '2px solid red');
                                $(this).closest('#variant_stock_management_html').find('div:first').addClass('show');
//                                $('#product-tab a[href="#product-variants"]').tab('show');
                                productVariantsTab.show();
                                counter++;
                            }
                        });
                    }
                }
            }
        }

    } else {
        iziToast.error({
            message: 'Please Select Product Type !',
        });
    }

    if (counter > 0) {
        iziToast.error({
            message: 'Please fill all the required fields in the variation tab !',
        });
    }

});

$(document).on('click', '#delete-product', function () {
    var id = $(this).data('id');
    Swal.fire({
        title: 'Are You Sure!',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        showLoaderOnConfirm: true,
        preConfirm: function () {
            return new Promise((resolve, reject) => {
                $.ajax({
                    type: 'GET',
                    url: '/admin/product/delete_product',
                    data: {
                        id: id
                    },
                    dataType: 'json'
                }).done(function (response, textStatus) {
                    if (response.error == false) {

                        Swal.fire('Deleted!', response.message, 'success');
                    } else {
                        Swal.fire('Oops...', response.message, 'error');
                    }
                    $('table').bootstrapTable('refresh');
                    csrfName = response['csrfName'];
                    csrfHash = response['csrfHash'];
                }).fail(function (jqXHR, textStatus, errorThrown) {
                    Swal.fire('Oops...', 'Something went wrong with ajax !', 'error');
                    csrfName = response['csrfName'];
                    csrfHash = response['csrfHash'];
                });
            });
        },
        allowOutsideClick: false
    });
});

// multiple_values
$('.select_single , .multiple_values , #product-type').each(function () {
    $(this).select2({

        placeholder: $(this).data('placeholder'),
        allowClear: Boolean($(this).data('allow-clear')),
    });
});

$(document).on('select2:selecting', '.select_single', function (e) {

    if ($.inArray($(this).val(), attributes_values_selected) > -1) {
        //Remove value if further selected
        attributes_values_selected.splice(attributes_values_selected.indexOf($(this).select2().find(":selected").val()), 1);
    }

});

$(document).on('select2:selecting', '.select_single .variant_attributes', function (e) {

    if ($.inArray($(this).val(), variant_values_selected) > -1) {
        //Remove value if further selected
        variant_values_selected.splice(variant_values_selected.indexOf($(this).select2().find(":selected").val()), 1);

    }

});

$(document).on('select2:select', '.select_single', function (e) {
    var text = this.className;
    var type;
    $(this).closest('.row').find(".multiple_values").text(null).trigger('change');
    var data = $(this).select2().find(":selected").data("values");
    if (text.search('attributes') != -1) {
        value_check_array = attributes_values_selected.slice();
        type = 'attributes';
    }

    if (text.search('variant_attributes') != -1) {
        value_check_array = variant_values_selected.slice();
        type = 'variant_attributes';
    }

    if ($.inArray($(this).select2().find(":selected").val(), value_check_array) > -1) {
        iziToast.error({
            message: 'Attribute Already Selected',
        });
        $(this).val('').trigger('change');
    } else {
        value_check_array.push($(this).select2().find(":selected").val());
    }
    if (text.search('attributes') != -1) {
        attributes_values_selected = value_check_array.slice();
    }

    if (text.search('variant_attributes') != -1) {
        variant_values_selected = value_check_array.slice();
    }
    $(this).closest('.row').find("." + type).select2({

        placeholder: $(this).data('placeholder'),
        allowClear: Boolean($(this).data('allow-clear')),
    });
    $(this).closest('.row').find(".multiple_values").select2({

        placeholder: $(this).data('placeholder'),
        allowClear: Boolean($(this).data('allow-clear')),
        data: data,
    });


});

$(document).on('click', ' #add_attributes , #product-variants-tab', function (e) {

    if (e.target.id == 'add_attributes') {

        $('.no-attributes-added').hide();
        $('#save_attributes').removeClass('d-none');
        counter++;
        var $attribute = $('#attributes_values_json_data').find('.select_single');
        var $options = $($attribute).clone().html();
        var attr_name = 'pro_attr_' + counter;
        // product-attr-selectbox
        if ($('#product-type').val() == 'simple_product') {
            var html = '<div class="form-group move row my-auto p-2 border rounded bg-gray-light product-attr-selectbox" id=' + attr_name + '><div class="col-md-1 col-sm-12 text-center my-auto"><i class="fas fa-sort"></i></div><div class="col-md-4 col-sm-12"> <select name="attribute_id[]" class="attributes select_single" data-placeholder=" Type to search and select attributes"><option value=""></option>' + $options + '</select></div><div class="col-md-4 col-sm-12 "> <select name="attribute_value_ids[]" class="multiple_values" multiple="" data-placeholder=" Type to search and select attributes values"><option value=""></option> </select></div><div class="col-md-2 col-sm-6 text-center py-1 align-self-center"> <button type="button" class="btn btn-tool remove_attributes"> <i class="text-danger far fa-times-circle fa-2x "></i> </button></div></div>';
        } else {
            $('#note').removeClass('d-none');
            var html = '<div class="form-group row move my-auto p-2 border rounded bg-gray-light product-attr-selectbox" id=' + attr_name + '><div class="col-md-1 col-sm-12 text-center my-auto"><i class="fas fa-sort"></i></div><div class="col-md-4 col-sm-12"> <select name="attribute_id[]" class="attributes select_single" data-placeholder=" Type to search and select attributes"><option value=""></option>' + $options + '</select></div><div class="col-md-4 col-sm-12 "> <select name="attribute_value_ids[]" class="multiple_values" multiple="" data-placeholder=" Type to search and select attributes values"><option value=""></option> </select></div><div class="col-md-2 col-sm-6 text-center py-1 align-self-center"><input type="checkbox" name="variations[]" class="is_attribute_checked custom-checkbox "></div><div class="col-md-1 col-sm-6 text-center py-1 align-self-center "> <button type="button" class="btn btn-tool remove_attributes"> <i class="text-danger far fa-times-circle fa-2x "></i> </button></div></div>';
        }
        $('#attributes_process').append(html);

        $("#attributes_process").last().find(".attributes").select2({

            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });

        // $("#attributes_process").last().find(".attributes").trigger('change');    

        $("#attributes_process").last().find(".multiple_values").select2({

            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });
    }

    if (e.target.id == 'product-variants-tab') {
        $('.additional-info').block({
            message: '<h6>Loading Variations</h6>',
            css: {border: '3px solid #E7F3FE'}
        });
        if (attributes_values.length > 0) {

            $('.no-variants-added').hide();
            create_variants();

        }
        setTimeout(function () {
            $('.additional-info').unblock();
        }, 3000);
    }

});

$(document).on('click', '#reset_variants', function () {

    Swal.fire({
        title: 'Are You Sure To Reset!',
        text: "You won't be able to revert this after update!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Reset it!',
        showLoaderOnConfirm: true,
        allowOutsideClick: false
    }).then((result) => {
        if (result.value) {
            $('.additional-info').block({
                message: '<h6>Reseting Variations</h6>',
                css: {border: '3px solid #E7F3FE'}
            });
            if (attributes_values.length > 0) {
                $('.no-variants-added').hide();
                create_variants();
            }
            setTimeout(function () {
                $('.additional-info').unblock();
            }, 2000);
        }
    });
});

$(document).on('click', '.remove_edit_attribute', function (e) {

    $(this).closest('.row').remove();
});

$(document).on('click', '.remove_attributes , .remove_variants', function (e) {
    Swal.fire({
        title: 'Are you sure want to delete!',
        text: "You won't be able to revert this after update!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Delete it!',
        showLoaderOnConfirm: true,
        allowOutsideClick: false
    }).then((result) => {
        if (result.value) {
            var text = this.className;
            if (text.search('remove_attributes') != -1) {
                var edit_id = $('#edit_product_id').val();

                attributes_values_selected.splice(attributes_values_selected.indexOf($(this).select2().find(":selected").val()), 1);
                $(this).closest('.row').remove();
                counter -= 1;
                var numItems = $('.product-attr-selectbox').length;
                if (numItems == 0) {
                    $('.no-attributes-added').show();
                    $('#save_attributes').addClass('d-none');
                    $('#note').addClass('d-none');

                }

            }
            if (text.search('remove_variants') != -1) {
                variant_values_selected.splice(variant_values_selected.indexOf($(this).select2().find(":selected").val()), 1);
                $(this).closest('.form-group').remove();
                variant_counter -= 1;
                var numItems = $('.product-variant-selectbox').length;
                if (numItems == 0) {
                    $('.no-variants-added').show();
                }
            }
        }
    });
});

$(document).on('select2:select', '#product-type', function () {
    var value = $(this).val();
    if ($.trim(value) != "") {
        if (value == 'simple_product') {
            $('#variant_stock_level').hide(200);
            $('#general_price_section').show(200);
            $('.simple-product-save').show(700);
            $('.product-attributes').addClass('disabled');
            $('.product-variants').addClass('disabled');

        }
        if (value == 'variable_product') {
            $('#general_price_section').hide(200);
            $('.simple-product-level-stock-management').hide(200);
            $('.simple-product-save').hide(200);
            $('.product-attributes').addClass('disabled');
            $('.product-variants').addClass('disabled');
            $('#variant_stock_level').show();
        }

    } else {
        $('.product-attributes').addClass('disabled');
        $('.product-variants').addClass('disabled');
        $('#general_price_section').hide(200);
        $('.simple-product-level-stock-management').hide(200);
        $('.simple-product-save').hide(200)
        $('#variant_stock_level').hide(200);
    }
});

$(document).on('change', '.variant_stock_status', function () {
    if ($(this).prop("checked") == true) {
        $(this).attr("checked", true);
        $('#stock_level').show(200);
    } else {
        $(this).attr("checked", false);
        $('#stock_level').hide(200);
    }
});

$(document).on('change', '.variant-stock-level-type', function () {
    if ($('.variant-stock-level-type').val() == 'product_level') {
        $('.variant-product-level-stock-management').show();
    }
    if ($.trim($('.variant-stock-level-type').val()) != 'product_level') {
        $('.variant-product-level-stock-management').hide();
    }
});

$(document).on('change', '.simple_stock_management_status', function () {
    if ($(this).prop("checked") == true) {
        $(this).attr("checked", true);
        $('.simple-product-level-stock-management').show(200);
    } else {
        $(this).attr("checked", false);
        $('.simple-product-level-stock-management').hide(200);
        $('.simple-product-level-stock-management').find('input').val('');
    }
});

$(document).on('click', '#save_attributes', function () {
    Swal.fire({
        title: 'Are you sure want to save changes!',
        text: "Do not save attributes if you made no changes! It will reset the variants if there are no changes in attributes or its values !",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, save it!',
        showLoaderOnConfirm: true,
        allowOutsideClick: false
    }).then((result) => {
        if (result.value) {
            attribute_flag = 1;
            save_attributes();
            create_fetched_variants_html(true);
            iziToast.success({
                message: 'Attributes Saved Succesfully',
            });
        }
    });
});

$('#attributes_process').sortable({
    axis: 'y',
    opacity: 0.6,
    cursor: 'grab'
});

$('#variants_process').sortable({
    axis: 'y',
    opacity: 0.6,
    cursor: 'grab'
});

$(document).on('click', '.reset-settings', function (e) {

    Swal.fire({
        title: 'Are You Sure To Reset!',
        text: "This will reset all attributes && variants too if added.",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Reset it!',
        showLoaderOnConfirm: true,
        allowOutsideClick: false
    }).then((result) => {
        if (result.value) {
            attributes_values_selected = [];
            value_check_array = [];
            pre_selected_attr_values = [];
            var html = ' <input type="hidden" name="reset_settings" value="1"><div class="row mt-4 col-md-12 "> <nav class="w-100"><div class="nav nav-tabs" id="product-tab" role="tablist"> <a class="nav-item nav-link active" id="tab-for-general-price" data-bs-toggle="tab" href="#general-settings" role="tab" aria-controls="general-price" aria-selected="true">General</a> <a class="nav-item nav-link disabled product-attributes" id="tab-for-attributes" data-bs-toggle="tab" href="#product-attributes" role="tab" aria-controls="product-attributes" aria-selected="false">Attributes</a> <a class="nav-item nav-link disabled product-variants d-none" id="product-variants-tab" data-bs-toggle="tab" href="#product-variants" role="tab" aria-controls="product-variants" aria-selected="false">Variations</a></div> </nav><div class="tab-content p-3 col-md-12" id="nav-tabContent"><div class="tab-pane fade active show" id="general-settings" role="tabpanel" aria-labelledby="general-settings-tab"><div class="form-group"> <label for="type" class="col-md-2">Type Of Product :</label><div class="col-md-12"> <input type="hidden" name="product_type"> <input type="hidden" name="simple_product_stock_status"> <input type="hidden" name="variant_stock_level_type"> <input type="hidden" name="variant_stock_status"> <select name="type" id="product-type" class="form-control product-type" data-placeholder=" Type to search and select type"><option value=" ">Select Type</option><option value="simple_product">Simple Product</option><option value="variable_product">Variable Product</option> </select></div></div><div id="product-general-settings"><div id="general_price_section" class="collapse"><div class="form-group"> <label for="type" class="col-md-2">Price:</label><div class="col-md-12"> <input type="number" name="simple_price" class="form-control stock-simple-mustfill-field price" min="0"></div></div><div class="form-group"> <label for="type" class="col-md-2">Special Price:</label><div class="col-md-12"> <input type="number" name="simple_special_price" class="form-control discounted_price" min="0"></div></div><div class="form-group"><div class="col"> <input type="checkbox" name="simple_stock_management_status" class="align-middle simple_stock_management_status"> <span class="align-middle">Enable Stock Management</span></div></div></div><div class="form-group simple-product-level-stock-management collapse"><div class="col col-xs-12"> <label class="control-label">SKU :</label> <input type="text" name="product_sku" class="col form-control simple-pro-sku"></div><div class="col col-xs-12"> <label class="control-label">Total Stock :</label> <input type="text" name="product_total_stock" class="col form-control stock-simple-mustfill-field"></div><div class="col col-xs-12"> <label class="control-label">Stock Status :</label> <select type="text" class="col form-control stock-simple-mustfill-field" id="simple_product_stock_status"><option value="1">In Stock</option><option value="0">Out Of Stock</option> </select></div></div><div class="form-group collapse simple-product-save"><div class="col"> <a href="javascript:void(0);" class="btn btn-primary save-settings">Save Settings</a></div></div></div><div id="variant_stock_level" class="collapse"><div class="form-group"><div class="col"> <input type="checkbox" name="variant_stock_management_status" class="align-middle variant_stock_status"> <span class="align-middle"> Enable Stock Management</span></div></div><div class="form-group collapse" id="stock_level"> <label for="type" class="col-md-2">Choose Stock Management Type:</label><div class="col-md-12"> <select id="stock_level_type" class="form-control variant-stock-level-type" data-placeholder=" Type to search and select type"><option value=" ">Select Stock Type</option><option value="product_level">Product Level ( Stock Will Be Managed Generally )</option><option value="variable_level">Variable Level ( Stock Will Be Managed Variant Wise )</option> </select><div class="form-group row variant-product-level-stock-management collapse"><div class="col col-xs-12"> <label class="control-label">SKU :</label> <input type="text" name="sku_variant_type" class="col form-control"></div><div class="col col-xs-12"> <label class="control-label">Total Stock :</label> <input type="text" name="total_stock_variant_type" class="col form-control variant-stock-mustfill-field"></div><div class="col col-xs-12"> <label class="control-label">Stock Status :</label> <select type="text" id="stock_status_variant_type" name="variant_status" class="col form-control variant-stock-mustfill-field"><option value="1">In Stock</option><option value="0">Out Of Stock</option> </select></div></div></div></div><div class="form-group"><div class="col"> <a href="javascript:void(0);" class="btn btn-primary save-variant-general-settings">Save Settings</a></div></div></div></div><div class="tab-pane fade" id="product-attributes" role="tabpanel" aria-labelledby="product-attributes-tab"><div class="info col-12 p-3 d-none" id="note"><div class=" col-12 d-flex align-center"> <strong>Note : </strong> <input type="checkbox" checked="checked" class="ml-3 my-auto custom-checkbox" disabled> <span class="ml-3">check if the attribute is to be used for variation </span></div></div><div class="col-md-12"> <a href="javascript:void(0);" id="add_attributes" class="btn btn-block btn-outline-primary col-md-2 float-right m-2 btn-sm">Add Attributes</a> <a href="javascript:void(0);" id="save_attributes" class="btn btn-block btn-outline-primary col-md-2 float-right m-2 btn-sm d-none">Save Attributes</a></div><div class="clearfix"></div><div id="attributes_process"><div class="form-group text-center row my-auto p-2 border rounded bg-gray-light col-md-12 no-attributes-added"><div class="col-md-12 text-center">No Product Attribures Are Added !</div></div></div></div><div class="tab-pane fade" id="product-variants" role="tabpanel" aria-labelledby="product-variants-tab"><div class="clearfix"></div><div class="form-group text-center row my-auto p-2 border rounded bg-gray-light col-md-12 no-variants-added"><div class="col-md-12 text-center">No Product Variations Are Added !</div></div><div id="variants_process" class="ui-sortable"></div></div></div></div>';
            $('.additional-info').html(html);
            $('.no-attributes-added').show();
            $('#product-type').each(function () {
                $(this).select2({

                    placeholder: $(this).data('placeholder'),
                    allowClear: Boolean($(this).data('allow-clear')),
                });
            });
        }
    });


});
$(document).on('click', '.save-settings', function (e) {
    e.preventDefault();

    if ($('.simple_stock_management_status').is(':checked')) {
        var len = 0
    } else {
        var len = 1
    }

    if ($('.stock-simple-mustfill-field').filter(function () {
        return this.value === '';
    }).length === len) {
        $('.additional-info').block({
            message: '<h6>Saving Settings</h6>',
            css: {border: '3px solid #E7F3FE'}
        });

        $('input[name="product_type"]').val($('#product-type').val());
        if ($('.simple_stock_management_status').is(':checked')) {
            $('input[name="simple_product_stock_status"]').val($('#simple_product_stock_status').val());
        } else {
            $('input[name="simple_product_stock_status"]').val('');
        }
        $('#product-type').prop('disabled', true);
        $('.product-attributes').removeClass('disabled');
        $('.product-variants').removeClass('disabled');
        $('.simple_stock_management_status').prop('disabled', true);

        setTimeout(function () {
            $('.additional-info').unblock();
            productAttributesTab.show()
        }, 2000);


    } else {
        iziToast.error({
            message: 'Please Fill All The Fields',
        });
    }
});

$(document).on('click', '.save-variant-general-settings', function (e) {
    e.preventDefault();
    if ($('.variant_stock_status').is(":checked")) {
        if ($('.variant-stock-level-type').filter(function () {
            return this.value === '';
        }).length === 0 && $.trim($('.variant-stock-level-type').val()) != "") {

            if ($('.variant-stock-level-type').val() == 'product_level' && $('.variant-stock-mustfill-field').filter(function () {
                return this.value === '';
            }).length !== 0) {
                iziToast.error({
                    message: 'Please Fill All The Fields',
                });
            } else {
                $('input[name="product_type"]').val($('#product-type').val());
                $('input[name="variant_stock_level_type"]').val($('#stock_level_type').val());
                $('input[name="variant_stock_status"]').val("0");
                $('#product-type').prop('disabled', true);
                $('#stock_level_type').prop('disabled', true);
                $(this).removeClass('save-variant-general-settings');
                $('.product-attributes').removeClass('disabled');
                $('.product-variants').removeClass('disabled');
                $('.variant-stock-level-type').prop('readonly', true);
                $('#stock_status_variant_type').attr('readonly', true);
                $('.variant-product-level-stock-management').find('input,select').prop('readonly', true);
                $('#product-variants-tab').removeClass('d-none');
                $('.variant_stock_status').prop('disabled', true);

                productAttributesTab.show();

                Swal.fire('Settings Saved !', 'Attributes & Variations Can Be Added Now', 'success');
            }
        } else {
            iziToast.error({
                message: 'Please Fill All The Fields',
            });
        }

    } else {

        $('input[name="product_type"]').val($('#product-type').val());
        $('input[name="variant_stock_status"]').val("");
        $('input[name="variant_stock_level_type"]').val("");
//        $('#product-tab a[href="#product-attributes"]').tab('show');
        productAttributesTab.show();

        $('.variant_stock_status').prop('disabled', true);
        $('#product-type').prop('disabled', true);
        $('.product-attributes').removeClass('disabled');
        $('.product-variants').removeClass('disabled');
        $('#product-variants-tab').removeClass('d-none');
        Swal.fire('Settings Saved !', 'Attributes & Variations Can Be Added Now', 'success');
    }

});
$(document).on('change', '.new-added-variant', function () {

    var myOpts = $(this).children().map(function () {
        return $(this).val();
    }).get();
    var variant_id = $(this).val();
    var curr_vals = [];
    var $variant_ids = $(this).closest('.product-variant-selectbox').find('input[name="variants_ids[]"]').val();
    $.each($variant_ids.split(','), function (key, val) {
        if (val != '') {
            curr_vals[key] = $.trim(val);
        }
    });
    var newvalues = curr_vals.filter((el) => !myOpts.includes(el));
    var len = newvalues.length;
    if (variant_id != '') {
        newvalues[len] = $.trim(variant_id);
    }
    $(this).closest('.product-variant-selectbox').find('input[name="variants_ids[]"]').val(newvalues.toString());
});

