
let pondEditcar = null;

$('#editMantModal').on('show.bs.modal', function (e) {
    if (pondEditcar) {
        pondEditcar.destroy();
        pondEditcar = null;
    }
    var button = $(e.relatedTarget)
    var url = button.data('url')
    var getDataUrl = button.data('send')
    var modal = $(this)


    $.ajax({
        type: 'GET',
        url: getDataUrl,
        dataType: 'JSON',
        success: function (data) {
            console.log(data);
            modal.find('.name').val(data.name)
            modal.find('.marca').val(data.marca)
            modal.find('.numero').val(data.numero)
            modal.find('.price').val(data.price)
            modal.find('.fecEmit').val(data.fecEmit)
            modal.find('.fecRenov').val(data.fecRenov)
            modal.find('.carPlaca').val(data.car_id)
            modal.find('.carPlaca').text(data.carPlaca)
            // modal.find('.level-select').val(id_level)
            // modal.find('.level-select').text(level_name)
            pondEditcar = FilePond.create(
                document.querySelector('#imagenEditMant'),
                {
                    name: 'imagen',
                    storeAsFile: true,
                    allowImagePreview: true,
                    acceptedFileTypes: ['image/png', 'image/jpg', 'image/jpeg'],
                    files: data.imagen ? [
                        {
                            source: data.imagen,
                        }
                    ] : []
                }
            );
        },
        error: function (response) {

        }
    })
    modal.find('#editMantForm').attr('action', url)

})