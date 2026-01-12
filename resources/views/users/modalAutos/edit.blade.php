<div class="modal fade text-left" id="editCarModal" tabindex="-1" aria-labelledby="myModalLabel1" style="display: none;"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel1">Editar Vehiculo</h5>
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form class="form form-vertical "  method="POST" id="editCarForm"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="first-name-vertical">Marca</label>
                                <input type="text" id="cmarca" class="form-control marca" name="marca"
                                    placeholder="Marca">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="email-id-vertical">Placa</label>
                                <input type="text" id="cplaca" class="form-control placa" name="placa"
                                    placeholder="Placa">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="contact-info-vertical">Año</label>
                                <select class="form-select anhoFab" id="canhoFab" name="anhoFab">
                                    <option value="null" disabled>Año</option>
                                    @for ($year = now()->year; $year >= 1980; $year--)
                                        <option value="{{ $year }}"
                                            {{ old('anioFab') == $year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="password-vertical">Kilometraje</label>
                                <input type="number" id="ckm" class="form-control km" name="km"
                                    placeholder="Kilometraje">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="password-vertical">Modelo</label>
                                <input type="text" id="cmodelo" class="form-control modelo" name="modelo"
                                    placeholder="Modelo">
                            </div>
                        </div>
                        <div class="col-12">
                            <input type="file" id="imagenEdit" name="imagen">
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                <button type="button" class="btn btn-light-secondary me-1 mb-1" data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    Close
                                </button>
                            </div>
                    </div>
                </form>
            </div>
            {{-- <div class="modal-footer">
              
                <button type="button" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-sm-block">Accept</span>
                </button>
            </div> --}}
        </div>
    </div>
</div>
