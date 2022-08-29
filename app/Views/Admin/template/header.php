<!doctype html>
<html lang="pt-br">
    <head>
        <title><?= esc($web_title); ?></title>

        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Security X-CSRF-TOKEN -->
        <meta name="<?= esc($csrf_token); ?>" content="<?= esc($csrf_hash); ?>">

        <!-- Bootstrap CSS -->
        <link href="/node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />

        <!-- Bootstrap Icon CSS -->
        <link href="/node_modules/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />

        <!-- Bootstrap table CSS -->
        <link href="/node_modules/bootstrap-table/dist/bootstrap-table.min.css" rel="stylesheet" />

        <!-- FontAwesome CSS -->
        <link href="/node_modules/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />

        <!-- Tagify CSS -->
        <link href="/node_modules/@yaireo/tagify/dist/tagify.css" rel="stylesheet" />

        <!-- Toastr CSS -->
        <link href="/node_modules/izitoast/dist/css/iziToast.min.css" rel="stylesheet" />

        <!-- Tree CSS -->
        <link href="/node_modules/jstree/dist/themes/default/style.min.css" rel="stylesheet" />

        <!-- Dropzone CSS -->
        <link href="/node_modules/dropzone/dist/dropzone.css" rel="stylesheet" />

        <!-- Select2 CSS -->
        <link href="/node_modules/select2/dist/css/select2.min.css" rel="stylesheet" />
        <link href="/node_modules/select2-bootstrap-5-theme/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />

        <!-- Template Main CSS File -->
        <link href="/assets/Admin/css/style.css" rel="stylesheet">


        <script type="text/javascript">
            base_url = "<?= base_url() ?>";
            site_url = "<?= site_url() ?>";
            csrf_header = "<?= esc($csrf_header); ?>";
            csrf_token = "<?= esc($csrf_token); ?>";
            csrf_hash = "<?= esc($csrf_hash); ?>";
            page_controller = "<?= esc($page_controller); ?>";
        </script>


    </head>
    <body>
