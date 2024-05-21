document.addEventListener('DOMContentLoaded', function () {
    const verNoticiasBoton = document.getElementById('verNoticiasBoton');
    verNoticiasBoton.addEventListener('click', function () {
        fetch('/noticias', {
            headers: {
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.authenticated) {
                window.location.href = '/noticias-logged';
            } else {
                window.location.href = '/noticias';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            window.location.href = '/noticias';
        });
    });
});
