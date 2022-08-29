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
                                <h5 class="card-title"><i class="fa-solid fa-rectangle-list"></i> Formulário</h5>
                            </div>
                            <div class="col-md-6 text-end align-self-center align-middle">
                                <a href="/admin/partner" class="btn btn-primary btn-sm"><i class="fa-solid fa-list"></i> Listar</a>
                            </div>
                        </div>
                        <form action="<?= $action; ?>" method="POST" enctype="multipart/form-data" data-module="<?= $page_controller; ?>">
                            <input type="hidden" name="<?= $csrf_token; ?>" value="<?= $csrf_hash; ?>" />
                            <input type="hidden" name="id" value="<?= $page_list['id']; ?>" />

                            <div class="row mb-3">
                                <label for="title" class="col-sm-2 col-form-label">Titúlo <span class='text-danger text-xs'>*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name" id="name" value="<?= $page_list['name']; ?>" placeholder="" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="link" class="col-sm-2 col-form-label">Link <span class='text-danger text-xs'>*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="link" id="link" value="<?= $page_list['link']; ?>">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="name" class="col-sm-2 col-form-label">Imagem <span class='text-danger text-xs'>*</span></label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <button
                                            type="button"
                                            class="btn btn-secondary btn-sm"
                                            data-input="image"
                                            data-isremovable="1"
                                            data-is-multiple-uploads-allowed="0"
                                            data-bs-toggle="modal"
                                            data-bs-target="#media-upload-modal">Selecionar Arquivo</button>
                                        <label class="text-danger mt-3 small">*Escolha apenas quando a atualização for necessária</label>
                                        <?=
                                        mediaList('image', $page_list['image'],
                                            true);
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="name" class="col-sm-2 col-form-label">Imagem Mobile</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <button
                                            type="button"
                                            class="btn btn-secondary btn-sm"
                                            data-input="imageMobile"
                                            data-isremovable="1"
                                            data-is-multiple-uploads-allowed="0"
                                            data-bs-toggle="modal"
                                            data-bs-target="#media-upload-modal">Selecionar Arquivo</button>
                                        <label class="text-danger mt-3 small">*Escolha apenas quando a atualização for necessária</label>
                                        <?=
                                        mediaList('image',
                                            $page_list['imageMobile'], true);
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="statusCode" class="col-form-label col-sm-2">Situação</label>
                                <div class="col-sm-10">
                                    <?php
                                    $option = [
                                        'publish' => 'Publicado',
                                        'draft'   => 'Rascunho',
                                    ];

                                    echo form_dropdown('statusCode', $option,
                                        $page_list['statusCode'],
                                        'class="form-select"');
                                    ?>
                                </div>
                            </div>

                            <div class="form-group text-end">
                                <button type="submit" class="btn btn-primary btn-sm" id="submit_btn"><i class="fa-solid fa-floppy-disk"></i> Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<!-- ======= END MAIN ======= -->