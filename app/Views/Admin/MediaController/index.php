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
                        <div class="col-md-12 mt-3 mb-3">
                            <!-- Change /upload-target to your upload address -->
                            <div id="dropzone" class="dropzone"></div>
                            <br>
                            <a href="" id="upload-files-btn" class="btn btn-success float-end"><i class="fa-solid fa-upload"></i> Upload</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">

                <div class="card">
                    <div class="card-body">
                        <div class="row mb-5">
                            <div class="col-12">
                                <h5 class="card-title">Detalhes das mídias</h5>
                            </div>
                        </div>
                        <div class="w-100">
                            <table class="table table-hover"
                                   id="table"
                                   data-locale="pt-BR"
                                   data-toggle="table"
                                   data-buttons="buttons"
                                   data-buttons-class="primary"
                                   data-buttons-align="right"
                                   data-search="true"
                                   data-show-refresh="true"
                                   data-show-toggle="true"
                                   data-show-fullscreen="true"
                                   data-show-columns="true"
                                   data-show-columns-search="true"
                                   data-show-columns-toggle-all="true"
                                   data-show-pagination-switch="true"
                                   data-show-export="true"
                                   data-minimum-count-columns="3"
                                   data-show-pagination-switch="true"
                                   data-pagination="true"
                                   data-page-list="[10, 25, 50, 100, all]"
                                   data-side-pagination="server"
                                   data-total-field="total"
                                   data-data-field="rows"
                                   data-url="<?= $action_result; ?>">
                                <thead>
                                    <tr>
                                        <th data-field="image" data-sortable="false">IMAGEM</th>
                                        <th data-field="id" data-sortable="true" data-visible="false">ID</th>
                                        <th data-field="title" data-sortable="true">TITULO</th>
                                        <th data-field="extension" data-sortable="true">EXTENSÃO</th>
                                        <th data-field="type" data-sortable="true" data-visible="false">TIPO</th>
                                        <th data-field="size" data-sortable="true" data-visible="false">TAMANHO</th>
                                        <th data-field="createdAt" data-sortable="true" data-visible="false">CRIADO EM</th>
                                        <th data-field="updatedAt" data-sortable="true" data-visible="false">ATUALIZADO EM</th>
                                        <th data-field="link" data-sortable="true" data-visible="false">LINK</th>
                                        <th data-field="subDirectory" data-sortable="true" data-visible="false">DIRETORIO</th>
                                        <th data-field="menu" data-events="operateEvents" class="text-center">MENU</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<!-- ======= END MAIN ======= -->