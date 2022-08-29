<?php

function createUniqueSlug($string, $table, $field = 'slug', $key = NULL,
                          $value = NULL)
{
    $db = db_connect();

    $slug           = removeAccents($string);
    $slug           = url_title($slug);
    $slug           = strtolower($slug);
    $i              = 0;
    $params         = array();
    $params[$field] = $slug;

    if ($key) $params["$key !="] = $value;


    while ($db->table($table)->where($params)->get()->getNumRows()) {
        if (!preg_match('/-{1}[0-9]+$/', $slug)) $slug           .= '-'.++$i;
        else $slug           = preg_replace('/[0-9]+$/', ++$i, $slug);
        $params[$field] = $slug;
    }
    return $slug;
}

function allowedMediaTypes()
{
    $config  = config('AppSettings');
    $type    = $config->filesAllowed;
    $general = [];
    foreach ($type as $main_type => $extenstions) {
        $general = array_merge_recursive($general, $extenstions);
    }
    return $general;
}

function findMediaType($extenstion)
{
    $config = config('AppSettings');
    $type   = $config->fileType;
    foreach ($type as $main_type => $extenstions) {
        foreach ($extenstions['types'] as $k => $v) {
            if ($v === strtolower($extenstion)) {
                return array($main_type, $extenstions['icon']);
            }
        }
    }
    return false;
}

function isImage($path)
{
    $config = config('AppSettings');
    $type   = $config->filesAllowed;

    $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
    if (in_array($ext, $type['image'])):
        return true;
    endif;
    return false;
}

function getSettings($type = 'system_settings', $is_json = false)
{
    $SettingsModel = new \App\Models\SettingsModel();
    $res           = $SettingsModel->where('variable', $type)->asArray()->first();
    if (!empty($res)):
        if ($is_json):
            return json_decode($res['value'], true);
        else:
            return outputEscaping($res['value']);
        endif;
    endif;
}

function escapeArray($array)
{
    $db    = db_connect();
    $posts = null;
    if (!empty($array)):
        if (is_array($array)):
            foreach ($array as $key => $value):
                $posts[$key] = escapeArray($value);
            endforeach;
        else:
            return (!is_null($array)) ? $db->escape($array) : null;
        endif;
    endif;
    return $posts;
}

function outputEscaping($array)
{
    if (!empty($array)):
        if (is_array($array)):
            $data = array();
            foreach ($array as $key => $value):
                $data[$key] = stripcslashes($value);
            endforeach;
            return $data;
        elseif (is_object($array)) :
            $data = new stdClass();
            foreach ($array as $key => $value):
                $data->$key = stripcslashes($value);
            endforeach;
            return $data;
        else:
            return stripcslashes($array);
        endif;
    endif;
}

function imageExists($file_path = '')
{
    if (empty($file_path)):
        return IMG_404;
    endif;

    if (!file_exists(FCPATH.$file_path)):
        return IMG_404;
    endif;

    if (!isImage($file_path)):
        return IMG_404;
    endif;

    return base_url($file_path);
}

function postContent($string = '')
{
    if ($string != strip_tags($string)):
        $string = strip_tags($string, '<a><p><b><strong><img><br>');
        $string = trim($string);
        $string = str_replace("\r\n", "<br>", $string);

    else:
        $string  = str_replace("\r\n", "<br>", $string);
        $explode = explode('<br><br>', $string);
        if (count($explode)):
            $html = '';
            foreach ($explode as $p) :
                if (empty($p)):
                    continue;
                endif;
                $html .= "<p>".$p."</p><br>\n";
            endforeach;
            $string = $html;
        endif;
    endif;

    $subst  = '';
    $regex  = '/\[gallery ids=\".*?\]/m';
    $result = preg_replace($regex, $subst, $string);

    return $result;
}

function postDatetime($Datetime, $minify = false, $locale = "pt-br")
{
    $format = '%A, %d de %B de %Y - %H:%M';

    if ($minify && $locale == "pt-br"):
        $format = '%d/%m/%Y %H:%M';
    endif;

    if ($minify && $locale == "en"):
        $format = '%Y-%m-%d %H:%M';
    endif;

    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    date_default_timezone_set('America/Sao_Paulo');
    return utf8_encode(strftime($format, strtotime($Datetime)));
}

function isJSON($string)
{
    return is_string($string) && is_array(json_decode($string, true)) && (json_last_error()
        == JSON_ERROR_NONE) ? true : false;
}

