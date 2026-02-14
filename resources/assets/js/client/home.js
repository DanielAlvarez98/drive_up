document.addEventListener("DOMContentLoaded", function () {

    const modalElement = document.getElementById('welcomeModal');

    if (modalElement) {
        const modal = new bootstrap.Modal(modalElement);
        modal.show();
    }

});