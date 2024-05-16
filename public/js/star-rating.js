let stars = document.querySelectorAll('.star-rating label');
let ratingInputs = document.querySelectorAll('.star-rating .radio-btn'); // Captura todos los inputs
let submitButton = document.querySelector('.submit-rating-button');

submitButton.style.visibility = 'hidden';  // Inicialmente oculto

stars.forEach((star, index) => {
    star.addEventListener('mouseover', () => highlightStars(index));
    star.addEventListener('mouseout', () => removeHighlight(index));
    star.addEventListener('click', (event) => {
        saveRating(index);  // Actualizado para simplificar
        submitButton.style.visibility = 'visible';  // Muestra el botón al seleccionar una puntuación
    });
});

function highlightStars(index) {
    stars.forEach((star, i) => {
        star.classList.toggle('hover', i <= index);
    });
}

function removeHighlight(index) {
    stars.forEach((star) => {
        star.classList.remove('hover');
    });
}

function saveRating(index) {
    ratingInputs[index].checked = true;  // Asegura que el input correcto está seleccionado
}

// Desmarcar las estrellas cuando se recarga la página
document.addEventListener('DOMContentLoaded', function () {
    ratingInputs.forEach(input => input.checked = false);
});
