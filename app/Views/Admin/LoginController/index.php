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

        <!-- FontAwesome CSS -->
        <link href="/node_modules/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />

        <!-- Toastr CSS -->
        <link href="/node_modules/izitoast/dist/css/iziToast.min.css" rel="stylesheet" />

        <!-- Template Main CSS File -->
        <link href="/assets/Admin/css/style.css" rel="stylesheet">

        <!-- Google Fonts -->
        <link href="https://fonts.gstatic.com" rel="preconnect">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

        <script type="text/javascript">
            base_url = "<?= site_url() ?>";
            csrf_header = "<?= esc($csrf_header); ?>";
            csrf_token = "<?= esc($csrf_token); ?>";
            csrf_hash = "<?= esc($csrf_hash); ?>";
            page_controller = "<?= esc($page_controller); ?>";

            var onloadCallback = function () {
                if ($('#gr-login').length) {
                    widgetId2 = grecaptcha.render('gr-login', {
                        'sitekey': '<?= env('RECAPTCHA_SITEKEY'); ?>',
                        'theme': 'light'
                    });
                }
            };
        </script>

    </head>

    <body>

        <main>
            <div class="container">

                <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                                <div class="d-flex justify-content-center py-4">
                                    <a href="index.html" class="logo d-flex align-items-center w-auto">
                                        <span class="d-none d-lg-block text-center">Painel do administrador</span>
                                    </a>
                                </div><!-- End Logo -->

                                <div class="card mb-3">

                                    <div class="card-body">

                                        <div class="pt-4 pb-2">
                                            <h5 class="card-title text-center pb-0 fs-4">Faça login na sua conta</h5>
                                            <p class="text-center small">Digite seu e-mail e senha para entrar</p>
                                        </div>

                                        <form action="<?= $action; ?>" method="POST" class="row g-3 needs-validation" novalidate data-module="<?= $page_controller; ?>">
                                            <input type="hidden" name="<?= $csrf_token; ?>" value="<?= $csrf_hash; ?>" />

                                            <div class="col-12">
                                                <label for="yourEmail" class="form-label">E-mail</label>
                                                <div class="input-group has-validation">
                                                    <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-at"></i></span>
                                                    <input type="email" name="email" class="form-control" id="yourEmail" required>
                                                    <div class="invalid-feedback">Por favor insira seu e-mail de usuário.</div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <label for="yourPassword" class="form-label">Senha</label>
                                                <div class="input-group has-validation">
                                                    <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-key"></i></span>
                                                    <input type="password" name="password" class="form-control" id="yourPassword" required>
                                                    <div class="invalid-feedback">Por favor insira sua senha.</div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="mb-3 text-center d-flex justify-content-center align-content-center text-center">
                                                    <div id="gr-login"></div>
                                                </div>
                                            </div>


                                            <div class="col-12">
                                                <button class="btn btn-primary w-100" type="submit">Acessar</button>
                                            </div>

                                        </form>

                                    </div>
                                </div>

                                <div class="credits">
                                    Designed by <a href="https://juliorossato.com.br/">Júlio Rossato</a>
                                </div>

                            </div>
                        </div>
                    </div>

                </section>

            </div>
        </main><!-- End #main -->

        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="fa-solid fa-arrow-up-long"></i></a>

        <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
        <script src="/node_modules/jquery/dist/jquery.min.js"></script>
        <script src="/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="/node_modules/izitoast/dist/js/iziToast.min.js"></script>
        <script src="/assets/Admin/js/main.js"></script>
        <!-- Template Modules JS File -->
        <script src="/assets/Admin/modules/<?= $page_controller; ?>.js"></script>


    </body>
</html>