(function() {
    // Detectar si es administrador
    const urlParams = new URLSearchParams(window.location.search);
    const isAdmin = urlParams.get('cms_admin_token') === 'true';
    const pageId = urlParams.get('page_id');
    
    if (!isAdmin) return; // Si no es admin, no hacer nada
    
    // NUEVO: Cargar página específica si hay page_id
    // NUEVO: Cargar página específica si hay page_id
function loadSpecificPage() {
    if (!pageId) return;
    
    // Ocultar contenido original inmediatamente
    document.body.classList.add('loading-cms-content');
    
    const savedPages = JSON.parse(localStorage.getItem('savedPages')) || [];
    const page = savedPages.find(p => p.id == pageId);
    
    if (page && page.content) {
        // Cargar contenido de la página
        const cmsRoot = document.getElementById('cms-root');
        if (cmsRoot) {
            cmsRoot.innerHTML = page.content;
            
            // Actualizar título
            document.title = page.name + ' - Scuola Italiana di Montevideo';
        }
    } else {
        // Si no hay página, mostrar contenido original
        document.body.classList.remove('loading-cms-content');
    }
}
    
    // Crear menú de administrador
    function createAdminMenu() {
        const adminMenu = document.createElement('div');
        adminMenu.id = 'cms-admin-menu';
        adminMenu.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 99999;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            overflow: hidden;
            font-family: Arial, sans-serif;
        `;
        
        adminMenu.innerHTML = `
            <div id="cms-menu-toggle" style="
                background: #3498db;
                color: white;
                padding: 12px 16px;
                cursor: pointer;
                font-weight: 600;
                user-select: none;
            ">⚙️ Administrador</div>
            <div id="cms-menu-content" style="
                display: none;
                padding: 16px;
                min-width: 200px;
            ">
                <button id="cms-gestor-btn" class="cms-btn" style="
                    display: block;
                    width: 100%;
                    padding: 8px 12px;
                    margin-bottom: 8px;
                    background: #e74c3c;
                    color: white;
                    border: none;
                    border-radius: 4px;
                    cursor: pointer;
                ">🏠 Ir al gestor</button>
                <button id="cms-index-btn" class="cms-btn" style="
                    display: block;
                    width: 100%;
                    padding: 8px 12px;
                    margin-bottom: 8px;
                    background: #27ae60;
                    color: white;
                    border: none;
                    border-radius: 4px;
                    cursor: pointer;
                ">🌐 Ir a inicio</button>
                <button id="cms-edit-btn" class="cms-btn" style="
                    display: block;
                    width: 100%;
                    padding: 8px 12px;
                    background: #f39c12;
                    color: white;
                    border: none;
                    border-radius: 4px;
                    cursor: pointer;
                ">✏️ Editar esta página</button>
            </div>
        `;
        
        document.body.appendChild(adminMenu);
        
        // Event listeners
        const toggle = document.getElementById('cms-menu-toggle');
        const content = document.getElementById('cms-menu-content');
        const gestorBtn = document.getElementById('cms-gestor-btn');
        const indexBtn = document.getElementById('cms-index-btn');
        const editBtn = document.getElementById('cms-edit-btn');
        
        toggle.addEventListener('click', () => {
            content.style.display = content.style.display === 'none' ? 'block' : 'none';
        });
        
        gestorBtn.addEventListener('click', () => {
            window.open('gestorCont.html', '_blank');
        });
        
        indexBtn.addEventListener('click', () => {
            window.open('index.html?cms_admin_token=true', '_blank');
        });
        
        editBtn.addEventListener('click', () => {
            enableEditMode();
        });
        
        // Cerrar menú al hacer click fuera
        document.addEventListener('click', (e) => {
            if (!adminMenu.contains(e.target)) {
                content.style.display = 'none';
            }
        });
    }
    
    // Sistema de edición
    let isEditingMode = false;
    let originalContent = '';
    
    function enableEditMode() {
        if (isEditingMode) return;
        
        isEditingMode = true;
        
        // MEJORADO: Buscar contenido editable en toda la página
        const cmsRoot = document.getElementById('cms-root');
        const searchArea = cmsRoot && cmsRoot.innerHTML.trim() ? cmsRoot : document.body;
        
        // Guardar contenido original
        originalContent = searchArea.innerHTML;
        
        // Buscar elementos editables existentes
        let editableTexts = searchArea.querySelectorAll('.editable-text');
        let editableImages = searchArea.querySelectorAll('.editable-image');
        
        // NUEVO: Si no hay elementos con clases editables, hacer editables elementos comunes
        if (editableTexts.length === 0 && editableImages.length === 0) {
            // Hacer editables textos comunes (excluyendo enlaces que pueden ser problemáticos)
            const textSelectors = [
                'h1:not(a h1):not(a)', 'h2:not(a h2):not(a)', 'h3:not(a h3):not(a)', 
                'h4:not(a h4):not(a)', 'h5:not(a h5):not(a)', 'h6:not(a h6):not(a)', 
                'p:not(a p):not(a)', '.hero-title', '.main-title', '.projects-title',
                '.news-title', '.section-title-small', '.about-text', '.project-title',
                '.project-description', '.news-card-text', '.quality-text',
                '.titulo-atletismo', '.texto-deporte', '.texto-handball', '.etiqueta', 
                '.exchange-title', '.description', '.sport-title'
            ];
            textSelectors.forEach(selector => {
                const elements = searchArea.querySelectorAll(selector);
                elements.forEach(el => {
                    // No hacer editables elementos dentro de enlaces a menos que sean imágenes
                    if (!el.closest('a') || el.tagName === 'IMG') {
                        el.classList.add('editable-text');
                    }
                });
            });
            
            // Hacer editables imágenes comunes (incluyendo las dentro de enlaces)
            const imageSelectors = ['img', '.bg-image', '.logo', '.menu-icon', '.sport-bg'];
            imageSelectors.forEach(selector => {
                const elements = searchArea.querySelectorAll(selector);
                elements.forEach(el => {
                    if (el.tagName === 'IMG' || el.style.backgroundImage || 
                        getComputedStyle(el).backgroundImage !== 'none') {
                        el.classList.add('editable-image');
                    }
                });
            });
            
            // Hacer editables textos dentro de enlaces (como títulos de deportes)
            const linkTexts = searchArea.querySelectorAll('a .sport-title, a h1, a h2, a h3, a h4, a h5, a h6');
            linkTexts.forEach(el => {
                el.classList.add('editable-text');
            });
            
            // Actualizar las listas
            editableTexts = searchArea.querySelectorAll('.editable-text');
            editableImages = searchArea.querySelectorAll('.editable-image');
        }
        
        // Configurar elementos editables
        editableTexts.forEach(el => {
            el.contentEditable = 'true';
            el.style.outline = '2px dashed #3498db';
            el.style.outlineOffset = '2px';
            el.style.cursor = 'text';
            
            // Prevenir navegación en enlaces cuando están en modo edición
            if (el.closest('a')) {
                el.addEventListener('click', (e) => {
                    if (isEditingMode) {
                        e.preventDefault();
                        e.stopPropagation();
                        el.focus();
                    }
                });
            }
            
            // Agregar tooltip usando atributo title en lugar de elemento DOM
            if (!el.hasAttribute('data-edit-tooltip')) {
                el.setAttribute('data-edit-tooltip', 'true');
                el.title = 'Click para editar texto';
                
                // Alternativamente, agregar clase CSS para mostrar tooltip
                el.classList.add('cms-editable-text');
            }
        });
        
        editableImages.forEach(img => {
            img.style.outline = '3px dashed #e74c3c';
            img.style.outlineOffset = '3px';
            img.style.cursor = 'pointer';
            img.addEventListener('click', handleImageEdit);
            
            // Prevenir navegación en enlaces cuando están en modo edición
            if (img.closest('a')) {
                img.addEventListener('click', (e) => {
                    if (isEditingMode) {
                        e.preventDefault();
                        e.stopPropagation();
                    }
                });
            }
            
            // Agregar tooltip usando atributo title
            if (!img.hasAttribute('data-edit-tooltip')) {
                img.setAttribute('data-edit-tooltip', 'true');
                img.title = 'Click para cambiar imagen';
                img.classList.add('cms-editable-image');
            }
        });
        
        showSaveControls();
        
        // Agregar CSS para tooltips mejorados
        addEditingCSS();
        
        alert(`Modo edición activado. Elementos editables: ${editableTexts.length} textos, ${editableImages.length} imágenes`);
    }
    
    function handleImageEdit(e) {
        e.preventDefault();
        e.stopPropagation();
        const img = e.target;
        const currentSrc = img.src || img.style.backgroundImage.replace(/url\(['"]?(.+?)['"]?\)/i, '$1');
        const newUrl = prompt('Ingresa la nueva URL de la imagen:', currentSrc);
        if (newUrl && newUrl.trim()) {
            if (img.tagName === 'IMG') {
                img.src = newUrl.trim();
            } else {
                img.style.backgroundImage = `url(${newUrl.trim()})`;
            }
        }
    }
    
    function addEditingCSS() {
        // Agregar CSS personalizado para el modo de edición
        if (!document.getElementById('cms-editing-styles')) {
            const style = document.createElement('style');
            style.id = 'cms-editing-styles';
            style.innerHTML = `
                .cms-editable-text:hover::after {
                    content: "✏️ Editable";
                    position: absolute;
                    bottom: -25px;
                    left: 0;
                    background: #3498db;
                    color: white;
                    padding: 2px 6px;
                    border-radius: 3px;
                    font-size: 10px;
                    z-index: 10000;
                    pointer-events: none;
                    white-space: nowrap;
                }
                
                .cms-editable-image:hover::after {
                    content: "🖼️ Cambiar imagen";
                    position: absolute;
                    bottom: -25px;
                    left: 0;
                    background: #e74c3c;
                    color: white;
                    padding: 2px 6px;
                    border-radius: 3px;
                    font-size: 10px;
                    z-index: 10000;
                    pointer-events: none;
                    white-space: nowrap;
                }
                
                /* Evitar que los enlaces naveguen en modo edición */
                body.cms-editing-mode a {
                    pointer-events: none;
                }
                
                body.cms-editing-mode .cms-editable-text,
                body.cms-editing-mode .cms-editable-image {
                    pointer-events: all;
                }
            `;
            document.head.appendChild(style);
        }
        
        // Agregar clase al body para modo edición
        document.body.classList.add('cms-editing-mode');
    }
    
    function showSaveControls() {
        const existingControls = document.getElementById('cms-save-controls');
        if (existingControls) existingControls.remove();
        
        const saveControls = document.createElement('div');
        saveControls.id = 'cms-save-controls';
        saveControls.style.cssText = `
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 99998;
            display: flex;
            gap: 10px;
        `;
        
        saveControls.innerHTML = `
            <button id="cms-save" style="
                background: #27ae60;
                color: white;
                border: none;
                padding: 12px 20px;
                border-radius: 6px;
                cursor: pointer;
                font-weight: 600;
            ">💾 Guardar cambios</button>
            <button id="cms-cancel" style="
                background: #e74c3c;
                color: white;
                border: none;
                padding: 12px 20px;
                border-radius: 6px;
                cursor: pointer;
                font-weight: 600;
            ">❌ Cancelar</button>
        `;
        
        document.body.appendChild(saveControls);
        
        document.getElementById('cms-save').addEventListener('click', saveChanges);
        document.getElementById('cms-cancel').addEventListener('click', cancelEdit);
    }
    
    function saveChanges() {
        if (!pageId) {
            // Si no hay pageId, crear una nueva página para el index
            const newPageId = Date.now();
            const currentUrl = window.location.pathname.split('/').pop().split('?')[0] || 'index.html';
            saveAsNewPage(newPageId, currentUrl);
            return;
        }
        
        // Obtener el contenido actual
        const cmsRoot = document.getElementById('cms-root');
        const currentContent = cmsRoot ? cmsRoot.innerHTML : document.body.innerHTML;
        
        // Limpiar elementos del CMS antes de guardar
        const tempDiv = document.createElement('div');
        tempDiv.innerHTML = currentContent;
        
        // Remover elementos del CMS
        tempDiv.querySelectorAll('#cms-admin-menu, #cms-save-controls').forEach(el => el.remove());
        
        // Limpiar estilos y atributos de edición
        tempDiv.querySelectorAll('.editable-text, .editable-image, .cms-editable-text, .cms-editable-image').forEach(el => {
            el.contentEditable = 'false';
            el.style.outline = '';
            el.style.outlineOffset = '';
            el.style.cursor = '';
            el.removeAttribute('data-edit-tooltip');
            el.removeAttribute('title');
            el.classList.remove('cms-editable-text', 'cms-editable-image');
        });
        
        const cleanContent = tempDiv.innerHTML;
        
        // Actualizar página en localStorage
        let savedPages = JSON.parse(localStorage.getItem('savedPages')) || [];
        const pageIndex = savedPages.findIndex(page => page.id == pageId);
        
        if (pageIndex !== -1) {
            savedPages[pageIndex].content = cleanContent;
            savedPages[pageIndex].lastModified = new Date().toLocaleString();
            
            localStorage.setItem('savedPages', JSON.stringify(savedPages));
            
            alert('Página actualizada correctamente!');
            
            // Notificar al gestor si está abierto
            try {
                if (window.opener && !window.opener.closed) {
                    window.opener.postMessage({ type: 'cms_saved', id: pageId }, window.location.origin);
                }
            } catch (e) {
                console.warn('No se pudo notificar al gestor:', e);
            }
            
        } else {
            alert('Error: Página no encontrada en el sistema');
        }
        
        disableEditMode();
    }
    
    function saveAsNewPage(newPageId, currentUrl) {
        // Obtener el contenido actual
        const cmsRoot = document.getElementById('cms-root');
        const searchArea = cmsRoot && cmsRoot.innerHTML.trim() ? cmsRoot : document.body;
        const currentContent = searchArea.innerHTML;
        
        // Limpiar elementos del CMS antes de guardar
        const tempDiv = document.createElement('div');
        tempDiv.innerHTML = currentContent;
        
        // Remover elementos del CMS
        tempDiv.querySelectorAll('#cms-admin-menu, #cms-save-controls').forEach(el => el.remove());
        
        // Limpiar estilos y atributos de edición
        tempDiv.querySelectorAll('.editable-text, .editable-image, .cms-editable-text, .cms-editable-image').forEach(el => {
            el.contentEditable = 'false';
            el.style.outline = '';
            el.style.outlineOffset = '';
            el.style.cursor = '';
            el.removeAttribute('data-edit-tooltip');
            el.removeAttribute('title');
            el.classList.remove('cms-editable-text', 'cms-editable-image');
        });
        
        const cleanContent = tempDiv.innerHTML;
        
        // Crear nueva página
        const pageTitle = document.title || 'Página sin título';
        const pageData = {
            id: newPageId,
            template: 'custom',
            name: `${pageTitle.replace(' - Scuola Italiana di Montevideo', '')} (Editado)`,
            content: cleanContent,
            url: currentUrl,
            created: new Date().toLocaleString(),
            lastModified: new Date().toLocaleString()
        };
        
        // Guardar en localStorage
        let savedPages = JSON.parse(localStorage.getItem('savedPages')) || [];
        
        // Verificar si ya existe una versión de esta página
        const existingIndex = savedPages.findIndex(page => page.url === currentUrl);
        
        if (existingIndex !== -1) {
            // Actualizar página existente
            savedPages[existingIndex] = {
                ...savedPages[existingIndex],
                content: cleanContent,
                lastModified: new Date().toLocaleString()
            };
            alert('Página del index actualizada correctamente en el gestor.');
        } else {
            // Agregar nueva página
            savedPages.push(pageData);
            alert('Nueva versión del index guardada en el gestor.');
        }
        
        localStorage.setItem('savedPages', JSON.stringify(savedPages));
        
        // Notificar al gestor si está abierto
        try {
            if (window.opener && !window.opener.closed) {
                window.opener.postMessage({ type: 'cms_saved', id: newPageId }, window.location.origin);
            }
        } catch (e) {
            console.warn('No se pudo notificar al gestor:', e);
        }
        
        disableEditMode();
    }
    
    function cancelEdit() {
        if (confirm('¿Descartar todos los cambios?')) {
            location.reload(); // Recargar la página para restaurar el estado original
        }
    }
    
    function disableEditMode() {
        isEditingMode = false;
        
        // Remover clase de modo edición del body
        document.body.classList.remove('cms-editing-mode');
        
        const editableTexts = document.querySelectorAll('.editable-text');
        const editableImages = document.querySelectorAll('.editable-image');
        
        editableTexts.forEach(el => {
            el.contentEditable = 'false';
            el.style.outline = '';
            el.style.outlineOffset = '';
            el.style.cursor = '';
            el.removeAttribute('data-edit-tooltip');
            el.removeAttribute('title');
            el.classList.remove('cms-editable-text');
        });
        
        editableImages.forEach(img => {
            img.style.outline = '';
            img.style.outlineOffset = '';
            img.style.cursor = '';
            img.removeAttribute('data-edit-tooltip');
            img.removeAttribute('title');
            img.classList.remove('cms-editable-image');
            img.removeEventListener('click', handleImageEdit);
        });
        
        // Remover CSS de edición
        const editingStyles = document.getElementById('cms-editing-styles');
        if (editingStyles) editingStyles.remove();
        
        const saveControls = document.getElementById('cms-save-controls');
        if (saveControls) saveControls.remove();
    }
    
    // Auto-modificar enlaces para mantener token de admin
    function updateLinksWithToken() {
        const links = document.querySelectorAll('a[href]');
        links.forEach(link => {
            const href = link.getAttribute('href');
            if (href && !href.includes('://') && !href.startsWith('#') && !href.startsWith('mailto:') && !href.startsWith('tel:')) {
                const separator = href.includes('?') ? '&' : '?';
                if (!href.includes('cms_admin_token')) {
                    link.setAttribute('href', href + separator + 'cms_admin_token=true');
                }
            }
        });
    }
    
    // Inicializar cuando el DOM esté listo
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            loadSpecificPage(); // NUEVO: Cargar página específica primero
            createAdminMenu();
            updateLinksWithToken();
        });
    } else {
        loadSpecificPage(); // NUEVO: Cargar página específica primero
        createAdminMenu();
        updateLinksWithToken();
    }
})();