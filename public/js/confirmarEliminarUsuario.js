document.addEventListener('DOMContentLoaded', function () {
    // Obtener el modal y el formulario del modal
    const deleteUserModal = document.getElementById('deleteUserModal');
    const deleteUserForm = document.getElementById('deleteUserForm');
    const adminPasswordInput = deleteUserModal.querySelector('#admin-password');

    // Agregar el evento para los botones de eliminar
    $('#deleteUserModal').on('show.bs.modal', function (event) {
        const button = $(event.relatedTarget); // Botón que activó el modal
        const userId = button.data('user-id'); // Extraer información del atributo data-*
        const actionUrl = `/admin/usuarios/${userId}`; // Generar la URL de acción

        deleteUserForm.setAttribute('action', actionUrl); // Establecer la URL de acción
        adminPasswordInput.value = ''; // Limpiar el campo de la contraseña
    });

    // Evento para cerrar el modal cuando se presiona el botón de "Cancelar"
    document.querySelectorAll('.modal .secondary-button').forEach(button => {
        button.addEventListener('click', function () {
            $('#deleteUserModal').modal('hide');
        });
    });
});
