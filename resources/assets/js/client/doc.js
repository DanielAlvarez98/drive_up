$(document).ready(function () {

    $('.personal').show();
    $('.auto').hide();

    $('#tipoDocumento').on('change', function () {
        let tipo = $(this).val();

        if (tipo === '1') {
            $('.personal').show();
            $('.auto').hide();
        } else if (tipo === '2') {
            $('.personal').hide();
            $('.auto').show();
        }
    });

});

let pondEdit = null;

$('#editPerModal').on('show.bs.modal', function (e) {
    if (pondEdit) {
        pondEdit.destroy();
        pondEdit = null;
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
            modal.find('.licen').val(data.licen)
            modal.find('.categoria').val(data.categoria)
            modal.find('.fecEmit').val(data.fecEmit)
            modal.find('.fecRenov').val(data.fecRenov)

            pondEdit = FilePond.create(
                document.querySelector('#imagenEdit'),
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
    modal.find('#editDocForm').attr('action', url)

})
let pondEditcar = null;

$('#editVehModal').on('show.bs.modal', function (e) {
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
            modal.find('.licen').val(data.licen)
            modal.find('.empresa').val(data.empresa)
            modal.find('.fecEmit').val(data.fecEmit)
            modal.find('.fecRenov').val(data.fecRenov)
            modal.find('.carPlaca').val(data.car_id)
            modal.find('.carPlaca').text(data.carPlaca)
           
            pondEditcar = FilePond.create(
                document.querySelector('#imagenEditCar'),
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
    modal.find('#editDocForm').attr('action', url)

})