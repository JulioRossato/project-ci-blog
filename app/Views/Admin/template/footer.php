</div>
</div>




<!-- Modal Media -->
<div class="modal fade" id="media-upload-modal" tabindex="-1" aria-labelledby="modalMidiaLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalMidiaLabel">Galeria de mídia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type='hidden' name='media_type' id='media_type' value='image'>
                <input type='hidden' name='current_input'>
                <input type='hidden' name='remove_state'>
                <input type='hidden' name='multiple_images_allowed_state'>
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
                                    <div id="toolbar">
                                        <button id="upload-media" class="btn btn-success">
                                            <i class="fa-solid fa-check"></i> Escolher Mídia
                                        </button>
                                    </div>
                                    <table class="table table-hover"
                                           id="media-upload-table"
                                           data-locale="pt-BR"
                                           data-toggle="table"
                                           data-toolbar="#toolbar"
                                           data-buttons="buttons"
                                           data-buttons-class="primary"
                                           data-buttons-align="right"
                                           data-search="true"
                                           data-show-refresh="true"
                                           data-show-toggle="true"
                                           data-show-columns="true"
                                           data-show-columns-search="true"
                                           data-show-columns-toggle-all="true"
                                           data-show-pagination-switch="true"
                                           data-minimum-count-columns="3"
                                           data-show-pagination-switch="true"
                                           data-pagination="true"
                                           data-page-list="[10, 25, 50, 100, all]"
                                           data-side-pagination="server"
                                           data-total-field="total"
                                           data-data-field="rows"
                                           data-url="/admin/media/dataresult"
                                           data-checkbox-header="false"
                                           data-click-to-select="true"
                                           data-query-params="mediaParams"
                                           >
                                        <thead>
                                            <tr>
                                                <th data-field="state" data-checkbox="true"></th>
                                                <th data-field="image" data-sortable="false">IMAGEM</th>
                                                <th data-field="id" data-sortable="true" data-visible="false">ID</th>
                                                <th data-field="title" data-sortable="true">TITULO</th>
                                                <th data-field="extension" data-sortable="true">EXTENSÃO</th>
                                                <th data-field="type" data-sortable="true" data-visible="false">TIPO</th>
                                                <th data-field="size" data-sortable="true" data-visible="false">TAMANHO</th>
                                                <th data-field="createdAt" data-sortable="true" data-visible="false">CRIADO EM</th>
                                                <th data-field="updatedAt" data-sortable="true" data-visible="false">ATUALIZADO EM</th>
                                                <th data-field="link" data-sortable="true" data-visible="false">LINK</th>
                                                <th data-field="subDirectory" data-sortable="true">DIRETORIO</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>





<script src="/node_modules/jquery/dist/jquery.min.js"></script>
<script src="/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="/node_modules/izitoast/dist/js/iziToast.min.js"></script>
<script src="/node_modules/@yaireo/tagify/dist/tagify.min.js"></script>
<script src="/node_modules/bootstrap-table/dist/bootstrap-table.min.js"></script>
<script src="/node_modules/dropzone/dist/dropzone-min.js"></script>
<script src="/node_modules/jstree/dist/jstree.js"></script>
<script src="/node_modules/select2/dist/js/select2.min.js"></script>
<script src="/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
<script src="/node_modules/jquery-blockui/jquery.blockUI.js"></script>
<script src="/node_modules/jquery-ui-sortable-npm/jquery-ui-sortable.min.js"></script>


<!-- Template Main JS File -->
<script src="/assets/Admin/js/main.js"></script>

<!-- Template Custom JS File -->
<script src="/assets/Admin/js/custom.js?v=<?= md5(date("Ymdhis")); ?>"></script>

<!-- Template Modules JS File -->
<script src="/assets/Admin/modules/<?= esc($page_controller); ?>.js?v=<?= md5(date("Ymdhis")); ?>"></script>





</body>
</html>