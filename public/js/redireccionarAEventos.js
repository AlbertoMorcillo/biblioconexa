document.addEventListener('DOMContentLoaded', function () {
    const verActividadesBoton = document.getElementById('verActividadesBoton');
    verActividadesBoton.addEventListener('click', function () {
        fetch('/noticias', {
            headers: {
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.authenticated) {
                window.location.href = '/actividades-logged';
            } else {
                window.location.href = '/actividades';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            window.location.href = '/actividades';
        });
    });
});
