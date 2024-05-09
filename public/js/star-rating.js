let stars = document.querySelectorAll('.star-rating .star');
let ratingForm = document.querySelector('.rating-area form');

stars.forEach((star, index) => {
    star.addEventListener('mouseover', () => highlightStars(index));
    star.addEventListener('click', (event) => saveRating(event, index));
});

function highlightStars(index) {
    stars.forEach((star, i) => {
        star.style.color = i <= index ? 'gold' : 'gray';
    });
}

function saveRating(event, index) {
    event.preventDefault();  // Detiene el comportamiento por defecto para no recargar la página
    rating = index + 1;      // Establece el rating seleccionado
    console.log('Rating is', rating);
    ratingForm.querySelector(`input[name="puntuacion"][value="${rating}"]`).checked = true;
    ratingForm.submit();  // Envía el formulario
}
