
document.addEventListener('DOMContentLoaded', (event) => {
    const loginButton = document.querySelector('#login-button');
    loginButton.addEventListener('click', () => {
        window.location.href = '/login'; 
    });

    const signUpButton = document.querySelector('#sign-up-button');
    signUpButton.addEventListener('click', () => {
        window.location.href = '/register'; 
    });
});
