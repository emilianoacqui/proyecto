<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestor de Contenido - Scuola</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Arial', sans-serif;
      background: #f5f5f5;
      overflow-x: hidden;
    }

    /* Sidebar */
    .sidebar {
      position: fixed;
      left: 0;
      top: 0;
      width: 250px;
      height: 100vh;
      background: linear-gradient(135deg, #2c3e50, #34495e);
      color: white;
      z-index: 1000;
      transition: all 0.3s ease;
    }

    .logo-section {
      padding: 20px;
      text-align: center;
      border-bottom: 1px solid rgba(255,255,255,0.1);
    }

    .logo-circle {
      width: 60px;
      height: 60px;
      background: white;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 10px;
      font-size: 24px;
      font-weight: bold;
      color: #2c3e50;
    }

    .nav-menu {
      list-style: none;
      padding: 20px 0;
    }

    .nav-item {
      padding: 15px 25px;
      cursor: pointer;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .nav-item:hover, .nav-item.active {
      background: rgba(255,255,255,0.1);
      transform: translateX(5px);
    }

    .nav-icon {
      font-size: 18px;
    }

    /* Main Content */
    .main-content {
      margin-left: 250px;
      min-height: 100vh;
      background: white;
    }

    .content-area {
      padding: 30px;
      max-width: 1200px;
    }

    .page-header {
      background: linear-gradient(135deg, #3498db, #2980b9);
      color: white;
      padding: 20px 30px;
      margin: -30px -30px 30px -30px;
    }

    .page-title {
      font-size: 28px;
      font-weight: 300;
      margin-bottom: 10px;
    }

    .page-subtitle {
      opacity: 0.9;
      font-size: 14px;
    }

    /* Template Selection */
    .template-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 20px;
      margin-bottom: 30px;
    }

    .template-card {
      background: white;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
      transition: all 0.3s ease;
      cursor: pointer;
      border: 2px solid transparent;
    }

    .template-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 30px rgba(0,0,0,0.15);
    }

    .template-card.selected {
      border-color: #3498db;
      box-shadow: 0 8px 30px rgba(52, 152, 219, 0.3);
    }

    .template-preview {
      width: 100%;
      height: 200px;
      background: #f8f9fa;
      position: relative;
      overflow: hidden;
    }

    .template-preview img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .template-info {
      padding: 20px;
    }

    .template-name {
      font-size: 18px;
      font-weight: 600;
      margin-bottom: 10px;
      color: #2c3e50;
    }

    .template-description {
      color: #7f8c8d;
      font-size: 14px;
      line-height: 1.5;
    }

    .template-actions {
      padding: 15px 20px;
      background: #f8f9fa;
      display: flex;
      gap: 10px;
    }

    .btn {
      padding: 8px 16px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-size: 14px;
      transition: all 0.3s ease;
      text-decoration: none;
      display: inline-block;
      text-align: center;
    }

    .btn-primary {
      background: #3498db;
      color: white;
    }

    .btn-primary:hover {
      background: #2980b9;
    }

    .btn-secondary {
      background: #95a5a6;
      color: white;
    }

    .btn-secondary:hover {
      background: #7f8c8d;
    }

    .btn-success {
      background: #27ae60;
      color: white;
      font-size: 16px;
      padding: 12px 30px;
    }
    .btn-danger {
  background: #e74c3c;
  color: white;
}

.btn-danger:hover {
  background: #c0392b;
}

.btn-small {
  padding: 6px 12px;
  font-size: 12px;
}

    .btn-success:hover {
      background: #219a52;
    }

    /* Editor Area */
    .editor-container {
      display: none;
      background: white;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
      overflow: hidden;
    }

    .editor-header {
      background: #34495e;
      color: white;
      padding: 15px 20px;
      display: flex;
      justify-content: between;
      align-items: center;
    }

    .editor-title {
      font-size: 18px;
      font-weight: 600;
    }

    .editor-actions {
      display: flex;
      gap: 10px;
    }

    .template-container {
    position: relative;
    background: white;
    overflow-y: auto; /* CAMBIO: permitir scroll vertical */
    overflow-x: hidden; /* CAMBIO: solo ocultar scroll horizontal */
    padding: 20px;
    max-width: 100%;
}

    .template-frame {
    border: 1px solid #ddd;
    border-radius: 8px;
    overflow-y: auto; /* CAMBIO: permitir scroll vertical */
    overflow-x: hidden; /* CAMBIO: solo ocultar scroll horizontal */
    background: white;
    position: relative;
    width: 100%;
    height: 600px;
    margin-bottom: 20px;
}

    /* Editable content styles */
    .editable-text {
      cursor: pointer;
      transition: all 0.3s ease;
      position: relative;
    }

    .editable-text:hover {
      background: rgba(52, 152, 219, 0.1);
      outline: 2px dashed #3498db;
      outline-offset: 2px;
    }

    .editable-text.editing {
      background: rgba(52, 152, 219, 0.1);
      outline: 2px solid #3498db;
    }

    .editable-image {
      cursor: pointer;
      transition: all 0.3s ease;
      position: relative;
    }

    .editable-image:hover {
      opacity: 0.8;
      outline: 3px dashed #3498db;
      outline-offset: 2px;
    }

    .edit-tooltip {
      position: absolute;
      top: -30px;
      left: 50%;
      transform: translateX(-50%);
      background: #2c3e50;
      color: white;
      padding: 5px 10px;
      border-radius: 4px;
      font-size: 12px;
      opacity: 0;
      transition: opacity 0.3s ease;
    }

    .editable-text:hover .edit-tooltip,
    .editable-image:hover .edit-tooltip {
      opacity: 1;
    }

    /* History Panel */
    .history-list {
      list-style: none;
      padding: 20px;
    }

    .history-item {
      background: white;
      padding: 15px;
      margin-bottom: 10px;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      border-left: 4px solid #3498db;
    }

    .history-date {
      font-size: 12px;
      color: #7f8c8d;
    }

    .history-action {
      font-weight: 600;
      color: #2c3e50;
    }

    .history-detail {
      font-size: 14px;
      color: #7f8c8d;
      margin-top: 5px;
    }

    /* Modal for image upload */
    .modal {
      display: none;
      position: fixed;
      z-index: 2000;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background: rgba(0,0,0,0.5);
    }

    .modal-content {
      background: white;
      margin: 10% auto;
      padding: 30px;
      width: 400px;
      border-radius: 12px;
      text-align: center;
    }

    .url-input {
      width: 100%;
      padding: 12px;
      border: 2px solid #ddd;
      border-radius: 6px;
      margin: 15px 0;
      font-size: 14px;
    }

    .url-input:focus {
      outline: none;
      border-color: #3498db;
    }

    /* Alert messages */
    .alert {
      padding: 15px;
      margin: 20px 0;
      border-radius: 8px;
      font-size: 14px;
    }

    .alert-success {
      background: #d4edda;
      color: #155724;
      border: 1px solid #c3e6cb;
    }

    .alert-info {
      background: #d1ecf1;
      color: #0c5460;
      border: 1px solid #bee5eb;
    }
    .btn.active {
  background: #2c3e50;
  color: white;
}

.btn-small.active {
  background: #2c3e50;
  color: white;
}
  </style>
</head>
<body>
  <!-- Sidebar -->
  <nav class="sidebar">
    <div class="logo-section">
      <div class="logo-circle">G</div>
      <h3>Gestor</h3>
    </div>
    
    <ul class="nav-menu">
  <li class="nav-item active" data-section="agregar" onclick="showSection('agregar', event)">
    <span class="nav-icon">➕</span>
    <span>Agregar</span>
  </li>
  <li class="nav-item" data-section="editar" onclick="showSection('editar', event)">
    <span class="nav-icon">✏️</span>
    <span>Editar</span>
  </li>
  <li class="nav-item" data-section="visitas" onclick="showSection('visitas', event)">
    <span class="nav-icon">📊</span>
    <span>Visitas</span>
  </li>
  <li class="nav-item" data-section="opiniones" onclick="showSection('opiniones', event)">
    <span class="nav-icon">💬</span>
    <span>Opiniones</span>
  </li>
  <li class="nav-item" data-section="historial" onclick="showSection('historial', event)">
    <span class="nav-icon">📜</span>
    <span>Historial</span>
  </li>
  <li class="nav-item" data-section="pagina" onclick="showSection('pagina', event)">
    <span class="nav-icon">👁️</span>
    <span>Página</span>
  </li>
</ul>
  </nav>

  <!-- Main Content -->
  <main class="main-content">
    
    <!-- Agregar Contenido Section -->
    <section id="agregar" class="content-area">
      <div class="page-header">
        <h1 class="page-title">Agregar Contenido</h1>
        <p class="page-subtitle">Selecciona una plantilla y personalízala para tu página</p>
      </div>

      <div id="template-selection">
        <h3 style="margin-bottom: 20px; color: #2c3e50;">Seleccionar Plantilla</h3>
        
        <div class="template-grid">
          <div class="template-card" data-template="deportes" onclick="selectTemplate('deportes')">
            <div class="template-preview">
              <div style="background: linear-gradient(45deg, #DC343C, #049B4C); height: 100%; display: flex; align-items: center; justify-content: center; color: white; font-size: 24px;">🏃‍♂️</div>
            </div>
            <div class="template-info">
              <div class="template-name">Plantilla Deportes</div>
              <div class="template-description">Ideal para páginas de actividades deportivas, atletismo y actividades físicas del colegio.</div>
            </div>
            <div class="template-actions">
              <button class="btn btn-primary" onclick="selectTemplate('deportes')">Seleccionar</button>
              <button class="btn btn-secondary" onclick="previewTemplate('deportes')">Vista Previa</button>
            </div>
          </div>

          <div class="template-card" data-template="intercambio" onclick="selectTemplate('intercambio')">
            <div class="template-preview">
              <div style="background: linear-gradient(45deg, #0A2452, #DC343C); height: 100%; display: flex; align-items: center; justify-content: center; color: white; font-size: 24px;">🌍</div>
            </div>
            <div class="template-info">
              <div class="template-name">Plantilla Intercambio</div>
              <div class="template-description">Perfecta para mostrar programas de intercambio estudiantil y actividades internacionales.</div>
            </div>
            <div class="template-actions">
              <button class="btn btn-primary" onclick="selectTemplate('intercambio')">Seleccionar</button>
              <button class="btn btn-secondary" onclick="previewTemplate('intercambio')">Vista Previa</button>
            </div>
          </div>

          <div class="template-card" data-template="general" onclick="selectTemplate('general')">
            <div class="template-preview">
              <div style="background: linear-gradient(45deg, #1B2F6F, #D9D9D9); height: 100%; display: flex; align-items: center; justify-content: center; color: white; font-size: 24px;">📄</div>
            </div>
            <div class="template-info">
              <div class="template-name">Plantilla General</div>
              <div class="template-description">Diseño versátil para contenido general, noticias y información institucional.</div>
            </div>
            <div class="template-actions">
              <button class="btn btn-primary" onclick="selectTemplate('general')">Seleccionar</button>
              <button class="btn btn-secondary" onclick="previewTemplate('general')">Vista Previa</button>
            </div>
          </div>

          <div class="template-card" data-template="fotos" onclick="selectTemplate('fotos')">
            <div class="template-preview">
              <div style="background: linear-gradient(45deg, #0A2452, #2c3e50); height: 100%; display: flex; align-items: center; justify-content: center; color: white; font-size: 24px;">📸</div>
            </div>
            <div class="template-info">
              <div class="template-name">Plantilla Galería</div>
              <div class="template-description">Especial para mostrar galerías de fotos de eventos y actividades escolares.</div>
            </div>
            <div class="template-actions">
              <button class="btn btn-primary" onclick="selectTemplate('fotos')">Seleccionar</button>
              <button class="btn btn-secondary" onclick="previewTemplate('fotos')">Vista Previa</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Editor Container -->
      <div id="editor-container" class="editor-container">
        <div class="editor-header">
          <div class="editor-title">Editando: <span id="current-template-name"></span></div>
          <div class="editor-actions">
            <button class="btn btn-secondary" onclick="cancelEdit()">Cancelar</button>
            <button class="btn btn-success" onclick="savePage()">Agregar Página</button>
          </div>
        </div>
        
        <div class="template-container">
          <div id="template-frame" class="template-frame">
            <!-- Template content will be loaded here -->
          </div>
        </div>
      </div>
    </section>

    <!-- Other Sections -->
    <section id="editar" class="content-area" style="display: none;">
      <div class="page-header">
        <h1 class="page-title">Editar Contenido</h1>
        <p class="page-subtitle">Modifica o elimina el contenido existente de tus páginas</p>
      </div>
      
      <div id="pages-list-container">
        <h3 style="margin-bottom: 20px; color: #2c3e50;">Páginas Creadas</h3>
        <div style="margin-bottom: 20px;">
  <button class="btn btn-primary btn-small" onclick="setModo('editar')">✏️ Editar</button>
  <button class="btn btn-danger btn-small" onclick="setModo('eliminar')">🗑️ Eliminar</button>
  <div id="edit-page-btn-container" style="margin: 40px 0 20px 0; display: none;">
  <button class="btn btn-success" style="width: 100%; font-size: 16px;"
        onclick="goToIndexDirectly()">
    🌐 Ir a Sitio Principal
  </button>
</div>

</div>

        <div id="pages-list" class="template-grid">
          <!-- Pages will be loaded here -->
        </div>
        <div id="no-pages-message" class="alert alert-info">
          No tienes páginas creadas aún. Ve a la sección "Agregar" para crear tu primera página.
        </div>
      </div>
    </section>

    <section id="visitas" class="content-area" style="display: none;">
      <div class="page-header">
        <h1 class="page-title">Estadísticas de Visitas</h1>
        <p class="page-subtitle">Analiza el tráfico de tus páginas</p>
      </div>
      <div class="alert alert-info">
        Las estadísticas de visitas se implementarán con datos JSON como mencionaste.
      </div>
    </section>

    <section id="opiniones" class="content-area" style="display: none;">
      <div class="page-header">
        <h1 class="page-title">Opiniones</h1>
        <p class="page-subtitle">Gestiona comentarios y opiniones</p>
      </div>
      <div class="alert alert-info">
        Sistema de opiniones en desarrollo.
      </div>
    </section>

    <section id="historial" class="content-area" style="display: none;">
      <div class="page-header">
        <h1 class="page-title">Historial de Cambios</h1>
        <p class="page-subtitle">Revisa todos los cambios realizados</p>
      </div>
      <ul id="history-list" class="history-list">
        <li class="history-item">
          <div class="history-date">17/09/2025 - 10:30</div>
          <div class="history-action">Sistema iniciado</div>
          <div class="history-detail">Gestor de contenido inicializado correctamente</div>
        </li>
      </ul>
    </section>

    <section id="pagina" class="content-area" style="display: none;">
      <div class="page-header">
        <h1 class="page-title">Ver Página</h1>
        <p class="page-subtitle">Vista previa de tu sitio web</p>
      </div>
      <div class="alert alert-info">
        Aquí podrás ver una vista previa completa de tu sitio web una vez que tengas contenido creado.
      </div>
    </section>
  </main>

  <!-- Image URL Modal -->
  <div id="imageModal" class="modal">
    <div class="modal-content">
      <h3>Cambiar Imagen</h3>
      <p>Ingresa la URL de la nueva imagen:</p>
      <input type="text" id="imageUrl" class="url-input" placeholder="https://ejemplo.com/imagen.jpg">
      <div style="margin-top: 20px;">
        <button class="btn btn-primary" onclick="updateImage()">Actualizar</button>
        <button class="btn btn-secondary" onclick="closeImageModal()">Cancelar</button>
      </div>
    </div>
  </div>

  <script>
    let modoActual = "editar"; 
    let currentTemplate = null;
    let historyLog = [];
    let savedPages = JSON.parse(localStorage.getItem('savedPages')) || [];
    let currentEditingImage = null;
    let editingPageId = null; 



    document.addEventListener('DOMContentLoaded', function() {
  addToHistory('Sistema iniciado', 'Gestor de contenido cargado correctamente');
  console.log('Gestor de contenido iniciado');
  
  // Inicializar modo activo
  setModo('editar');
});


function openInSite(pageId) {
  // Abrir la página específica en modo visualización
  window.open('index.html?cms_admin_token=true&page_id=' + pageId, '_blank');
}


    function openFullPageEditor() {
  if (!editingPageId) {
    alert("Primero selecciona una página para editar.");
    return;
  }
  // Abrir el index con los parámetros para editar
  window.open('index.html?cms_admin_token=true&page_id=' + editingPageId, '_blank');
}

    function setModo(modo) {
  modoActual = modo;
  loadPagesList(); // refrescar la lista
  
  // Actualizar texto de botones
  const editBtn = document.querySelector('[onclick="setModo(\'editar\')"]');
  const deleteBtn = document.querySelector('[onclick="setModo(\'eliminar\')"]');
  
  if (modo === "editar") {
    editBtn.classList.add('active');
    deleteBtn.classList.remove('active');
    document.getElementById('edit-page-btn-container').style.display = "block";
  } else {
    editBtn.classList.remove('active');
    deleteBtn.classList.add('active');
    document.getElementById('edit-page-btn-container').style.display = "none";
  }
}

   const templates = {
      // Reemplazar la plantilla deportes en el objeto templates con esta versión editable:

deportes: {
  name: 'Plantilla Deportes',
  html: `
    <!-- Navigation (NO EDITABLE) -->
    <nav class="navbar">
        <div class="nav-container">
            <div class="nav-logo">
                <img src="fotos/logo.png" alt="Scuola Italiana di Montevideo">
            </div>
            <div class="nav-menu-button" onclick="window.location.href='menuScuola.html'">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero" style="background-image: url('https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80'); background-size: cover; background-position: center; background-repeat: no-repeat;">
            <div class="hero-overlay"></div>
            <span class="edit-tooltip">Click para cambiar fondo</span>
        </div>
        <div class="hero-content">
            <div class="hero-breadcrumb">
                <span>Deportes</span>
                <i class="fas fa-chevron-right"></i>
                <span class="current editable-text">Fútbol<span class="edit-tooltip">Click para editar</span></span>
            </div>
            <h1 class="hero-title editable-text">Fútbol<span class="edit-tooltip">Click para editar</span></h1>
            <p class="hero-subtitle editable-text">Desarrollando talento y pasión por el deporte más popular del mundo<span class="edit-tooltip">Click para editar</span></p>
        </div>
    </section>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Sport Introduction -->
        <section class="sport-intro">
            <div class="container">
                <div class="intro-grid">
                    <div class="intro-text">
                        <div class="section-tag">
                            <span class="editable-text">DEPORTE DESTACADO<span class="edit-tooltip">Click para editar</span></span>
                        </div>
                        <h2 class="editable-text">Excelencia en cada jugada<span class="edit-tooltip">Click para editar</span></h2>
                        <p class="intro-description editable-text">En la Scuola Italiana fomentamos el desarrollo integral a través del deporte. Nuestro programa de fútbol combina técnica, estrategia y valores para formar no solo buenos jugadores, sino mejores personas.<span class="edit-tooltip">Click para editar</span></p>
                    </div>
                    <div class="intro-visual">
                        <div class="visual-card">
                            <img class="editable-image" src="https://images.unsplash.com/photo-1544551763-46a013bb70d5?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Fútbol en acción">
                            <span class="edit-tooltip">Click para cambiar imagen</span>
                            <div class="visual-overlay">
                                <i class="fas fa-running"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="features">
            <div class="container">
                <h2 class="section-title editable-text">Nuestro enfoque deportivo<span class="edit-tooltip">Click para editar</span></h2>
                <div class="features-grid">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <h3 class="editable-text">Excelencia deportiva<span class="edit-tooltip">Click para editar</span></h3>
                        <p class="editable-text">Fomentamos la búsqueda constante de la mejora personal y el logro de metas deportivas.<span class="edit-tooltip">Click para editar</span></p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3 class="editable-text">Trabajo en equipo<span class="edit-tooltip">Click para editar</span></h3>
                        <p class="editable-text">Desarrollamos habilidades sociales y de colaboración a través del deporte grupal.<span class="edit-tooltip">Click para editar</span></p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-heart"></i>
                        </div>
                        <h3 class="editable-text">Bienestar integral<span class="edit-tooltip">Click para editar</span></h3>
                        <p class="editable-text">Promovemos una mejor calidad de vida física y mental en nuestros estudiantes.<span class="edit-tooltip">Click para editar</span></p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Gallery Section -->
        <section class="gallery">
            <div class="container">
                <h2 class="section-title editable-text">Momentos destacados<span class="edit-tooltip">Click para editar</span></h2>
                <div class="gallery-grid">
                    <div class="gallery-item large">
                        <img class="editable-image" src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Fútbol 1">
                        <span class="edit-tooltip">Click para cambiar imagen</span>
                        <div class="gallery-overlay">
                            <h4 class="editable-text">Campeonato Intercolegial<span class="edit-tooltip">Click para editar</span></h4>
                            <p class="editable-text">Nuestros estudiantes demostraron su talento y dedicación<span class="edit-tooltip">Click para editar</span></p>
                        </div>
                    </div>
                    <div class="gallery-item">
                        <img class="editable-image" src="https://images.unsplash.com/photo-1544551763-46a013bb70d5?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Fútbol 2">
                        <span class="edit-tooltip">Click para cambiar imagen</span>
                        <div class="gallery-overlay">
                            <h4 class="editable-text">Entrenamiento diario<span class="edit-tooltip">Click para editar</span></h4>
                        </div>
                    </div>
                    <div class="gallery-item">
                        <img class="editable-image" src="https://images.unsplash.com/photo-1552674605-db6ffd4facb5?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Fútbol 3">
                        <span class="edit-tooltip">Click para cambiar imagen</span>
                        <div class="gallery-overlay">
                            <h4 class="editable-text">Trabajo en equipo<span class="edit-tooltip">Click para editar</span></h4>
                        </div>
                    </div>
                    <div class="gallery-item">
                        <img class="editable-image" src="https://images.unsplash.com/photo-1517649763962-0c623066013b?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Fútbol 4">
                        <span class="edit-tooltip">Click para cambiar imagen</span>
                        <div class="gallery-overlay">
                            <h4 class="editable-text">Celebrando victorias<span class="edit-tooltip">Click para editar</span></h4>
                        </div>
                    </div>
                    <div class="gallery-item">
                        <img class="editable-image" src="https://images.unsplash.com/photo-1594736797933-d0dda7477660?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Fútbol 5">
                        <span class="edit-tooltip">Click para cambiar imagen</span>
                        <div class="gallery-overlay">
                            <h4 class="editable-text">Formación deportiva<span class="edit-tooltip">Click para editar</span></h4>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
  `,
  css: `
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', sans-serif;
        line-height: 1.6;
        color: #333;
        overflow-x: hidden;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    /* Navigation (NO EDITABLE) */
    .navbar {
    position: relative; /* CAMBIO: de fixed a relative */
    top: 0;
    left: 0;
    right: 0;
    background: rgba(10, 36, 82, 0.5);
    z-index: 1000;
    transition: all 0.3s ease, transform 0.3s ease, opacity 0.3s ease;
}

    .nav-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 5%;
        max-width: 1200px;
        margin: 0 auto;
    }

    .nav-logo img {
        height: 50px;
        width: auto;
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

    /* Hero Section */
    .hero {
        position: relative;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .hero-background-container {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
    }

    .hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: transparent; /* Sin overlay, o usa rgba(0, 0, 0, 0.1) para un overlay muy sutil */
    z-index: 2;
}

    .hero-content {
        position: relative;
        z-index: 3;
        text-align: center;
        color: white;
        animation: fadeInUp 1s ease-out;
    }

    .hero-breadcrumb {
        font-size: 14px;
        margin-bottom: 20px;
        opacity: 0.9;
    }

    .hero-breadcrumb .current {
        color: #F39C12;
        font-weight: 600;
    }

    .hero-title {
        font-size: clamp(3rem, 8vw, 6rem);
        font-weight: 700;
        margin-bottom: 20px;
        font-family: 'Merriweather', serif;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    }

    .hero-subtitle {
        font-size: 1.2rem;
        max-width: 600px;
        margin: 0 auto;
        opacity: 0.9;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
    }

    /* Main Content */
    .main-content {
        position: relative;
        z-index: 10;
    }

    /* Sport Introduction */
    .sport-intro {
        padding: 100px 0;
        background: white;
    }

    .intro-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 80px;
        align-items: center;
    }

    .section-tag {
        display: inline-block;
        background: linear-gradient(135deg, #3B69BA, #DC343C);
        color: white;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: 1px;
        margin-bottom: 20px;
    }

    .intro-text h2 {
        font-size: 2.5rem;
        font-weight: 700;
        color: #3B69BA;
        margin-bottom: 30px;
        font-family: 'Merriweather', serif;
        line-height: 1.2;
    }

    .intro-description {
        font-size: 1.1rem;
        color: #666;
        margin-bottom: 40px;
        line-height: 1.8;
    }

    .visual-card {
        position: relative;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
    }

    .visual-card:hover {
        transform: translateY(-10px);
    }

    .visual-card img {
        width: 100%;
        height: 400px;
        object-fit: cover;
    }

    .visual-overlay {
        position: absolute;
        top: 20px;
        right: 20px;
        width: 60px;
        height: 60px;
        background: rgba(243, 156, 18, 0.9);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .visual-overlay i {
        color: white;
        font-size: 24px;
    }

    /* Features Section */
    .features {
        padding: 100px 0;
        background: #f8f9fa;
    }

    .section-title {
        text-align: center;
        font-size: 2.5rem;
        font-weight: 700;
        color: #3B69BA;
        margin-bottom: 60px;
        font-family: 'Merriweather', serif;
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 40px;
    }

    .feature-card {
        background: white;
        padding: 40px;
        border-radius: 15px;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        border-top: 4px solid transparent;
    }

    .feature-card:hover {
        transform: translateY(-10px);
        border-top-color: #F39C12;
        box-shadow: 0 20px 60px rgba(0,0,0,0.15);
    }

    .feature-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #3B69BA, #DC343C);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        transition: all 0.3s ease;
    }

    .feature-card:hover .feature-icon {
        transform: scale(1.1);
    }

    .feature-icon i {
        color: white;
        font-size: 32px;
    }

    .feature-card h3 {
        font-size: 1.3rem;
        font-weight: 600;
        color: #3B69BA;
        margin-bottom: 15px;
    }

    .feature-card p {
        color: #666;
        line-height: 1.6;
    }

    /* Gallery Section */
    .gallery {
        padding: 100px 0;
        background: white;
    }

    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
    }

    .gallery-item {
        position: relative;
        border-radius: 15px;
        overflow: hidden;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .gallery-item.large {
        grid-column: span 2;
        grid-row: span 2;
    }

    .gallery-item:hover {
        transform: scale(1.02);
    }

    .gallery-item img {
        width: 100%;
        height: 250px;
        object-fit: cover;
        transition: all 0.3s ease;
    }

    .gallery-item.large img {
        height: 520px;
    }

    .gallery-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(transparent, rgba(0,0,0,0.8));
        color: white;
        padding: 30px 20px 20px;
        transform: translateY(100%);
        transition: all 0.3s ease;
    }

    .gallery-item:hover .gallery-overlay {
        transform: translateY(0);
    }

    .gallery-overlay h4 {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 5px;
    }

    /* Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .intro-grid {
            grid-template-columns: 1fr;
            gap: 40px;
        }

        .features-grid {
            grid-template-columns: 1fr;
        }

        .gallery-item.large {
            grid-column: span 1;
            grid-row: span 1;
        }

        .gallery-item.large img {
            height: 250px;
        }
    }

    /* Estilos de edición */
    .editable-text {
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
    }

    .editable-text:hover {
        background: rgba(52, 152, 219, 0.1);
        outline: 2px dashed #3498db;
        outline-offset: 2px;
    }

    .editable-text.editing {
        background: rgba(52, 152, 219, 0.1);
        outline: 2px solid #3498db;
    }

    .editable-image {
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
    }

    .editable-image:hover {
        opacity: 0.8;
        outline: 3px dashed #3498db;
        outline-offset: 2px;
    }

    .hero-background-container:hover {
        opacity: 0.9;
        outline: 3px dashed #F39C12;
        outline-offset: -5px;
    }


    .edit-tooltip {
        position: absolute;
        top: -30px;
        left: 50%;
        transform: translateX(-50%);
        background: #2c3e50;
        color: white;
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 12px;
        opacity: 0;
        transition: opacity 0.3s ease;
        white-space: nowrap;
        z-index: 1000;
    }

    .editable-text:hover .edit-tooltip,
    .editable-image:hover .edit-tooltip {
        opacity: 1;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
        /* Deshabilitar selección de texto para visitantes */
* {
    user-select: none !important;
    -webkit-user-select: none !important;
    -moz-user-select: none !important;
}

input, textarea {
    user-select: text !important;
}

/* Asegurar que los enlaces sigan siendo funcionales */
a {
    cursor: pointer;
}
  `

},
      intercambio: {
        name: 'Plantilla Intercambio',
        html: `
          <div class="exchange-page">
            <img class="bg-main editable-image" src="https://placehold.co/1440x2130" alt="Fondo principal" />
            <div class="top-bar"></div>
            <img class="logo editable-image" src="https://placehold.co/301x106" alt="Logo" />
            <img class="menu-icon editable-image" src="https://placehold.co/75x75" alt="Icono menú" />

            <h1 class="exchange-title editable-text">Intercambio a EEUU<span class="edit-tooltip">Click para editar</span></h1>

            <div class="card-left"></div>
            <img class="card-left-img editable-image" src="https://placehold.co/393x215" alt="Intercambio imagen" />
            <div class="card-left-overlay"></div>
            <div class="card-left-text editable-text">Intercambio<span class="edit-tooltip">Click para editar</span></div>

            <img class="card-right-img editable-image" src="https://placehold.co/393x215" alt="EEUU imagen" />
            <div class="card-right-overlay"></div>
            <div class="card-right-text editable-text">EEUU<span class="edit-tooltip">Click para editar</span></div>

            <img class="main-photo editable-image" src="https://placehold.co/828x600" alt="Foto intercambio" />

            <div class="description editable-text">
              La Scuola realiza varios intercambios culturales y deportivos: <br/>
              los alumnos de 6º año de Primaria/1ª Media con Park Tudor School, <br/>
              Indianapolis (USA);<br/>
              los alumnos de 6º año de Primaria y Secundaria I Ciclo participan del intercambio con el Instituto CCI de Olivos (Buenos Aires)<br/>
              en el marco de los Juegos de la Juventud organizados por el CONI (Comitato Olimpico Nazionale Italiano);<br/>
              alumnos de las clases II e III del Liceo Italiano con el Instituto Tosi de Busto Arsizio (Italia).<br/>
              <span class="edit-tooltip">Click para editar</span>
            </div>

            <img class="small-icon editable-image" src="https://placehold.co/114x150" alt="Icono pequeño" />

            <a href="#" class="btn-photos">
                <span class="btn-photos-text editable-text">Fotos<span class="edit-tooltip">Click para editar</span></span>
            </a>

            <img class="footer-img editable-image" src="https://placehold.co/1440x408" alt="Footer" />
          </div>`,
        css: `
          .exchange-page { width: 1377px; height: 4652px; position: relative; background: white; overflow: hidden; }
          .bg-main { width: 1440px; height: 2130px; position: absolute; left: 0; top: 0; }
          .top-bar { width: 1440px; height: 200px; position: absolute; left: 0; top: 0; background: #0A2452; opacity: 0.5; }
          .logo { width: 300.69px; height: 106px; position: absolute; left: 47px; top: 47px; }
          .menu-icon { width: 75px; height: 75px; position: absolute; left: 1278px; top: 63px; }
          .exchange-title { position: absolute; left: 257px; top: 2779px; font-size: 100px; font-family: "Merriweather Sans", sans-serif; font-weight: 400; color: black; text-align: right; }
          .card-left { width: 380px; height: 318px; position: absolute; left: 565px; top: 2999px; background: #DC343C; border-radius: 15px; }
          .card-left-img { width: 393px; height: 215px; position: absolute; left: 552px; top: 2999px; border-radius: 15px; }
          .card-left-overlay { width: 392px; height: 318px; position: absolute; left: 553px; top: 2999px; background: #DC343C; border-radius: 15px; opacity: 0.5; }
          .card-left-text { width: 366px; height: 148px; position: absolute; left: 566px; top: 2999px; text-align: center; color: white; font-size: 64px; font-family: "Hermeneus One", sans-serif; font-weight: 400; }
          .card-right-img { width: 393px; height: 215px; position: absolute; left: 1000px; top: 3718px; border-radius: 15px; }
          .card-right-overlay { width: 392px; height: 318px; position: absolute; left: 1001px; top: 3615px; background: #DC343C; border-radius: 15px; opacity: 0.5; }
          .card-right-text { width: 366px; height: 148px; position: absolute; left: 1014px; top: 3802px; text-align: center; color: white; font-size: 64px; font-family: "Hermeneus One", sans-serif; font-weight: 400; }
          .main-photo { width: 828px; height: 600px; position: absolute; left: 553px; top: 3119px; border-radius: 20px; }
          .description { width: 494px; position: absolute; left: 26px; top: 2942px; font-size: 40px; font-family: "Merriweather Sans", sans-serif; font-weight: 400; color: black; text-align: right; }
          .small-icon { width: 114px; height: 150px; position: absolute; left: 1263px; top: 3934px; }
          .btn-photos-text { position: absolute; left: 710px; top: 3868px; font-size: 48px; font-family: "Hermeneus One", sans-serif; font-weight: 400; color: white; }
          .btn-photos { width: 259px; height: 80px; position: absolute; left: 631px; top: 3865px; background: #DC343C; border-radius: 40px; }
          .footer-img { width: 1440px; height: 408px; position: absolute; left: 0; top: 4243px; }
        `
      },
      general: {
        name: 'Plantilla General',
        html: `
          <div class="container">
            <img class="absolute editable-image" style="width: 1370px; height: 1044px; left: 0; top: -6px;" src="https://placehold.co/1370x1044" alt="Fondo">
            <div class="absolute overlay"></div>

            <img class="absolute editable-image" style="width: 300px; height: 106px; left: 47px; top: 47px;" src="https://placehold.co/300x106" alt="Logo">
            <img class="absolute editable-image" style="width: 75px; height: 75px; left: 1259px; top: 78px;" src="https://placehold.co/75x75" alt="Icono">

            <img class="absolute editable-image" style="width: 114px; height: 150px; left: 1168px; top: 3719px;" src="https://placehold.co/114x150" alt="Imagen extra">

            <div class="absolute gradient"></div>
            <div class="absolute blue-box"></div>
            <img class="absolute editable-image" style="width: 803px; height: 534px; left: 45px; top: 2232px; border-radius: 40px;" src="https://placehold.co/803x534" alt="Imagen sobre azul">

            <div class="absolute text-white editable-text" style="left: 80px; top: 1342px;">
              AAAAAAAAaaaa<br/>aaaaaaaaaaaaaaa<br/>aaa<br/>AAAAAAAAaaaa<br/>aaaaaaaaaaaaaaa<br/>aaaAAAAAAAAaaaa<br/>aaaaaaaaaaaaaaa<br/>aaa
              <span class="edit-tooltip">Click para editar</span>
            </div>
            <div class="absolute text-white editable-text" style="left: 928px; top: 2240px;">
              AAAAAAAAaaaa<br/>aaaaaaaaaaaaaaa<br/>aaa<br/>AAAAAAAAaaaa<br/>aaaaaaaaaaaaaaa<br/>aaaAAAAAAAAaaaa<br/>aaaaaaaaaaaaaaa<br/>aaa
              <span class="edit-tooltip">Click para editar</span>
            </div>

            <div class="absolute tag-red editable-text" style="width: 140px; height: 48px; left: 1119px; top: 1121px;">Scuola Paradiso Ecologico<span class="edit-tooltip">Click para editar</span></div>
            <div class="absolute tag-gray editable-text" style="width: 264px; height: 48px; left: 583px; top: 1126px;">Heliopolis<span class="edit-tooltip">Click para editar</span></div>
            <div class="absolute tag-gray editable-text" style="width: 315px; height: 48px; left: 80px; top: 1121px;">Arccimboldo<span class="edit-tooltip">Click para editar</span></div>
          </div>`,
        css: `
          .container { width: 1369px; height: 4463px; position: relative; overflow: hidden; margin: 0 auto; background: white; }
          .absolute { position: absolute; }
          .overlay { width: 1440px; height: 200px; left: 0px; top: 0px; opacity: 0.5; background: #0A2452; }
          .gradient { width: 1370px; height: 2444px; left: 0px; top: 1038px; background: linear-gradient(178deg, #1B2F6F 0%, white 100%); }
          .blue-box { width: 768px; height: 498px; left: 13px; top: 2182px; background: #1B2F6F; border-radius: 40px; }
          .gray-box { background: #D9D9D9; border-radius: 15px; }
          .text-white { color: white; font-size: 48px; font-family: Ubuntu, sans-serif; font-weight: 400; word-wrap: break-word; }
          .text-dark { color: #373737; font-size: 48px; font-family: Ubuntu, sans-serif; font-weight: 400; }
          .text-gray { color: #716E6E; font-size: 38px; font-family: Ubuntu, sans-serif; font-weight: 400; }
          .tag-red { color: #DC343C; font-size: 15px; font-family: 'Crimson Pro', serif; font-weight: 900; line-height: 16px; letter-spacing: 0.5px; text-align: center; display: flex; justify-content: center; flex-direction: column; }
          .tag-gray { color: #716E6E; font-size: 15px; font-family: 'Crimson Pro', serif; font-weight: 900; line-height: 16px; letter-spacing: 0.5px; text-align: center; display: flex; justify-content: center; flex-direction: column; }
        `
      },
      fotos: {
        name: 'Plantilla Galería de Fotos',
        html: `
          <div class="photos-page">
            <img class="banner editable-image" src="https://placehold.co/1440x2349" alt="Banner principal">
            <div class="overlay"></div>
            <div class="top-bar"></div>
            <img class="logo editable-image" src="https://placehold.co/301x106" alt="Logo">
            <img class="menu-icon editable-image" src="https://placehold.co/75x75" alt="Menú">

            <img class="small-icon editable-image" src="https://placehold.co/114x150" alt="Icono pequeño">

            <img class="gallery-img img1 editable-image" src="https://placehold.co/600x600" alt="Foto 1">
            <img class="gallery-img img2 editable-image" src="https://placehold.co/600x600" alt="Foto 2">
            <img class="gallery-img img3 editable-image" src="https://placehold.co/600x600" alt="Foto 3">
            <img class="gallery-img img4 editable-image" src="https://placehold.co/600x600" alt="Foto 4">
            <img class="gallery-img img5 editable-image" src="https://placehold.co/600x600" alt="Foto 5">
            <img class="gallery-img img6 editable-image" src="https://placehold.co/600x600" alt="Foto 6">

            <img class="btn-more editable-image" src="https://placehold.co/404x68" alt="Ver más imágenes">
            <img class="footer-img editable-image" src="https://placehold.co/1440x408" alt="Pie de página">
          </div>`,
        css: `
          .photos-page { width: 1383px; height: 4466px; position: relative; background: white; overflow: hidden; }
          .banner { width: 1440px; height: 2349px; position: absolute; left: 0; top: 0; }
          .overlay { width: 1440px; height: 2782px; position: absolute; left: 0; top: 1276px; background: #0A2452; }
          .top-bar { width: 1440px; height: 200px; position: absolute; left: 0; top: 0; background: #0A2452; opacity: 0.5; }
          .logo { width: 301px; height: 106px; position: absolute; left: 47px; top: 47px; }
          .menu-icon { width: 75px; height: 75px; position: absolute; left: 1261px; top: 63px; }
          .small-icon { width: 114px; height: 150px; position: absolute; left: 1222px; top: 3814px; }
          .gallery-img { width: 600px; height: 600px; position: absolute; border-radius: 30px; object-fit: cover; }
          .img1 { left: 78px; top: 1560px; }
          .img2 { left: 736px; top: 1560px; }
          .img3 { left: 78px; top: 2222px; }
          .img4 { left: 736px; top: 2222px; }
          .img5 { left: 78px; top: 2884px; }
          .img6 { left: 720px; top: 2884px; }
          .btn-more { width: 404px; height: 68px; position: absolute; left: 146px; top: 3821px; }
          .footer-img { width: 1440px; height: 408px; position: absolute; left: 0; top: 4058px; }
        `
      }
    };

    // Navigation functions
    function showSection(sectionId, evt) {
  // Ocultar todas las secciones
  const sections = document.querySelectorAll('.content-area');
  sections.forEach(section => section.style.display = 'none');

  // Quitar active de todos los nav items
  const navItems = document.querySelectorAll('.nav-item');
  navItems.forEach(item => item.classList.remove('active'));

  // Mostrar la sección solicitada (si existe)
  const sectionEl = document.getElementById(sectionId);
  if (sectionEl) sectionEl.style.display = 'block';

  // Si entramos a "editar", recargar la lista de páginas
  if (sectionId === 'editar') {
    loadPagesList();
  }

  // Poner active en el nav item:
  if (evt && evt.target) {
    const navItem = evt.target.closest('.nav-item');
    if (navItem) navItem.classList.add('active');
  } else {
    // Si no hay evento (llamada programática), buscamos por data-section
    const navItem = document.querySelector(`.nav-item[data-section="${sectionId}"]`);
    if (navItem) navItem.classList.add('active');
  }
}


    // Template selection functions
    function selectTemplate(templateId) {
      currentTemplate = templateId;
      
      // Remove selection from other cards
      document.querySelectorAll('.template-card').forEach(card => {
        card.classList.remove('selected');
      });
      
      // Add selection to current card
      document.querySelector(`[data-template="${templateId}"]`).classList.add('selected');
      
      // Load template in editor
      loadTemplateEditor(templateId);
    }

    function previewTemplate(templateId) {
      // For now, just select the template
      selectTemplate(templateId);
    }

    function loadTemplateEditor(templateId) {
  const template = templates[templateId];
  if (!template) {
    alert('Plantilla no encontrada: ' + templateId);
    cancelEdit();
    return;
  }

      // Show editor container
      document.getElementById('template-selection').style.display = 'none';
      document.getElementById('editor-container').style.display = 'block';
      
      // Update editor title
      document.getElementById('current-template-name').textContent = template.name;
      
      // Load template content
      const frame = document.getElementById('template-frame');
      frame.innerHTML = `
        <style>${template.css}</style>
        ${template.html}
      `;
      
      // Setup editable functionality
      // Hacer el fondo del hero editable
setupEditableElements();

// Hacer el fondo del hero editable
const heroSection = document.querySelector('.hero');
if (heroSection) {
    heroSection.classList.add('editable-background');
    heroSection.addEventListener('click', function(e) {
        if (e.target === heroSection || e.target.classList.contains('hero-background-container') || e.target.classList.contains('hero-overlay')) {
            editHeroBackground();
        }
    });
}
      
      // Add to history
      addToHistory('Plantilla cargada', `Se cargó la ${template.name} para edición`);
    }

    // Agregar después de la función setupEditableElements()
// Agregar después de la función setupEditableElements()
function editHeroBackground() {
  // Buscar el elemento hero section
  const heroSection = document.querySelector('.hero');
  if (heroSection) {
    currentEditingImage = heroSection; // Reutilizar la variable existente
    
    // Obtener la URL actual del background-image
    const currentBg = heroSection.style.backgroundImage;
    let currentUrl = '';
    if (currentBg) {
      // Extraer URL del formato url("...")
      const match = currentBg.match(/url\("(.+)"\)/);
      if (match) currentUrl = match[1];
    }
    
    document.getElementById('imageUrl').value = currentUrl;
    document.getElementById('imageModal').style.display = 'block';
  }
}

// Modificar la función updateImage() existente para manejar background images

    function editText(element) {
      // Remove tooltip
      const tooltip = element.querySelector('.edit-tooltip');
      if (tooltip) tooltip.remove();
      
      // Get current text content without the tooltip
      const currentText = element.textContent.replace('Click para editar', '').trim();
      
      // Create input field
      const input = document.createElement('textarea');
      input.style.cssText = `
        width: 100%;
        height: auto;
        min-height: 100px;
        font-size: inherit;
        font-family: inherit;
        color: inherit;
        background: rgba(255,255,255,0.9);
        border: 2px solid #3498db;
        border-radius: 4px;
        padding: 10px;
        resize: vertical;
      `;
      input.value = currentText;
      
      // Replace element content
      const originalContent = element.innerHTML;
      element.innerHTML = '';
      element.appendChild(input);
      element.classList.add('editing');
      
      // Focus input
      input.focus();
      input.select();
      
      // Handle save
      const saveEdit = () => {
        const newText = input.value;
        element.innerHTML = newText + '<span class="edit-tooltip">Click para editar</span>';
        element.classList.remove('editing');
        
        addToHistory('Texto editado', `Se modificó el contenido de texto`);
      };
      const cancelEdit = () => {
        element.innerHTML = originalContent;
        element.classList.remove('editing');
      };
      
      // Event handlers
      input.addEventListener('blur', saveEdit);
      input.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' && e.ctrlKey) {
          saveEdit();
        } else if (e.key === 'Escape') {
          cancelEdit();
        }
      });
    }
    function setupEditableElements() {
    // Setup text editing
    const editableTexts = document.querySelectorAll('.editable-text');
    editableTexts.forEach(element => {
        element.addEventListener('click', function(e) {
            e.preventDefault();
            editText(this);
        });
    });
    function editImage(element) {
    currentEditingImage = element;
    document.getElementById('imageUrl').value = element.src;
    document.getElementById('imageModal').style.display = 'block';
}

    // Setup image editing
    const editableImages = document.querySelectorAll('.editable-image');
    editableImages.forEach(element => {
        element.addEventListener('click', function(e) {
            e.preventDefault();
            editImage(this);
        });
    });
}
function updateImage() {
    const newUrl = document.getElementById('imageUrl').value;
    if (currentEditingImage && newUrl) {
        if (currentEditingImage.classList.contains('hero')) {
            currentEditingImage.style.backgroundImage = `url("${newUrl}")`;
        } else {
            currentEditingImage.src = newUrl;
        }
        closeImageModal();
        addToHistory('Imagen actualizada', `Se cambió una imagen por: ${newUrl.substring(0, 50)}...`);
    }
}

   function editHeroBackground() {
    const heroSection = document.querySelector('.hero');
    if (heroSection) {
        currentEditingImage = heroSection;
        
        // Obtener la URL actual del background
        const currentBg = heroSection.style.backgroundImage;
        let currentUrl = '';
        if (currentBg) {
            const match = currentBg.match(/url\(["']?(.+?)["']?\)/);
            if (match) currentUrl = match[1];
        }
        
        document.getElementById('imageUrl').value = currentUrl;
        document.getElementById('imageModal').style.display = 'block';
    }
}

    function closeImageModal() {
      document.getElementById('imageModal').style.display = 'none';
      currentEditingImage = null;
    }

    function cancelEdit() {
      document.getElementById('template-selection').style.display = 'block';
      document.getElementById('editor-container').style.display = 'none';
      currentTemplate = null;
      
      // Remove selection
      document.querySelectorAll('.template-card').forEach(card => {
        card.classList.remove('selected');
      });
    }

    function savePage() {
  if (!currentTemplate) return;

  const frame = document.getElementById('template-frame');
  frame.querySelectorAll('.edit-tooltip').forEach(el => el.remove());
  const templateContent = frame.innerHTML;

  if (editingPageId) {
    // 🔹 Actualizar página existente
    const pageIndex = savedPages.findIndex(p => p.id === editingPageId);
    if (pageIndex !== -1) {
      savedPages[pageIndex].content = templateContent;
      savedPages[pageIndex].lastModified = new Date().toLocaleString();
    }
    addToHistory('Página actualizada', `Se actualizó la página: ${savedPages[pageIndex].name}`);
    editingPageId = null; // reset
  } else {
    // 🔹 Crear nueva página
    const pageData = {
      id: Date.now(),
      template: currentTemplate,
      name: templates[currentTemplate].name,
      content: templateContent,
      created: new Date().toLocaleString(),
      lastModified: new Date().toLocaleString()
    };
    savedPages.push(pageData);
    addToHistory('Página guardada', `Se agregó una nueva página: ${pageData.name}`);
  }

  // Guardar en localStorage
  localStorage.setItem('savedPages', JSON.stringify(savedPages));

  // Mensaje de confirmación
  const editorContainer = document.getElementById('editor-container');
  const alertHtml = `
    <div class="alert alert-success" style="margin: 20px 0;">
      ✅ ¡Cambios guardados correctamente!
    </div>
  `;
  editorContainer.insertAdjacentHTML('afterbegin', alertHtml);
  setTimeout(() => {
    const alert = editorContainer.querySelector('.alert-success');
    if (alert) alert.remove();
  }, 3000);

  // Volver al selector
  setTimeout(() => {
    cancelEdit();
  }, 1500);
}


    function addToHistory(action, detail) {
      const historyItem = {
        date: new Date().toLocaleString(),
        action: action,
        detail: detail
      };
      
      historyLog.unshift(historyItem);
      
      // Update history display
      updateHistoryDisplay();
    }

    function updateHistoryDisplay() {
      const historyList = document.getElementById('history-list');
      
      // Keep only last 50 items
      if (historyLog.length > 50) {
        historyLog = historyLog.slice(0, 50);
      }
      
      historyList.innerHTML = historyLog.map(item => `
        <li class="history-item">
          <div class="history-date">${item.date}</div>
          <div class="history-action">${item.action}</div>
          <div class="history-detail">${item.detail}</div>
        </li>
      `).join('');
    }

    // Modal close on outside click
    window.addEventListener('click', function(e) {
      const modal = document.getElementById('imageModal');
      if (e.target === modal) {
        closeImageModal();
      }
    });

    // Pages management functions
    function loadPagesList() {
      const pagesList = document.getElementById('pages-list');
      const noPages = document.getElementById('no-pages-message');
      
      if (savedPages.length === 0) {
        pagesList.style.display = 'none';
        noPages.style.display = 'block';
        return;
      }
      
      pagesList.style.display = 'grid';
      noPages.style.display = 'none';
      
      pagesList.innerHTML = savedPages.map(page => `
        <div class="template-card" data-page-id="${page.id}">
          <div class="template-preview">
            <div style="background: linear-gradient(45deg, #3498db, #2980b9); height: 100%; display: flex; align-items: center; justify-content: center; color: white; font-size: 18px;">
              ${getTemplateIcon(page.template)}
            </div>
          </div>
          <div class="template-info">
            <div class="template-name">${page.name}</div>
            <div class="template-description">function editPage
              Creada: ${page.created}<br>
              Última modificación: ${page.lastModified}
            </div>
          </div>
         <div class="template-actions">
  <div class="template-actions">
  <button class="btn btn-secondary btn-small" onclick="openInSite(${page.id})">🔗 Abrir en sitio</button>
  ${modoActual === "editar" 
    ? `<button class="btn btn-primary btn-small" onclick="editPage(${page.id})">Editar en gestor</button>`
    : `<button class="btn btn-danger btn-small" onclick="confirmDeletePage(${page.id}, '${page.name}')">Eliminar</button>`
  }
</div>

        </div>
      `).join('');
    }

    function getTemplateIcon(template) {
      const icons = {
        deportes: '🏃‍♂️',
        intercambio: '🌍', 
        general: '📄',
        fotos: '📸'
      };
      return icons[template] || '📄';
    }

    function editPage(pageId) {
  const page = savedPages.find(p => p.id === pageId);
  if (!page) return;
  
  editingPageId = pageId; // Esto debe estar aquí
  
  // Cambiar a sección "Agregar"
  showSection('agregar');
  
  // Marcar plantilla actual
  currentTemplate = page.template;
  const templateCard = document.querySelector(`[data-template="${page.template}"]`);
  if (templateCard) {
    templateCard.classList.add('selected');
  } else {
    console.error('Plantilla no encontrada:', page.template);
    return;
  }
  
  // Resto del código...
}


    function confirmDeletePage(pageId, pageName) {
      if (confirm(`¿Estás seguro de que quieres eliminar la página "${pageName}"?\n\nEsta acción no se puede deshacer.`)) {
        deletePage(pageId, pageName);
      }
    }

    function deletePage(pageId, pageName) {
  // Sacar la página del array
  savedPages = savedPages.filter(page => page.id !== pageId);

  // Guardar cambios en localStorage (🔥 acá va la clave)
  localStorage.setItem('savedPages', JSON.stringify(savedPages));
  
  // Refrescar lista
  loadPagesList();
  
  // Historial
  addToHistory('Página eliminada', `Se eliminó la página: ${pageName}`);
  
  // Mensaje de confirmación
  const container = document.getElementById('pages-list-container');
  const alertHtml = `
    <div class="alert alert-success" style="margin: 20px 0;">
      ✅ Página "${pageName}" eliminada correctamente.
    </div>
  `;
  container.insertAdjacentHTML('afterbegin', alertHtml);
  
  // Quitar mensaje a los 3 segundos
  setTimeout(() => {
    const alert = container.querySelector('.alert-success');
    if (alert) alert.remove();
  }, 3000);
}

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
      addToHistory('Sistema iniciado', 'Gestor de contenido cargado correctamente');
      console.log('Gestor de contenido iniciado');
    });

    window.addEventListener('message', (ev) => {
  if (ev.origin !== location.origin) return;
  const data = ev.data;
  if (data && data.type === 'cms_saved') {
    // recargar savedPages desde localStorage y refrescar UI
    savedPages = JSON.parse(localStorage.getItem('savedPages')) || [];
    if (document.getElementById('pages-list')) loadPagesList();
  }
});
function goToIndexDirectly() {
  window.open('index.html?cms_admin_token=true', '_blank');
}

  </script>
</body>
</html>