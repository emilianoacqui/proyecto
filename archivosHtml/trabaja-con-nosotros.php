<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trabaja con Nosotros - Scuola Italiana di Montevideo</title>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Merriweather Sans', Arial, sans-serif;
            background: linear-gradient(135deg, #0A2452 0%, #1B4F72 100%);
            min-height: 100vh;
            padding-top: 120px;
        }

        /* Navigation */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 80px;
            background: rgba(10, 36, 82, 0.5);
            z-index: 1000;
            transition: all 0.3s ease, transform 0.3s ease, opacity 0.3s ease;
        }

        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 5%;
            max-width: 1200px;
            margin: 0 auto;
            height: 100%;
        }

        .nav-logo {
            position: relative;
            height: 100%;
            overflow: visible;
        }

        .nav-logo img {
            height: 120px;
            width: auto;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
        }

        .nav-menu-button {
            display: flex;
            flex-direction: column;
            cursor: pointer;
            padding: 8px;
            transition: all 0.3s ease;
        }

        .nav-menu-button span {
            width: 25px;
            height: 3px;
            background-color: white;
            margin: 3px 0;
            transition: 0.3s;
            border-radius: 2px;
        }

        .nav-menu-button:hover span {
            background-color: #F39C12;
        }

        /* Main Content */
        .main-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 5%;
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 60px;
            align-items: start;
        }

        .form-section {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            transform: translateY(20px);
            animation: slideUp 0.8s ease forwards;
        }

        @keyframes slideUp {
            to {
                transform: translateY(0);
            }
        }

        .form-title {
            color: #0A2452;
            font-size: 2.5em;
            font-weight: 700;
            margin-bottom: 10px;
            position: relative;
        }

        .form-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, #F39C12, #E74C3C);
            border-radius: 2px;
        }

        .form-subtitle {
            color: #666;
            font-size: 1.1em;
            margin-bottom: 40px;
            line-height: 1.6;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-group label {
            display: block;
            color: #0A2452;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 0.95em;
        }

        .form-control {
            width: 100%;
            padding: 15px 18px;
            border: 2px solid #E0E6ED;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: #FAFBFC;
        }

        .form-control:focus {
            outline: none;
            border-color: #F39C12;
            background: white;
            box-shadow: 0 0 0 3px rgba(243, 156, 18, 0.1);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 120px;
            font-family: inherit;
        }

        .file-upload-container {
            position: relative;
            overflow: hidden;
            display: inline-block;
            width: 100%;
        }

        .file-upload-input {
            position: absolute;
            left: -9999px;
        }

        .file-upload-label {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px 20px;
            background: #0A2452;
            color: white;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
            gap: 10px;
        }

        .file-upload-label:hover {
            background: #1B4F72;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(10, 36, 82, 0.3);
        }

        .file-upload-label::before {
            content: '📎';
            font-size: 1.2em;
        }

        .submit-btn {
            background: linear-gradient(135deg, #E74C3C, #C0392B);
            color: white;
            padding: 18px 40px;
            border: none;
            border-radius: 12px;
            font-size: 1.1em;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            width: 100%;
            position: relative;
            overflow: hidden;
        }

        .submit-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .submit-btn:hover::before {
            left: 100%;
        }

        .submit-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(231, 76, 60, 0.4);
        }

        /* Info Panel */
        .info-panel {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 35px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
            position: sticky;
            top: 120px;
        }

        .info-title {
            color: #0A2452;
            font-size: 1.8em;
            font-weight: 700;
            margin-bottom: 25px;
            text-align: center;
        }

        .contact-item {
            margin-bottom: 25px;
            padding: 20px;
            background: linear-gradient(135deg, #0A2452, #1B4F72);
            border-radius: 15px;
            color: white;
            transition: transform 0.3s ease;
        }

        .contact-item:hover {
            transform: translateY(-5px);
        }

        .contact-label {
            font-weight: 700;
            font-size: 1.1em;
            margin-bottom: 5px;
            color: #F39C12;
        }

        .contact-value {
            font-size: 0.95em;
            line-height: 1.4;
            opacity: 0.9;
        }

        .contact-info {
            background: #154360;
            border-radius: 15px;
            padding: 25px;
            margin-top: 20px;
        }

        .contact-info h4 {
            color: #F39C12;
            font-size: 1.2em;
            margin-bottom: 15px;
        }

        .contact-info p {
            color: white;
            margin-bottom: 8px;
            font-size: 0.95em;
        }

        /* Footer */
        .footer-bottom-new {
            background: #1B4F72;
            color: white;
            padding: 0;
            margin: 0;
            margin-top: 80px;
        }

        .footer-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 30px 5%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-Aleft {
            flex: 1;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .footer-logo img {
            height: 60px;
            width: auto;
        }

        .footer-subtitle p {
            margin: 0;
            font-size: 14px;
            color: #E8E8E8;
        }

        .footer-center,
        .footer-right {
            flex: 1;
            padding: 0 20px;
        }

        .footer-section h4 {
            color: white;
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 10px;
            border-bottom: 1px solid rgba(255,255,255,0.2);
            padding-bottom: 5px;
        }

        .footer-section p {
            margin: 8px 0;
            font-size: 14px;
            color: #E8E8E8;
            line-height: 1.4;
        }

        .footer-info-bar {
            background: #154360;
            text-align: center;
            padding: 15px 5%;
            border-top: 1px solid rgba(255,255,255,0.1);
        }

        .footer-info-bar p {
            margin: 0;
            font-size: 12px;
            color: #BDC3C7;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .main-container {
                grid-template-columns: 1fr;
                gap: 40px;
            }
            
            .info-panel {
                position: static;
                order: -1;
            }
        }

        @media (max-width: 768px) {
            body {
                padding-top: 100px;
            }

            .main-container {
                padding: 20px 5%;
            }

            .form-section {
                padding: 30px 25px;
            }

            .form-title {
                font-size: 2em;
            }

            .footer-container {
                flex-direction: column;
                gap: 30px;
                text-align: center;
            }
            
            .footer-Aleft {
                flex-direction: column;
                gap: 10px;
            }
            
            .footer-center,
            .footer-right {
                padding: 0;
                width: 100%;
            }
            
            .footer-section {
                margin-bottom: 20px;
            }
        }

        .quality-icon {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .quality-icon:hover {
            background: #049B4C !important;
            transform: scale(1.1);
        }

        .quality-icon i {
            font-size: 40px;
            color: white;
        }

        .quality-item a {
            text-decoration: none;
        }

        .projects-section {
            background: #1B2F6F;
            padding: 200px 5% 150px 5%;
            text-align: center;
            margin-bottom: 120px;
        }

        .news-section {
            padding: 140px 5% 100px 5%;
            background: #0A2452;
            position: relative;
            overflow: hidden;
        }

        .news-section::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 0%;
            height: 870px;
            background: #004ECC;
            transition: width 2.5s cubic-bezier(1, 0.46, 0.45, 0.94);
            z-index: 1;
        }

        .news-section.animate::after {
            width: 50%;
        }

        .news-header, 
        .news-grid {
            position: relative;
            z-index: 2;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <div class="nav-logo">
                <img src="fotosPrincipales/logo2.png" alt="Scuola Italiana di Montevideo">
            </div>
            <div class="nav-menu-button" onclick="window.location.href='menuScuola.html'">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </nav>

    <div class="main-container">
        <!-- Formulario -->
        <div class="form-section">
            <h1 class="form-title">Trabaja con Nosotros</h1>
            <p class="form-subtitle">
                Únete a nuestro equipo educativo y forma parte de una institución comprometida con la excelencia académica y los valores italianos.
            </p>

            <form action="procesar_trabajo.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nombre">Nombre y Apellido *</label>
                    <input type="text" id="nombre" name="nombre" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="email">E-mail *</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="celular">Celular</label>
                    <input type="tel" id="celular" name="celular" class="form-control">
                </div>

                <div class="form-group">
                    <label for="mensaje">Mensaje *</label>
                    <textarea id="mensaje" name="mensaje" class="form-control" placeholder="Cuéntanos sobre tu experiencia profesional, áreas de especialización y por qué te interesa trabajar en nuestra institución..." required></textarea>
                </div>

                <div class="form-group">
                    <label for="cv">Adjuntar CV</label>
                    <div class="file-upload-container">
                        <input type="file" id="cv" name="cv" class="file-upload-input" accept=".pdf,.doc,.docx">
                        <label for="cv" class="file-upload-label">
                            Seleccionar Archivo CV
                        </label>
                    </div>
                </div>

                <button type="submit" class="submit-btn">
                    Enviar Solicitud
                </button>
            </form>
        </div>

        <!-- Panel de Información -->
        <div class="info-panel">
            <h3 class="info-title">Información de Contacto</h3>

            <div class="contact-item">
                <div class="contact-label">Admisiones</div>
                <div class="contact-value">admisiones@scuolaitaliana.edu.uy</div>
            </div>

            <div class="contact-item">
                <div class="contact-label">Caja | Horario</div>
                <div class="contact-value">
                    08:00 a 13:00 - 13:30 a 16:00<br>
                    caja@scuolaitaliana.edu.uy
                </div>
            </div>

            <div class="contact-item">
                <div class="contact-label">Trabajar con nosotros</div>
                <div class="contact-value">trabajarconnosotros@scuolaitaliana.edu.uy</div>
            </div>

            <div class="contact-item">
                <div class="contact-label">Solicitud de Fórmula 69</div>
                <div class="contact-value">secretariapreparatorio@scuolaitaliana.edu.uy</div>
            </div>

            <div class="contact-info">
                <h4>Información General</h4>
                <p>📍 Gral. French 2380 – Montevideo, CP: 11500</p>
                <p>📞 (+598) 2600 1527</p>
                <p>✉️ info@scuolaitaliana.edu.uy</p>
            </div>
        </div>
    </div>

    <footer class="footer-bottom-new">
        <div class="footer-container">
            <div class="footer-Aleft">
                <div class="footer-logo">
                    <img src="fotosPrincipales/logotipo.png" alt="Scuola Italiana di Montevideo" style="height: 60px;">
                </div>
                <div class="footer-subtitle">
                    <p>Scuola Italiana di Montevideo</p>
                </div>
            </div>
            
            <div class="footer-center">
                <div class="footer-section">
                    <h4>Contacto</h4>
                    <p>Av. Brasil 3149, Montevideo</p>
                    <p>(+598) 2621 4822 / 2622 1422</p>
                    <p>info@scuolaitaliana.edu.uy</p>
                </div>
            </div>
            
            <div class="footer-right">
                <div class="footer-section">
                    <h4>Enlaces útiles</h4>
                    <p>Política de privacidad</p>
                    <p>Requisitos técnicos</p>
                    <p>Accesibilidad</p>
                </div>
            </div>
        </div>
        
        <div class="footer-info-bar">
            <p>Desarrollado por el equipo SGE | Proyecto de apoyo 2002 - EE Informática</p>
        </div>
    </footer>

    <script>
        let lastScrollTop = 0;

        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            
            if (scrollTop > lastScrollTop && scrollTop > 100) {
                navbar.style.transform = 'translateY(-100%)';
                navbar.style.opacity = '0';
            } else {
                navbar.style.transform = 'translateY(0)';
                navbar.style.opacity = '1';
            }
            
            lastScrollTop = scrollTop;
        });

        // Mostrar nombre del archivo seleccionado
        document.getElementById('cv').addEventListener('change', function(e) {
            const label = document.querySelector('.file-upload-label');
            if (e.target.files.length > 0) {
                label.textContent = `📎 ${e.target.files[0].name}`;
                label.style.background = '#049B4C';
            } else {
                label.textContent = '📎 Seleccionar Archivo CV';
                label.style.background = '#0A2452';
            }
        });

        // Validación del formulario
        document.querySelector('form').addEventListener('submit', function(e) {
            const nombre = document.getElementById('nombre').value.trim();
            const email = document.getElementById('email').value.trim();
            const mensaje = document.getElementById('mensaje').value.trim();

            if (!nombre || !email || !mensaje) {
                e.preventDefault();
                alert('Por favor, complete todos los campos obligatorios.');
                return;
            }

            // Validar email
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                e.preventDefault();
                alert('Por favor, ingrese un email válido.');
                return;
            }
        });
    </script>
    <script src="cms-admin.js"></script>
</body>
</html>