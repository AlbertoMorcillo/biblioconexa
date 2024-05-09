let stars = document.querySelectorAll('.star-rating .star');
let rating = 0;

stars.forEach((star, index) => {
    star.addEventListener('mouseover', () => highlightStars(index));
    star.addEventListener('click', () => saveRating(index));
});

function highlightStars(index) {
    stars.forEach((star, i) => {
        star.style.color = i <= index ? 'gold' : 'gray';
    });
}

function saveRating(index) {
    rating = index + 1;
    console.log('Rating is', rating);
}