function mediaList($input_name = 'inputName', $image_path = null,
                   $is_removable = true)
{

    if (isJSON($image_path)):
        $image_list = json_decode($image_path, true);
        $multiple   = true;
    else:
        $image_list = [$image_path];
        $multiple   = false;
    endif;

    $html           = '';
    $imageInputName = $input_name;
    if (!empty($image_list) && is_array($image_list) && array_filter($image_list)) :
        $html .= '<div class="row image-upload-section my-3">';
        foreach ($image_list as $img_k => $img_v):
            if ($multiple):
                $nameFile = $imageInputName.'['.$img_k.']';
            else:
                $nameFile = $imageInputName;
            endif;
            $html .= '<div class="col-md-3 p-2 text-center shadow bg-white image">';
            $html .= '<input type="hidden" name="'.$nameFile.'" value="'.$img_v.'">';
            $html .= '<div class="image-upload-div">';

            $icon = findMediaType(pathinfo($img_v, PATHINFO_EXTENSION));

            if (empty($icon)):
                $fileView = imageExists();
            elseif ($icon[0] == 'image'):
                $fileView = imageExists($img_v);
            else:
                $fileView = imageExists($icon[1]);
            endif;

            $html .= '<img class="img-fluid mb-2" src="'.$fileView.'" >';

            $html .= '</div>';
            if ($is_removable == true):
                $html .= '<button type="button" class="remove-image btn btn-sm btn-danger rounded-0 mt-3">Remover</button> ';
            endif;
            $html .= '</div>';
        endforeach;
        $html .= '</div>';
    else:
        $html .= '<div class = "row image-upload-section my-3"></div>';
    endif;

    return $html;
}

function removeAccents($string)
{
    $a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í',
        'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý',
        'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í',
        'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ',
        'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď',
        'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ',
        'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ',
        'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ',
        'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō',
        'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ',
        'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū',
        'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź',
        'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ',
        'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ',
        'Ǿ', 'ǿ');
    $b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I',
        'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U',
        'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i',
        'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y',
        'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c',
        'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G',
        'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i',
        'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L',
        'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O',
        'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's',
        'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U',
        'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z',
        'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i',
        'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE',
        'ae', 'O', 'o');
    return str_replace($a, $b, $string);
}

function limitText($string, $limit)
{
    $contador = strlen($string);
    if ($contador >= $limit) {
        $string = substr($string, 0, strrpos(substr($string, 0, $limit), ' ')).'...';
        return $string;
    } else {
        return $string;
    }
}

function convertImage($path = "")
{
    $fileBrand = str_replace("/media/", "/_media/", $path);
    $fileBrand = str_replace(".png", ".webp", $fileBrand);
    $fileBrand = str_replace(".jpeg", ".webp", $fileBrand);
    $fileBrand = str_replace(".jpg", ".webp", $fileBrand);

    if (file_exists(FCPATH.$fileBrand)):
        return imageExists($fileBrand);
    endif;

    $fileBrand = FCPATH.$fileBrand;
    $pathInfo  = pathinfo($fileBrand);

    if (!is_dir($pathInfo['dirname'])):
        mkdir($pathInfo['dirname'], 0777, true);
    endif;

    return imageExists($fileBrand);
}

function minifyRender($buffer)
{

    $search = array(
        '/\n/', // replace end of line by a <del>space</del> nothing , if you want space make it down ' ' instead of ''
        '/\>[^\S]+/s', // strip whitespaces after tags, except space
        '/[^\S]+\</s', // strip whitespaces before tags, except space
        '/(\s)+/s', // shorten multiple whitespace sequences
        '/<!--(.|\s)*?-->/' //remove HTML comments
    );

    $replace = array(
        '',
        '>',
        '<',
        '\\1',
        ''
    );

    $buffer = preg_replace($search, $replace, $buffer);
    return $buffer;
}

function dump($value = null)
{
    echo "<pre>";
    print_r($value);
    die;
}

function getImageUrl($path, $image_type = '', $image_size = '',
                     $file_type = 'image')
{
    $path         = explode('/', $path);
    $subdirectory = '';
    for ($i = 0; $i < count($path) - 1; $i++) {
        $subdirectory .= $path[$i].'/';
    }
    $image_name = end($path);

    $file_main_dir  = FCPATH.$subdirectory;
    $image_main_dir = base_url().$subdirectory;
    if ($file_type == 'image') {
        $types = ['thumb', 'cropped'];
        $sizes = ['md', 'sm'];
        if (in_array(trim(strtolower($image_type)), $types) && in_array(trim(strtolower($image_size)),
                $sizes)) {
            $filepath  = $file_main_dir.$image_type.'-'.$image_size.'/'.$image_name;
            $imagepath = $image_main_dir.$image_type.'-'.$image_size.'/'.$image_name;
            if (file_exists($filepath)) {
                return $imagepath;
            } else if (file_exists($file_main_dir.$image_name)) {
                return $image_main_dir.$image_name;
            } else {
                return base_url().NO_IMAGE;
            }
        } else {
            if (file_exists($file_main_dir.$image_name)) {
                return $image_main_dir.$image_name;
            } else {
                return base_url().NO_IMAGE;
            }
        }
    } else {
        $file = new SplFileInfo($file_main_dir.$image_name);
        $ext  = $file->getExtension();

        $media_data        = find_media_type($ext);
        $image_placeholder = $media_data[1];
        $filepath          = FCPATH.$image_placeholder;
        $extensionpath     = base_url().$image_placeholder;
        if (file_exists($filepath)) {
            return $extensionpath;
        } else {
            return base_url().NO_IMAGE;
        }
    }
}
