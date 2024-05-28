document.addEventListener('DOMContentLoaded', function () {
    const deleteModal = document.getElementById('deleteModal');
    const deleteForm = document.getElementById('deleteForm');
    const confirmDeleteButton = document.getElementById('confirmDeleteButton');

    deleteModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const comentarioId = button.getAttribute('data-id');
        deleteForm.setAttribute('action', `/admin/comentarios/${comentarioId}`);
    });

    confirmDeleteButton.addEventListener('click', function () {
        deleteForm.submit();
    });
});