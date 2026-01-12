    const btnEdit = document.getElementById('btnEdit');
    const viewMode = document.querySelectorAll('.view-mode');
    const editMode = document.querySelectorAll('.edit-mode');

    let editing = false;

    btnEdit.addEventListener('click', () => {
        editing = !editing;

        viewMode.forEach(el => el.classList.toggle('d-none'));
        editMode.forEach(el => el.classList.toggle('d-none'));

        btnEdit.innerHTML = editing
            ? 'Cancelar'
            : '<i class="bi bi-pencil"></i> Editar';
    });
