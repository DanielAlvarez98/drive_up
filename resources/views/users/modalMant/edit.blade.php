<div class="modal fade text-left" id="editMantModal" tabindex="-1" aria-labelledby="myModalLabel1" style="display: none;"
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
                <form class="form form-vertical " method="POST" id="editMantForm" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="email-id-vertical">Nombre</label>
                                    <input type="text" id="name" class="form-control name" name="name"
                                        placeholder="Nombre" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="email-id-vertical">Marca</label>
                                    <input type="text" id="marca" class="form-control marca" name="marca"
                                        placeholder="Marca" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="contact-info-vertical">N°</label>
                                    <input type="number" id="numero" class="form-control numero" name="numero"
                                        placeholder="N°">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="contact-info-vertical">N°</label>
                                    <input type="number" id="price" class="form-control price" name="price"
                                        placeholder="Precio">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="contact-info-vertical">Auto</label>
                                    <select class="form-select" id="basicSelect" name="car_id" required>
                                        <option class="carPlaca" value="" selected disabled> </option>
                                        @foreach ($cars as $car)
                                            <option value="{{ $car->id }}">{{ $car->marca }}
                                                ||
                                                {{ $car->placa }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="password-vertical">Fecha de mantenimiento</label>
                                    <input type="date" id="dfecEmit" class="form-control fecEmit" max="{{ date('Y-m-d') }}"
                                        name="fecEmit" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="password-vertical">Fecha de renovacion</label>
                                    <input type="date" id="dfecRenov" class="form-control fecRenov" min="{{ date('Y-m-d') }}"
                                        name="fecRenov" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <input type="file" id="imagenEditMant" name="imagen">

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
            {{-- <div class="modal-footer">
              
                <button type="button" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-sm-block">Accept</span>
                </button>
            </div> --}}
        </div>
    </div>
</div>
