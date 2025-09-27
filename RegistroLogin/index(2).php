<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scuola Italiana di Montevideo - Acceso</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="flag-accent"></div>
        
        <!-- Pantalla de Registro -->
        <div id="register-screen" class="screen active">
            <div class="header">
                <div class="logo">Scuola Italiana di Montevideo</div>
                <div class="subtitle">Registro de Usuario</div>
            </div>
            
            <div class="form-container">
                <div class="success-message" id="success-message">
                    ¡Registro exitoso! Serás redirigido al login en unos segundos...
                </div>
                
                <form id="register-form">
                    <div class="form-group">
                        <label for="register-email">Correo Institucional</label>
                        <input type="email" id="register-email" name="email" placeholder="nombre@scuolaitaliana.edu.uy" required>
                        <div class="validation-message" id="email-validation"></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="register-password">Contraseña</label>
                        <input type="password" id="register-password" name="password" placeholder="Ingresa tu contraseña" required>
                        <div class="validation-message" id="password-validation"></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="register-confirm-password">Confirmar Contraseña</label>
                        <input type="password" id="register-confirm-password" name="confirm-password" placeholder="Confirma tu contraseña" required>
                        <div class="validation-message" id="confirm-password-validation"></div>
                    </div>
                    
                    <button type="submit" class="btn" id="register-btn">Registrarse</button>
                </form>
                
                <div class="switch-form">
                    ¿Ya tienes una cuenta? <a href="#" id="go-to-login">Iniciar sesión</a>
                </div>
            </div>
        </div>
        
        <!-- Pantalla de Login -->
        <div id="login-screen" class="screen">
            <div class="header">
                <div class="logo">Scuola Italiana di Montevideo</div>
                <div class="subtitle">Iniciar Sesión</div>
            </div>
            
            <div class="form-container">
                <form id="login-form">
                    <div class="form-group">
                        <label for="login-email">Correo Electrónico</label>
                        <input type="email" id="login-email" name="email" placeholder="nombre@scuolaitaliana.edu.uy" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="login-password">Contraseña</label>
                        <input type="password" id="login-password" name="password" placeholder="Ingresa tu contraseña" required>
                    </div>
                    
                    <button type="submit" class="btn">Iniciar Sesión</button>
                </form>
                
                <div class="switch-form">
                    ¿No tienes una cuenta? <a href="#" id="go-to-register">Registrarse</a>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>