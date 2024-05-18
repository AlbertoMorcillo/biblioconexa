document.addEventListener('DOMContentLoaded', function () {
    const deleteModal = document.getElementById('deleteModal');
    const deleteForm = document.getElementById('deleteForm');
    const confirmDeleteButton = document.getElementById('confirmDeleteButton');

    deleteModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const noticiaId = button.getAttribute('data-id');
        const action = `/admin/noticias/${noticiaId}`;
        deleteForm.setAttribute('action', action);
    });

    confirmDeleteButton.addEventListener('click', function () {
        deleteForm.submit();
    });
});