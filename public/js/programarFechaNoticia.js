document.addEventListener('DOMContentLoaded', function () {
    const fechaInput = document.getElementById('fecha');
    const horaInputContainer = document.getElementById('horaContainer');

    function getLocalDateString(date) {
        const localDate = new Date(date.getTime() - date.getTimezoneOffset() * 60000);
        return localDate.toISOString().split('T')[0];
    }

    fechaInput.addEventListener('change', function () {
        const selectedDate = new Date(fechaInput.value);
        const today = new Date();

        // Reset time portion for comparison
        today.setHours(0, 0, 0, 0);
        selectedDate.setHours(0, 0, 0, 0);

        if (selectedDate > today) {
            horaInputContainer.style.display = 'block';
        } else {
            horaInputContainer.style.display = 'none';
        }
    });

    // Para mantener los campos visibles si la fecha seleccionada anteriormente es válida
    const initialSelectedDate = new Date(fechaInput.value);
    const today = new Date();
    today.setHours(0, 0, 0, 0); // Reset time portion

    if (initialSelectedDate > today) {
        horaInputContainer.style.display = 'block';
    } else {
        horaInputContainer.style.display = 'none';
    }
});
