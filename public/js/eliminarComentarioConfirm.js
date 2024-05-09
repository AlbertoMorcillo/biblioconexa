document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('[data-bs-target="#deleteConfirmationModal"]');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const comentarioId = this.getAttribute('data-comentario-id');
            const form = document.getElementById('confirmDeleteForm');
            if (form) { // Verifica que el formulario exista antes de intentar usarlo
                form.action = `/comentarios/${comentarioId}`;  // Asegúrate de que la ruta es correcta
                document.getElementById('comentarioIdToDelete').value = comentarioId;
            }
        });
    });

    const confirmDeleteButton = document.getElementById('confirmDeleteButton');
    if (confirmDeleteButton) { // Verifica que el botón exista antes de añadir el evento
        confirmDeleteButton.addEventListener('click', function () {
            const form = document.getElementById('confirmDeleteForm');
            if (form) {
                form.submit(); // Solo intenta enviar el formulario si existe
            }
        });
    }
});
