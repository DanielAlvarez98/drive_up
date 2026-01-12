<div class="modal fade text-left" id="editPerModal" tabindex="-1" aria-labelledby="myModalLabel1" style="display: none;"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel1">Editar</h5>
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form class="form form-vertical" role="form" id="editDocForm" method="POST" action=""
                    enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="contact-info-vertical">Tipo de documento</label>

                                    <select class="form-select" id="tipoDocumento" name="tipo" required>
                                        <option value="1">Personal</option>
                                        {{-- <option value="2">Vehicular</option> --}}
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="email-id-vertical">Nombre del documento</label>
                                    <input type="text" id="dname" class="form-control name" name="name"
                                        placeholder="Nombre" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="contact-info-vertical">N°</label>
                                    <input type="number" id="dlicen" class="form-control licen" name="licen"
                                        placeholder="N°">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="password-vertical">Categoria</label>
                                    <input type="number" id="dcategoria" class="form-control categoria"
                                        name="categoria" placeholder="Categoria">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="password-vertical">Fecha de emisión</label>
                                    <input type="date" id="dfecEmit" class="form-control fecEmit"
                                        max="{{ date('Y-m-d') }}" name="fecEmit" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="password-vertical">Fecha de renovacion</label>
                                    <input type="date" id="dfecRenov" class="form-control fecRenov"
                                        min="{{ date('Y-m-d') }}" name="fecRenov" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <input type="file" id="imagenEdit" name="imagen">
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                            <button type="button" class="btn btn-light-secondary me-1 mb-1" data-bs-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                Close
                            </button>
                        </div>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
