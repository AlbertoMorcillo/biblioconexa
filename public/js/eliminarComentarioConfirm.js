document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('[data-bs-target="#deleteConfirmationModal"]');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const comentarioId = this.getAttribute('data-comentario-id');
            const form = document.getElementById('confirmDeleteForm');
            form.action = `/comentarios/${comentarioId}`;  // Asegúrate de que la ruta es correcta
            document.getElementById('comentarioIdToDelete').value = comentarioId;
        });
    });

    document.getElementById('confirmDeleteButton').addEventListener('click', function () {
        document.getElementById('confirmDeleteForm').submit();
    });
});
