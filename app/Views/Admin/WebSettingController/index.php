<!-- ======= MAIN ======= -->
<main id="main" class="main">

    <div class="pagetitle">
        <h1><?= esc($page_title); ?></h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Home</li>
                <li class="breadcrumb-item active"><?= esc($page_title); ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="<?= $action; ?>" method="POST" enctype="multipart/form-data" data-module="WebSettingController">
                            <input type="hidden" name="<?= $csrf_token; ?>" value="<?= $csrf_hash; ?>" />

                            <div class="row mb-5">
                                <div class="col-12">
                                    <h5 class="card-title"><i class="fa-solid fa-globe"></i> Web Site</h5>
                                </div>
                                <div class="mb-4 col-md-4">
                                    <label class="form-label" for="site_title">Título do Site <span class='text-danger text-xs'>*</span></label>
                                    <input type="text" class="form-control" name="site_title" value="<?= @$web_setting['site_title']; ?>" placeholder="Título do prefixo para o site" required>
                                </div>
                                <div class="mb-4 col-md-4">
                                    <label class="form-label" for="support_number">Número de suporte <span class='text-danger text-xs'>*</span></label>
                                    <input type="tel" class="form-control" name="support_number" value="<?= @$web_setting['support_number']; ?>" placeholder="Número de celular de suporte ao cliente" required>
                                </div>
                                <div class="mb-4 col-md-4">
                                    <label class="form-label" for="support_email">E-mail de suporte <span class='text-danger text-xs'>*</span></label>
                                    <input type="email" class="form-control" name="support_email" value="<?= @$web_setting['support_email']; ?>" placeholder="E-mail de suporte ao cliente"  required>
                                </div>
                                <div class="mb-4 col-md-6">
                                    <label class="form-label" for="author">Nome do author <span class='text-danger text-xs'>*</span></label>
                                    <input name="author" id="author" class="form-control" value="<?= @$web_setting['author']; ?>" required>
                                </div>
                                <div class="mb-4 col-md-6">
                                    <label class="form-label" for="copyright_details">Detalhes de direitos autorais <span class='text-danger text-xs'>*</span></label>
                                    <input name="copyright_details" id="copyright_details" class="form-control" value="<?= @$web_setting['copyright_details']; ?>" required>
                                </div>
                                <div class="mb-4 col-md-12">
                                    <label class="form-label" for="address">Endereço <span class='text-danger text-xs'>*</span></label>
                                    <textarea name="address" id="address" class="form-control" cols="30" rows="5" required><?= @$web_setting['address']; ?></textarea>
                                </div>
                                <div class="mb-4 col-md-12">
                                    <label class="form-label" for="app_short_description">Pequena Descrição <span class='text-danger text-xs'>*</span></label>
                                    <textarea name="app_short_description" id="app_short_description" class="form-control" cols="30" rows="5" required><?= @$web_setting['app_short_description']; ?></textarea>
                                </div>
                                <div class="mb-4 col-md-12">
                                    <label class="form-label" for="map_iframe">Mapa Iframe</label>
                                    <textarea name="map_iframe" id="map_iframe" class="form-control" cols="30" rows="5"><?= @$web_setting['map_iframe']; ?></textarea>
                                </div>
                                <div class="mb-4 col-md-12">
                                    <label class="form-label" for="support_email">Meta Keywords <span class='text-danger text-xs'>*</span></label>
                                    <textarea name="meta_keywords" id="meta_keywords" class="form-control tags" cols="30" rows="5" required><?= @$web_setting['meta_keywords']; ?></textarea>
                                </div>

                                <div class="mb-4 col-md-12">
                                    <label class="form-label" for="support_email">Meta Description <span class='text-danger text-xs'>*</span></label>
                                    <textarea name="meta_description" id="meta_description" class="form-control" cols="30" rows="5" required><?= @$web_setting['meta_description']; ?></textarea>
                                </div>

                                <div class="mb-4 col-md-12">
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <div class="row">
                                                <label for="name" class="col-sm-3 col-form-label">Logo <span class='text-danger text-xs'>*</span></label>
                                                <div class="col-sm-9">
                                                    <div class="form-group">
                                                        <button
                                                            type="button"
                                                            class="btn btn-secondary btn-sm"
                                                            data-input="logo"
                                                            data-isremovable="1"
                                                            data-is-multiple-uploads-allowed="0"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#media-upload-modal">Selecionar Arquivo</button>
                                                        <label class="text-danger mt-3 small">*Escolha apenas quando a atualização for necessária</label>
                                                        <?=
                                                        mediaList('logo',
                                                            @$web_setting['logo'],
                                                            true);
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <div class="row">
                                                <label for="name" class="col-sm-3 col-form-label">Favicon <span class='text-danger text-xs'>*</span></label>
                                                <div class="col-sm-9">
                                                    <div class="form-group">
                                                        <button
                                                            type="button"
                                                            class="btn btn-secondary btn-sm"
                                                            data-input="favicon"
                                                            data-isremovable="1"
                                                            data-is-multiple-uploads-allowed="0"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#media-upload-modal">Selecionar Arquivo</button>
                                                        <label class="text-danger mt-3 small">*Escolha apenas quando a atualização for necessária</label>
                                                        <?=
                                                        mediaList('favicon',
                                                            @$web_setting['favicon'],
                                                            true);
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row mb-5">
                                <div class="col-12">
                                    <h5 class="card-title"><i class="fa-solid fa-square-share-nodes"></i> Social Media</h5>
                                </div>
                                <div class="mb-4 col-md-6">
                                    <label class="form-label" for="twitter_link">Twitter</label>
                                    <input type="text" class="form-control" name="twitter_link" value="<?= @$web_setting['twitter_link']; ?>" placeholder="Twitter Link" />
                                </div>
                                <div class="mb-4 col-md-6">
                                    <label class="form-label" for="facebook_link">Facebook</label>
                                    <input type="text" class="form-control" name="facebook_link" value="<?= @$web_setting['facebook_link']; ?>" placeholder="Facebook Link" />
                                </div>
                                <div class="mb-4 col-md-6">
                                    <label class="form-label" for="instagram_link">Instagram</label>
                                    <input type="text" class="form-control" name="instagram_link" value="<?= @$web_setting['instagram_link']; ?>" placeholder="Instagram Link" />
                                </div>
                                <div class="mb-4 col-md-6">
                                    <label class="form-label" for="youtube_link">Youtube</label>
                                    <input type="text" class="form-control" name="youtube_link" value="<?= @$web_setting['youtube_link']; ?>" placeholder="Youtube Link" />
                                </div>
                            </div>


                            <div class="row">

                                <div class="col-12">
                                    <h5 class="card-title"><i class="fa-solid fa-rectangle-list"></i> Seção de Recursos</h5>
                                </div>

                                <strong class="mb-2 col-md-12"><i class="fa-solid fa-truck-fast"></i> Frete <hr></strong>
                                <div class="mb-4 col-md-10">
                                    <label class="form-label" for="shipping_title">Título</label>
                                    <input type="text" class="form-control" name="shipping_title" value
                                           ="<?= @$web_setting['shipping_title']; ?>" placeholder
                                           ="Título de envio" />
                                </div>
                                <div class="mb-4 col-md-2 text-center">
                                    <label class="form-label" for="shipping_mode">Situação</label>
                                    <div class="form-check form-switch d-flex justify-content-center">
                                        <input type="checkbox" name="shipping_mode" id="shipping_mode" class="form-check-input" role="switch" <?=
                                        (@$web_setting["shipping_mode"]) ? "checked"
                                                : "";
                                        ?>>
                                    </div>
                                </div>
                                <div class="mb-4 col-md-12">
                                    <label class="form-label" for="shipping_description">Descrição</label>
                                    <textarea name="shipping_description" class="form-control resize" id="shipping_description" cols="30" rows="4" placeholder="Descrição de envio"><?= @$web_setting['shipping_description']; ?></textarea>
                                </div>

                                <strong class="my-2 col-md-12"><i class="fa-solid fa-arrow-rotate-left"></i> Devolução <hr></strong>
                                <div class="mb-4 col-md-10">
                                    <label class="form-label" for="return_title">Título</label>
                                    <input type="text" class="form-control" name="return_title" value="<?= @$web_setting['return_title']; ?>" placeholder="Título de devolução" />
                                </div>
                                <div class="mb-4 col-md-2 text-center">
                                    <label class="form-label" for="return_mode">Situação</label>
                                    <div class="form-check form-switch d-flex justify-content-center">
                                        <input type="checkbox" name="return_mode" id="return_mode" class="form-check-input" role="switch" <?=
                                        (@$web_setting["return_mode"]) ? "checked"
                                                : "";
                                        ?>>
                                    </div>
                                </div>
                                <div class="mb-4 col-md-12">
                                    <label class="form-label" for="return_description">Descrição</label>
                                    <textarea name="return_description" class="form-control" id="return_description" cols="30" rows="4" placeholder="Descrição de devolução"><?= @$web_setting['return_description']; ?></textarea>
                                </div>


                                <strong class="my-2 col-md-12"><i class="fa-solid fa-headset"></i> Suporte <hr></strong>
                                <div class="mb-4 col-md-10">
                                    <label class="form-label" for="support_title">Título</label>
                                    <input type="text" class="form-control" name="support_title" value="<?= @$web_setting['support_title']; ?>" placeholder="título de suporte" />
                                </div>
                                <div class="mb-4 col-md-2 text-center">
                                    <label class="form-label" for="support_mode">Situação</label>
                                    <div class="form-check form-switch d-flex justify-content-center">
                                        <input type="checkbox" name="support_mode" id="support_mode" class="form-check-input" role="switch" <?=
                                        (@$web_setting["support_mode"]) ? "checked"
                                                : "";
                                        ?>>
                                    </div>
                                </div>

                                <div class="mb-4 col-md-12">
                                    <label class="form-label" for="support_description">Descrição</label>
                                    <textarea name="support_description" class="form-control" id="support_description" cols="30" rows="4" placeholder="Descrição de suporte"><?= @$web_setting['support_description']; ?></textarea>
                                </div>

                                <strong class="my-2 col-md-12"><i class="fa-solid fa-lock"></i> Segurança <hr></strong>
                                <div class="mb-4 col-md-10">
                                    <label class="form-label" for="safety_security_title">Título</label>
                                    <input type="text" class="form-control" name="safety_security_title" value="<?= @$web_setting['safety_security_title']; ?>" placeholder="Título de seguraça" />
                                </div>
                                <div class="mb-4 col-md-2 text-center">
                                    <label class="form-label" for="safety_security_mode">Situação</label>
                                    <div class="form-check form-switch d-flex justify-content-center">
                                        <input type="checkbox" name="safety_security_mode" id="safety_security_mode" class="form-check-input" role="switch" <?=
                                        (@$web_setting["safety_security_mode"]) ? "checked"
                                                : "";
                                        ?>>
                                    </div>
                                </div>
                                <div class="mb-4 col-md-12">
                                    <label class="form-label" for="safety_security_description">Descrição</label>
                                    <textarea name="safety_security_description" class="form-control" id="safety_security_description" cols="30" rows="4" placeholder="Descrição de segurança"><?= @$web_setting['safety_security_description']; ?></textarea>
                                </div>
                            </div>

                            <div class="form-group text-end">
                                <button type="submit" class="btn btn-primary" id="submit_btn"><i class="fa-solid fa-floppy-disk"></i> Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<!-- ======= END MAIN ======= -->