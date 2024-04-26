document.addEventListener('DOMContentLoaded', function () {
    const dniInput = document.getElementById('dni');
    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const passwordConfirmInput = document.getElementById('password_confirmation');
  
    dniInput.addEventListener('input', validateDNI);
    nameInput.addEventListener('input', validateName);
    emailInput.addEventListener('input', validateEmail);
    passwordInput.addEventListener('input', validatePassword);
    passwordConfirmInput.addEventListener('input', validatePasswordConfirmation);
  
    function validateDNI() {
      const dniRegex = /^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKET]$/i;
      if (!dniRegex.test(dniInput.value)) {
        showError(dniInput, 'DNI no válido. Debe tener 8 números seguidos de una letra.');
      } else {
        clearError(dniInput);
      }
    }
  
    function validateName() {
      const nameRegex = /^[a-zA-Z\s]*$/; 
      const specialCharRegex = /[^a-zA-Z\s]/; // Expresión regular que coincide con cualquier carácter que no sea una letra o un espacio
      if (nameInput.value.trim() === '') {
        showError(nameInput, 'El nombre no puede estar vacío.');
      } else if (specialCharRegex.test(nameInput.value)) {
        showError(nameInput, 'El nombre no puede contener caracteres especiales.');
      } else if (!nameRegex.test(nameInput.value)) {
        showError(nameInput, 'El nombre no puede contener números.');
      } else {
        clearError(nameInput);
      }
    }
  
    function validateEmail() {
      const emailRegex = /^[^@]+@[^@]+\.[^@]+$/;
      if (!emailRegex.test(emailInput.value)) {
        showError(emailInput, 'Email no válido.');
      } else {
        clearError(emailInput);
      }
    }
  
    function validatePassword() {
      if (passwordInput.value.length < 8) {
        showError(passwordInput, 'La contraseña debe tener al menos 8 caracteres.');
      } else {
        clearError(passwordInput);
      }
    }
  
    function validatePasswordConfirmation() {
      if (passwordInput.value !== passwordConfirmInput.value) {
        showError(passwordConfirmInput, 'Las contraseñas no coinciden.');
      } else {
        clearError(passwordConfirmInput);
      }
    }
  
    function showError(input, message) {
      const errorDiv = input.nextElementSibling; 
      errorDiv.textContent = message;
      errorDiv.style.display = 'block';
    }
  
    function clearError(input) {
      const errorDiv = input.nextElementSibling; 
      errorDiv.textContent = '';
      errorDiv.style.display = 'none';
    }
  });
  