<!-- ======= MAIN ======= -->
<main id="main" class="main">

    <div class="pagetitle">
        <h1><?= $page_title; ?></h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Home</li>
                <li class="breadcrumb-item"><?= $page_module; ?></li>
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
                                <a href="/admin/post" class="btn btn-primary btn-sm"><i class="fa-solid fa-list"></i> Listar</a>
                            </div>
                        </div>
                        <form action="<?= $action; ?>" method="POST" enctype="multipart/form-data" data-module="<?= $page_controller; ?>" autocomplete="off">
                            <input type="hidden" name="<?= $csrf_token; ?>" value="<?= $csrf_hash; ?>" />
                            <input type="hidden" name="id" value="<?= $page_list['id']; ?>" />

                            <div class="row mb-3">
                                <label for="title" class="col-sm-2 col-form-label">Títutlo <span class='text-danger text-xs'>*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="title" id="title" value="<?= $page_list['title']; ?>" placeholder="" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="shortDescription" class="col-sm-2 col-form-label">Resumo <span class='text-danger text-xs'>*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="shortDescription" id="shortDescription" value="<?= $page_list['shortDescription']; ?>" placeholder="" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="content" class="col-sm-2 col-form-label">Conteúdo</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control editor" name="content" id="content"><?= ($page_list['content']); ?></textarea>
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label for="categoryId" class="col-form-label col-sm-2">Categoria</label>
                                <div class="col-sm-10">
                                    <?=
                                    form_dropdown('categoryId', $category_list,
                                        $page_list['categoryId'],
                                        'class="form-select select2" required');
                                    ?>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="tags" class="col-sm-2 col-form-label">Tags</label>
                                <div class="col-sm-10">
                                    <textarea name="tags" id="tags" class="form-control tags" cols="30" rows="5"><?= $page_list['tags']; ?></textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="videoType" class="col-form-label col-sm-2">Tipo de vídeo</label>
                                <div class="col-sm-10">
                                    <?php
                                    $option = [
                                        ''            => 'Não disponível',
                                        'vimeo'       => 'Vimeo',
                                        'youtube'     => 'YouTube',
                                        'self_hosted' => 'Auto-hospedado',
                                    ];

                                    echo form_dropdown('videoType', $option,
                                        $page_list['videoType'],
                                        'class="form-select select2"');
                                    ?>
                                </div>
                            </div>

                            <div class="row mb-3 <?=
                            (in_array($page_list['videoType'], [''])) ? "d-none"
                                    : "";
                            ?> videoLink">
                                <label for="video" class="col-sm-2 col-form-label">Link do vídeo<span class='text-danger text-xs'>*</span></label>
                                <div class="col-sm-10 <?=
                                (in_array($page_list['videoType'],
                                    ['', 'self_hosted'])) ? "d-none" : "";
                                ?>" id="video_link_container">
                                    <input type="text" class="form-control" name="video" id="video" value="<?= $page_list['video']; ?>" placeholder="https://...">
                                </div>
                                <div class="col-sm-10 <?=
                                (in_array($page_list['videoType'],
                                    ['', 'youtube', 'vimeo'])) ? "d-none" : "";
                                ?>" id="video_media_container">
                                    <div class="form-group ">
                                        <button
                                            type="button"
                                            class="btn btn-secondary btn-sm"
                                            data-input="inputVideo"
                                            data-isremovable="1"
                                            data-is-multiple-uploads-allowed="0"
                                            data-media_type="video"
                                            data-bs-toggle="modal"
                                            data-bs-target="#media-upload-modal">Selecionar Arquivo</button>
                                        <label class="text-danger mt-3 small">*Escolha apenas quando a atualização for necessária</label>
                                        <?=
                                        mediaList('inputVideo',
                                            $page_list['video'], true);
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="type" class="col-sm-2 col-form-label">Tipo</label>
                                <div class="col-sm-10">
                                    <?php
                                    $option = [
                                        'post'    => 'Postagem',
                                        'video'   => 'Vídeo',
                                        'gallery' => 'Galeria',
                                    ];

                                    echo form_dropdown('type', $option,
                                        $page_list['type'],
                                        'class="form-select select2" required');
                                    ?>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="image" class="col-sm-2 col-form-label">Capa <span class='text-danger text-xs'>*</span></label>
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
                                <label for="gallery" class="col-sm-2 col-form-label">Galeria</label>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="form-group">
                                            <button
                                                type="button"
                                                class="btn btn-secondary btn-sm"
                                                data-input="gallery[]"
                                                data-isremovable="1"
                                                data-is-multiple-uploads-allowed="1"
                                                data-bs-toggle="modal"
                                                data-bs-target="#media-upload-modal">Selecionar Arquivo</button>
                                            <label class="text-danger mt-3 small">*Escolha apenas quando a atualização for necessária</label>
                                            <?=
                                            mediaList('gallery',
                                                $page_list['gallery'], true);
                                            ?>
                                        </div>
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
                                        'class="form-select select2"');
                                    ?>
                                </div>
                            </div>

                            <div class="form-group text-end">
                                <button type="submit" class="btn btn-primary btn-sm" id="submit_btn"><i class="fa-solid fa-floppy-disk me-2"></i> Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<!-- ======= END MAIN ======= -->