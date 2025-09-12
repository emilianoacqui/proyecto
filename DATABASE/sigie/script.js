// Elementos del DOM
const registerScreen = document.getElementById('register-screen');
const loginScreen = document.getElementById('login-screen');
const goToLogin = document.getElementById('go-to-login');
const goToRegister = document.getElementById('go-to-register');
const registerForm = document.getElementById('register-form');
const loginForm = document.getElementById('login-form');
const successMessage = document.getElementById('success-message');

// Elementos de validación
const emailInput = document.getElementById('register-email');
const passwordInput = document.getElementById('register-password');
const confirmPasswordInput = document.getElementById('register-confirm-password');
const emailValidation = document.getElementById('email-validation');
const passwordValidation = document.getElementById('password-validation');
const confirmPasswordValidation = document.getElementById('confirm-password-validation');
const registerBtn = document.getElementById('register-btn');

// Función para cambiar entre pantallas
function switchScreen(hideScreen, showScreen) {
    hideScreen.classList.remove('active');
    showScreen.classList.add('active');
}

// Event listeners para cambiar pantallas
goToLogin.addEventListener('click', (e) => {
    e.preventDefault();
    switchScreen(registerScreen, loginScreen);
});

goToRegister.addEventListener('click', (e) => {
    e.preventDefault();
    switchScreen(loginScreen, registerScreen);
});

// Validación de email institucional
function validateEmail(email) {
    const institutionalDomain = '@scuolaitaliana.edu.uy';
    return email.endsWith(institutionalDomain) && email.length > institutionalDomain.length;
}

// Validación de contraseña
function validatePassword(password) {
    return password.length >= 6;
}

// Mostrar mensaje de validación
function showValidationMessage(element, message, isValid) {
    element.textContent = message;
    element.className = `validation-message show ${isValid ? 'success' : 'error'}`;
}

// Ocultar mensaje de validación
function hideValidationMessage(element) {
    element.className = 'validation-message';
}

// Validación en tiempo real del email
emailInput.addEventListener('input', () => {
    const email = emailInput.value.trim();
    
    if (email === '') {
        hideValidationMessage(emailValidation);
        emailInput.className = '';
        return;
    }
    
    if (validateEmail(email)) {
        emailInput.className = 'valid';
        showValidationMessage(emailValidation, '✓ Correo institucional válido', true);
    } else {
        emailInput.className = 'invalid';
        showValidationMessage(emailValidation, '✗ Debe usar un correo @scuolaitaliana.edu.uy', false);
    }
    
    updateRegisterButton();
});

// Validación en tiempo real de la contraseña
passwordInput.addEventListener('input', () => {
    const password = passwordInput.value;
    
    if (password === '') {
        hideValidationMessage(passwordValidation);
        passwordInput.className = '';
        return;
    }
    
    if (validatePassword(password)) {
        passwordInput.className = 'valid';
        showValidationMessage(passwordValidation, '✓ Contraseña válida', true);
    } else {
        passwordInput.className = 'invalid';
        showValidationMessage(passwordValidation, '✗ La contraseña debe tener al menos 6 caracteres', false);
    }
    
    // Revalidar confirmación de contraseña
    if (confirmPasswordInput.value !== '') {
        validateConfirmPassword();
    }
    
    updateRegisterButton();
});

// Validación de confirmación de contraseña
function validateConfirmPassword() {
    const password = passwordInput.value;
    const confirmPassword = confirmPasswordInput.value;
    
    if (confirmPassword === '') {
        hideValidationMessage(confirmPasswordValidation);
        confirmPasswordInput.className = '';
        return;
    }
    
    if (password === confirmPassword) {
        confirmPasswordInput.className = 'valid';
        showValidationMessage(confirmPasswordValidation, '✓ Las contraseñas coinciden', true);
    } else {
        confirmPasswordInput.className = 'invalid';
        showValidationMessage(confirmPasswordValidation, '✗ Las contraseñas no coinciden', false);
    }
}

confirmPasswordInput.addEventListener('input', () => {
    validateConfirmPassword();
    updateRegisterButton();
});

// Actualizar estado del botón de registro
function updateRegisterButton() {
    const isEmailValid = validateEmail(emailInput.value.trim());
    const isPasswordValid = validatePassword(passwordInput.value);
    const isConfirmPasswordValid = passwordInput.value === confirmPasswordInput.value && confirmPasswordInput.value !== '';
    
    registerBtn.disabled = !(isEmailValid && isPasswordValid && isConfirmPasswordValid);
}

// ==========================
// Manejar envío del formulario de registro (con backend real)
// ==========================
registerForm.addEventListener('submit', async (e) => {
    e.preventDefault();

    const email = emailInput.value.trim();
    const password = passwordInput.value;
    const confirmPassword = confirmPasswordInput.value;

    // Validaciones finales
    if (!validateEmail(email)) {
        showValidationMessage(emailValidation, '✗ Debe usar un correo @scuolaitaliana.edu.uy', false);
        return;
    }
    
    if (!validatePassword(password)) {
        showValidationMessage(passwordValidation, '✗ La contraseña debe tener al menos 6 caracteres', false);
        return;
    }
    
    if (password !== confirmPassword) {
        showValidationMessage(confirmPasswordValidation, '✗ Las contraseñas no coinciden', false);
        return;
    }

    const formData = new FormData(registerForm);

    try {
        const resp = await fetch('register.php', { method: 'POST', body: formData });
        const data = await resp.json();

        if (data.ok) {
            // Registro exitoso → mostrar mensaje y cambiar a login
            successMessage.classList.add('show');
            registerForm.style.display = 'none';

            setTimeout(() => {
                successMessage.classList.remove('show');
                registerForm.style.display = 'block';
                registerForm.reset();
                
                // Limpiar validaciones
                emailInput.className = '';
                passwordInput.className = '';
                confirmPasswordInput.className = '';
                hideValidationMessage(emailValidation);
                hideValidationMessage(passwordValidation);
                hideValidationMessage(confirmPasswordValidation);

                // Cambiar a pantalla de login
                switchScreen(registerScreen, loginScreen);
            }, 1500);
        } else {
            alert(data.error || 'No se pudo registrar');
        }
    } catch (err) {
        alert('Error de red o del servidor');
    }
});

// ==========================
// Manejar envío del formulario de login (con backend real)
// ==========================
loginForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    const formData = new FormData(loginForm);

    try {
        const resp = await fetch('login.php', { method: 'POST', body: formData });
        const data = await resp.json();

        if (data.ok) {
            window.location.href = data.redirect;
        } else {
            alert(data.error || 'No se pudo iniciar sesión');
        }
    } catch (err) {
        alert('Error de red o del servidor');
    }
});

// Inicializar estado del botón
updateRegisterButton();
