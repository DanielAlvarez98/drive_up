// new DataTable('#example');

//CAR
let pondEdit = null;

$('#editCarModal').on('show.bs.modal', function (e) {
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
      modal.find('.marca').val(data.marca)
      modal.find('.placa').val(data.placa)
      modal.find('.anhoFab').val(data.anhoFab)
      modal.find('.km').val(data.km)
      modal.find('.modelo').val(data.modelo)

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
  modal.find('#editCarForm').attr('action', url)

})


