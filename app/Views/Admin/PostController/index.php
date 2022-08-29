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
                                <h5 class="card-title"><i class="fa-solid fa-slist"></i> Lista de Categorias</h5>
                            </div>
                            <div class="col-md-6 text-end align-self-center align-middle">
                                <a href="/admin/post/add" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus"></i> Cadastrar</a>
                            </div>
                        </div>
                        <div class="w-100" id="view-table">
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
                                        <th data-field="image" data-sortable="false" data-visible="true" data-width="100">CAPA</th>
                                        <th data-field="id" data-sortable="true" data-visible="false">ID</th>
                                        <th data-field="title" data-sortable="true">TITÚLO</th>
                                        <th data-field="statusCode" data-sortable="true" data-visible="false">statusCode</th>
                                        <th data-field="createdAt" data-sortable="true" data-visible="false">CRIADO EM</th>
                                        <th data-field="updatedAt" data-sortable="true" data-visible="false">ATUALIZADO EM</th>
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