<!-- ======= MAIN ======= -->
<main id="main" class="main">

    <div class="pagetitle">
        <h1><?= $page_title; ?></h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Home</li>
                <li class="breadcrumb-item active"><?= $page_title; ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-5">
                            <div class="col-md-6 align-self-center align-middle">
                                <h5 class="card-title"><i class="fa-solid fa-slist"></i> Mensagens que você recebeu através do site</h5>
                            </div>
                            <div class="col-md-6 text-end align-self-center align-middle">
                                <a href="/admin/contact" class="btn btn-primary btn-sm"><i class="fa-solid fa-list"></i> Listar</a>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-12">
                                <h5><?= $page_list['subject']; ?></h5>
                                <br>
                                <strong>Nome:</strong> <?= esc($page_list['name']); ?></span><br>
                                <strong>Fone:</strong> <?= esc($page_list['phone']); ?></span><br>
                                <strong>E-mail:</strong> <?= esc($page_list['email']); ?></span><br>
                                <br>
                                <strong>Mensagem:</strong>
                                <br>
                                <br>
                                <pre class="bg-light p-3 shadow"><?= esc($page_list['message']); ?></pre>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<!-- ======= END MAIN ======= -->