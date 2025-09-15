<?php

session_start();
require_once "conexion.php";

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'coordinador') {
    header("Location: index.php");
    exit();
}



// Handle AJAX requests
if (isset($_POST['ajax']) && $_POST['ajax'] === '1') {
    header('Content-Type: application/json; charset=utf-8');
    
    $response = ['success' => false, 'message' => '', 'data' => null];
    
    try {
        /* ==========================
           🔌 GESTIÓN DE USUARIOS
        ========================== */
        if (isset($_POST['crear_usuario'])) {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $rol = trim($_POST['rol']);

            if ($email === "" || $password === "" || !in_array($rol, ['alumno', 'profesor'])) {
                $response['message'] = "⚠️ Complete email, contraseña y rol (alumno/profesor).";
            } else {
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("INSERT INTO usuarios (email, password, rol) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $email, $passwordHash, $rol);
                if ($stmt->execute()) {
                    $response['success'] = true;
                    $response['message'] = "✅ Usuario creado correctamente.";
                    $response['data'] = [
                        'id_usuario' => $conn->insert_id,
                        'email' => $email,
                        'rol' => $rol
                    ];
                } else {
                    $response['message'] = "❌ Error: ".$stmt->error;
                }
                $stmt->close();
            }
        }

        if (isset($_POST['editar_usuario'])) {
            $id_usuario = intval($_POST['id_usuario']);
            $email = trim($_POST['email']);
            $rol = trim($_POST['rol']);
            $password = trim($_POST['password']);

            if ($id_usuario <= 0 || $email === "" || !in_array($rol, ['alumno','profesor'])) {
                $response['message'] = "⚠️ Datos inválidos para editar.";
            } else {
                if ($password !== "") {
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                    $stmt = $conn->prepare("UPDATE usuarios SET email=?, password=?, rol=? WHERE id_usuario=?");
                    $stmt->bind_param("sssi", $email, $passwordHash, $rol, $id_usuario);
                } else {
                    $stmt = $conn->prepare("UPDATE usuarios SET email=?, rol=? WHERE id_usuario=?");
                    $stmt->bind_param("ssi", $email, $rol, $id_usuario);
                }
                if ($stmt->execute()) {
                    $response['success'] = true;
                    $response['message'] = "✏️ Usuario actualizado.";
                } else {
                    $response['message'] = "❌ Error al actualizar: ".$stmt->error;
                }
                $stmt->close();
            }
        }

        if (isset($_POST['eliminar_usuario'])) {
            $id_usuario = intval($_POST['id_usuario']);
            $conn->query("DELETE FROM usuarios_clases WHERE id_usuario=$id_usuario");
            if ($conn->query("DELETE FROM usuarios WHERE id_usuario=$id_usuario")) {
                $response['success'] = true;
                $response['message'] = "🗑️ Usuario eliminado.";
            } else {
                $response['message'] = "❌ No se pudo eliminar el usuario.";
            }
        }

        /* ==========================
           🔌 CLASES Y ASIGNACIÓN
        ========================== */
        if (isset($_POST['crear_clase'])) {
            $nombre = trim($_POST['nombre']);
            $anio = trim($_POST['anio']);

            if ($nombre === "" || $anio === "") {
                $response['message'] = "⚠️ Complete nombre y año.";
            } else {
                $stmt = $conn->prepare("INSERT INTO clases (nombre, `año`) VALUES (?, ?)");
                $stmt->bind_param("ss", $nombre, $anio);
                if (!$stmt->execute()) {
                    if ($stmt->errno == 1062) {
                        $response['message'] = "❌ Ya existe una clase '$nombre' para el año '$anio'.";
                    } else {
                        $response['message'] = "❌ Error al crear clase: ".$stmt->error;
                    }
                } else {
                    $response['success'] = true;
                    $response['message'] = "✅ Clase creada correctamente.";
                    $response['data'] = [
                        'id_clase' => $conn->insert_id,
                        'nombre' => $nombre,
                        'año' => $anio
                    ];
                }
                $stmt->close();
            }
        }

        if (isset($_POST['editar_clase'])) {
            $id = intval($_POST['id_clase']);
            $nombre = trim($_POST['nombre']);
            $anio = trim($_POST['anio']);

            if ($id <= 0 || $nombre === "" || $anio === "") {
                $response['message'] = "⚠️ Datos inválidos para editar clase.";
            } else {
                $stmt = $conn->prepare("UPDATE clases SET nombre=?, `año`=? WHERE id_clase=?");
                $stmt->bind_param("ssi", $nombre, $anio, $id);
                if (!$stmt->execute()) {
                    if ($stmt->errno == 1062) {
                        $response['message'] = "❌ Ya existe una clase '$nombre' para el año '$anio'.";
                    } else {
                        $response['message'] = "❌ Error al editar clase: ".$stmt->error;
                    }
                } else {
                    $response['success'] = true;
                    $response['message'] = "✏️ Clase actualizada.";
                }
                $stmt->close();
            }
        }

        if (isset($_POST['eliminar_clase'])) {
            $id = intval($_POST['id_clase']);
            if ($id > 0) {
                $conn->query("DELETE FROM usuarios_clases WHERE id_clase = $id");
                if ($conn->query("DELETE FROM clases WHERE id_clase=$id")) {
                    $response['success'] = true;
                    $response['message'] = "🗑️ Clase eliminada.";
                } else {
                    $response['message'] = "❌ No se pudo eliminar la clase.";
                }
            }
        }

        if (isset($_POST['asignar_usuario'])) {
            $id_usuario = intval($_POST['id_usuario']);
            $id_clase = intval($_POST['id_clase']);

            if ($id_usuario <= 0 || $id_clase <= 0) {
                $response['message'] = "⚠️ Seleccione usuario y clase.";
            } else {
                $stmt = $conn->prepare("SELECT rol FROM usuarios WHERE id_usuario=?");
                $stmt->bind_param("i", $id_usuario);
                $stmt->execute();
                $stmt->bind_result($rol_usuario);
                $stmt->fetch();
                $stmt->close();

                if (!$rol_usuario || !in_array($rol_usuario, ['alumno','profesor'])) {
                    $response['message'] = "❌ Solo se pueden asignar alumnos o profesores.";
                } else {
                    $stmt = $conn->prepare("INSERT INTO usuarios_clases (id_usuario, id_clase, rol_en_clase) VALUES (?, ?, ?)");
                    $stmt->bind_param("iis", $id_usuario, $id_clase, $rol_usuario);
                    if (!$stmt->execute()) {
                        if ($stmt->errno == 1062) {
                            $response['message'] = "ℹ️ Ese usuario ya está asignado a esa clase.";
                        } else {
                            $response['message'] = "❌ Error al asignar: ".$stmt->error;
                        }
                    } else {
                        $response['success'] = true;
                        $response['message'] = "👥 Usuario asignado a la clase.";
                    }
                    $stmt->close();
                }
            }
        }

        if (isset($_POST['quitar_usuario'])) {
            $id_usuario = intval($_POST['id_usuario']);
            $id_clase = intval($_POST['id_clase']);
            $stmt = $conn->prepare("DELETE FROM usuarios_clases WHERE id_usuario=? AND id_clase=?");
            $stmt->bind_param("ii", $id_usuario, $id_clase);
            if ($stmt->execute()) {
                $response['success'] = true;
                $response['message'] = "🗑️ Usuario quitado de la clase.";
            } else {
                $response['message'] = "❌ Error al quitar usuario.";
            }
            $stmt->close();
        }

        /* ==========================
           🔌 EVENTOS
        ========================== */
        if (isset($_POST['crear_evento'])) {
            $titulo = trim($_POST['titulo']);
            $fecha = $_POST['fecha'] ?? '';
            $tipo = $_POST['tipo'] ?? '';
            $id_clase_ev = ($tipo === 'clase' && !empty($_POST['id_clase'])) ? intval($_POST['id_clase']) : NULL;
            $imagen = null;

            if (!empty($_FILES['imagen']['name'])) {
                $targetDir = "uploads/";
                if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);
                $fileName = time() . "_" . preg_replace("/[^A-Za-z0-9._-]/", "_", basename($_FILES['imagen']['name']));
                $targetFile = $targetDir . $fileName;
                if (move_uploaded_file($_FILES['imagen']['tmp_name'], $targetFile)) {
                    $imagen = $fileName;
                }
            }

            if ($titulo === "" || $fecha === "" || $tipo === "") {
                $response['message'] = "⚠️ Complete título, fecha y tipo de evento.";
            } else {
                $stmt = $conn->prepare("INSERT INTO eventos (titulo, fecha, tipo, id_clase, creado_por, imagen) VALUES (?, ?, ?, ?, ?, ?)");
                $creado_por = $_SESSION['id_usuario'];
                $stmt->bind_param("sssiss", $titulo, $fecha, $tipo, $id_clase_ev, $creado_por, $imagen);
                if ($stmt->execute()) {
                    $response['success'] = true;
                    $response['message'] = "✅ Evento creado correctamente.";
                    $response['data'] = [
                        'id_evento' => $conn->insert_id,
                        'titulo' => $titulo,
                        'fecha' => $fecha,
                        'tipo' => $tipo,
                        'imagen' => $imagen
                    ];
                } else {
                    $response['message'] = "❌ Error al crear evento: ".$stmt->error;
                }
                $stmt->close();
            }
        }

        if (isset($_POST['eliminar_evento'])) {
            $id = intval($_POST['id_evento']);
            if ($conn->query("DELETE FROM eventos WHERE id_evento=$id")) {
                $response['success'] = true;
                $response['message'] = "🗑️ Evento eliminado.";
            } else {
                $response['message'] = "❌ No se pudo eliminar el evento.";
            }
        }

    } catch (Exception $e) {
        $response['message'] = "Error del servidor: " . $e->getMessage();
    }
    
    echo json_encode($response);
    exit();
}

/* ==========================
   🔌 CONSULTAS (arrays) - Solo para carga inicial
========================== */
$usuarios_arr = [];
$res = $conn->query("SELECT id_usuario, email, rol FROM usuarios WHERE rol IN ('alumno','profesor') ORDER BY rol, email");
while ($row = $res->fetch_assoc()) { $usuarios_arr[] = $row; }

$clases_arr = [];
$res = $conn->query("SELECT * FROM clases ORDER BY `año`, nombre");
while ($row = $res->fetch_assoc()) { $clases_arr[] = $row; }

$usuarios_por_clase = [];
$res = $conn->query("
    SELECT c.id_clase, c.nombre AS clase, c.`año` AS anio,
           u.id_usuario, u.email AS usuario, uc.rol_en_clase
    FROM usuarios_clases uc
    JOIN clases c ON uc.id_clase = c.id_clase
    JOIN usuarios u ON uc.id_usuario = u.id_usuario
    ORDER BY c.`año`, c.nombre, uc.rol_en_clase, u.email
");
while ($row = $res->fetch_assoc()) { $usuarios_por_clase[] = $row; }

$eventos_arr = [];
$res = $conn->query("
    SELECT e.*, c.nombre AS clase_nombre
    FROM eventos e
    LEFT JOIN clases c ON e.id_clase = c.id_clase
    ORDER BY fecha DESC
");
while ($row = $res->fetch_assoc()) { $eventos_arr[] = $row; }
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Panel del Coordinador</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
<style>
    :root{
      --bg:#f4f6f9; --sidebar:#2c3e50; --accent:#1abc9c; --accent-dark:#16a085;
      --text:#2c3e50; --muted:#6b7280; --danger:#e74c3c; --light:#f8f9fa;
    }
    *{box-sizing:border-box}
    body { margin: 0; font-family: 'Poppins', sans-serif; background: var(--bg); display: flex; color: var(--text); }
    .sidebar { width: 250px; background: var(--sidebar); color: #fff; min-height: 100vh; padding: 24px 18px; position: sticky; top:0; }
    .sidebar h2 { font-size: 22px; text-align:center; margin: 0 0 20px; }
    .nav a { display: block; color: #fff; text-decoration: none; margin: 8px 0; padding: 12px 14px; border-radius: 10px; transition: .2s; }
    .nav a:hover, .nav a.active { background: var(--accent); }
    .main { flex: 1; padding: 24px; max-width: 1400px; margin: 0 auto; }
    .msg { font-weight: 500; margin-bottom: 16px; padding: 12px; border-radius: 8px; border:1px solid transparent; }
    .msg.ok { background: #e8f6ee; color: #0c6b2e; border-color:#bfe4cc; }
    .msg.error { background: #fdecea; color: #a12017; border-color:#f5c2c0; }
    .card { background: #fff; padding: 18px; border-radius: 14px; box-shadow: 0 6px 20px rgba(0,0,0,.06); margin-bottom: 22px; }
    .card h1 { font-size: 20px; margin: 0 0 12px; }
    .form-row{ display:flex; flex-wrap:wrap; gap:10px; }
    .form-row > *{ flex:1 1 220px; }
    input, select, button { width: 100%; padding: 11px 12px; border-radius: 10px; border: 1px solid #d1d5db; font-family: inherit; }
    input:focus, select:focus { outline: none; border-color: var(--accent); box-shadow: 0 0 0 3px rgba(26,188,156,.15); }
    .btn { background: var(--accent); color: #fff; border: none; cursor: pointer; font-weight: 600; transition:.2s; }
    .btn:hover { background: var(--accent-dark); }
    .btn:disabled { opacity: 0.6; cursor: not-allowed; }
    .btn-danger { background: var(--danger); color:#fff; }
    .btn-danger:hover { filter: brightness(0.95); }
    .table-wrap{ overflow-x:auto; border:1px solid #e5e7eb; border-radius:12px; }
    table { width: 100%; border-collapse: collapse; }
    th, td { padding: 12px; border-bottom: 1px solid #eee; text-align: left; font-size:14px; }
    th { background: var(--light); }
    .filters { display:flex; gap:10px; flex-wrap:wrap; padding:12px; background:#fff; border:1px solid #e5e7eb; border-radius:12px; margin:10px 0 0; }
    /* Eventos */
    .event-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 18px; margin-top: 16px; }
    .event-card { background: white; border-radius: 14px; overflow: hidden; box-shadow: 0 6px 16px rgba(0,0,0,0.08); display: flex; flex-direction: column; }
    .event-card img { width: 100%; height: 160px; object-fit: cover; background:#f3f4f6; }
    .event-card .info { padding: 14px; }
    .event-card h3 { margin: 0 0 8px; font-size: 18px; }
    .event-card p { margin: 4px 0; font-size: 14px; color: #4b5563; }
    .event-card form { margin-top: auto; padding-top: 6px; }
    
    /* Loading spinner */
    .spinner {
        display: inline-block;
        width: 20px;
        height: 20px;
        border: 3px solid rgba(255,255,255,.3);
        border-radius: 50%;
        border-top-color: #fff;
        animation: spin 1s ease-in-out infinite;
    }
    @keyframes spin { to { transform: rotate(360deg); } }
    
    /* Notification */
    .notification {
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 15px 20px;
        border-radius: 8px;
        color: white;
        font-weight: 500;
        z-index: 1000;
        transform: translateX(100%);
        transition: transform 0.3s ease;
    }
    .notification.show { transform: translateX(0); }
    .notification.success { background: #10b981; }
    .notification.error { background: #ef4444; }
    
    @media (max-width: 900px) { .sidebar{width:210px} }
    @media (max-width: 720px) { .sidebar{display:none} .main{padding:16px} }
</style>
</head>
<body>
  <aside class="sidebar">
    <h2>Coordinador</h2>
    <nav class="nav">
      <a href="#" class="active" onclick="mostrarSeccion('seccionUsuarios', this)">👤 Usuarios</a>
      <a href="#" onclick="mostrarSeccion('seccionClases', this)">🏫 Clases y Asignación</a>
      <a href="#" onclick="mostrarSeccion('seccionEventos', this)">🎉 Eventos</a>
      <a href="logout.php" style="margin-top: 20px; background: rgba(255,255,255,0.1);">🚪 Cerrar Sesión</a>
    </nav>
  </aside>

  <main class="main">
    <div id="notification" class="notification"></div>

    <!-- ===================== USUARIOS ===================== -->
    <section id="seccionUsuarios" class="card" style="display:block;">
      <h1>Gestión de Usuarios</h1>
      <form id="formCrearUsuario" class="form-row" autocomplete="off">
        <input type="email" name="email" placeholder="Correo electrónico" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <select name="rol" required>
          <option value="">Rol</option>
          <option value="alumno">Alumno</option>
          <option value="profesor">Profesor</option>
        </select>
        <button type="submit" class="btn">
          <span class="btn-text">Crear usuario</span>
          <span class="btn-spinner" style="display:none;"><span class="spinner"></span></span>
        </button>
      </form>

      <div class="table-wrap" style="margin-top:12px;">
        <table id="tablaUsuarios">
          <thead>
            <tr><th>Email</th><th>Rol</th><th style="width:420px">Editar</th><th>Eliminar</th></tr>
          </thead>
          <tbody>
            <?php foreach ($usuarios_arr as $u): ?>
              <tr data-id="<?php echo $u['id_usuario']; ?>">
                <td><?php echo htmlspecialchars($u['email']); ?></td>
                <td><?php echo htmlspecialchars($u['rol']); ?></td>
                <td>
                  <form class="form-editar-usuario form-row" style="gap:8px;" data-id="<?php echo $u['id_usuario']; ?>">
                    <input type="email" name="email" value="<?php echo htmlspecialchars($u['email']); ?>">
                    <select name="rol">
                      <option value="alumno" <?php echo $u['rol']=='alumno'?'selected':''; ?>>Alumno</option>
                      <option value="profesor" <?php echo $u['rol']=='profesor'?'selected':''; ?>>Profesor</option>
                    </select>
                    <input type="password" name="password" placeholder="Nueva contraseña (opcional)">
                    <button type="submit" class="btn">Guardar</button>
                  </form>
                </td>
                <td>
                  <button class="btn btn-danger btn-eliminar-usuario" data-id="<?php echo $u['id_usuario']; ?>">
                    Eliminar
                  </button>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </section>

    <!-- ===================== CLASES & ASIGNACIÓN ===================== -->
    <section id="seccionClases" class="card" style="display:none;">
      <h1>Clases y Asignación</h1>

      <h3 style="margin:10px 0 6px;">Crear clase</h3>
      <form id="formCrearClase" class="form-row" autocomplete="off">
        <input type="text" name="nombre" placeholder="Nombre de la clase (p. ej. Lingüístico)" required>
        <input type="text" name="anio" placeholder="Año (p. ej. 1, 2, 3)" required>
        <button type="submit" class="btn">
          <span class="btn-text">Crear clase</span>
          <span class="btn-spinner" style="display:none;"><span class="spinner"></span></span>
        </button>
      </form>

      <div class="table-wrap" style="margin-top:12px;">
        <table id="tablaClases">
          <thead><tr><th>Nombre</th><th>Año</th><th>Editar</th><th>Eliminar</th></tr></thead>
          <tbody>
          <?php foreach ($clases_arr as $c): ?>
            <tr data-id="<?php echo $c['id_clase']; ?>">
              <td><?php echo htmlspecialchars($c['nombre']); ?></td>
              <td><?php echo htmlspecialchars($c['año']); ?></td>
              <td>
                <form class="form-editar-clase form-row" data-id="<?php echo $c['id_clase']; ?>">
                  <input type="text" name="nombre" value="<?php echo htmlspecialchars($c['nombre']); ?>" required>
                  <input type="text" name="anio" value="<?php echo htmlspecialchars($c['año']); ?>" required>
                  <button type="submit" class="btn">Guardar</button>
                </form>
              </td>
              <td>
                <button class="btn btn-danger btn-eliminar-clase" data-id="<?php echo $c['id_clase']; ?>">
                  Eliminar
                </button>
              </td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>

      <h3 style="margin:20px 0 6px;">Asignar usuario a clase</h3>
      <form id="formAsignarUsuario" class="form-row">
        <select name="id_usuario" required>
          <option value="">-- Usuario --</option>
          <?php foreach ($usuarios_arr as $u): ?>
            <option value="<?php echo $u['id_usuario']; ?>">
              <?php echo ucfirst($u['rol'])." - ".$u['email']; ?>
            </option>
          <?php endforeach; ?>
        </select>
        <select name="id_clase" required>
          <option value="">-- Clase --</option>
          <?php foreach ($clases_arr as $c): ?>
            <option value="<?php echo $c['id_clase']; ?>"><?php echo $c['año']." - ".$c['nombre']; ?></option>
          <?php endforeach; ?>
        </select>
        <button type="submit" class="btn">
          <span class="btn-text">Asignar</span>
          <span class="btn-spinner" style="display:none;"><span class="spinner"></span></span>
        </button>
      </form>

      <div class="filters">
        <input type="text" id="buscarUsuario" placeholder="🔍 Buscar usuario (email)">
        <select id="filtroClase">
          <option value="">Todas las clases</option>
          <?php foreach ($clases_arr as $c): ?>
            <option value="<?php echo htmlspecialchars($c['nombre']); ?>"><?php echo $c['año']." - ".$c['nombre']; ?></option>
          <?php endforeach; ?>
        </select>
        <select id="filtroRol">
          <option value="">Todos los roles</option>
          <option value="alumno">Alumno</option>
          <option value="profesor">Profesor</option>
        </select>
      </div>

      <div class="table-wrap" style="margin-top:12px;">
        <table id="tablaUsuariosClases">
          <thead>
            <tr><th>Clase</th><th>Año</th><th>Usuario (email)</th><th>Rol en clase</th><th>Quitar</th></tr>
          </thead>
          <tbody>
          <?php foreach ($usuarios_por_clase as $row): ?>
            <tr data-usuario="<?php echo $row['id_usuario']; ?>" data-clase="<?php echo $row['id_clase']; ?>">
              <td><?php echo htmlspecialchars($row['clase']); ?></td>
              <td><?php echo htmlspecialchars($row['anio']); ?></td>
              <td><?php echo htmlspecialchars($row['usuario']); ?></td>
              <td><?php echo htmlspecialchars($row['rol_en_clase']); ?></td>
              <td>
                <button class="btn btn-danger btn-quitar-usuario" 
                        data-usuario="<?php echo $row['id_usuario']; ?>" 
                        data-clase="<?php echo $row['id_clase']; ?>">
                  Quitar
                </button>
              </td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </section>

    <!-- ===================== EVENTOS ===================== -->
    <section id="seccionEventos" class="card" style="display:none;">
      <h1>Eventos</h1>
      <form id="formCrearEvento" enctype="multipart/form-data" class="form-row">
        <input type="text" name="titulo" placeholder="Título del evento" required>
        <input type="date" name="fecha" required>
        <select name="tipo" id="tipoEvento" onchange="toggleClase(this.value)" required>
          <option value="general">General</option>
          <option value="clase">Clase</option>
        </select>
        <select name="id_clase" id="claseSelect" style="display:none;">
          <option value="">-- Clase --</option>
          <?php foreach ($clases_arr as $c): ?>
            <option value="<?php echo $c['id_clase']; ?>"><?php echo $c['año']." - ".$c['nombre']; ?></option>
          <?php endforeach; ?>
        </select>
        <input type="file" name="imagen" accept="image/*">
        <button type="submit" class="btn">
          <span class="btn-text">Crear evento</span>
          <span class="btn-spinner" style="display:none;"><span class="spinner"></span></span>
        </button>
      </form>

      <div class="filters">
        <input type="text" id="buscarEvento" placeholder="🔍 Buscar evento (título)">
        <select id="filtroTipo">
          <option value="">Todos los tipos</option>
          <option value="general">General</option>
          <option value="clase">Clase</option>
        </select>
        <select id="filtroClaseEvento">
          <option value="">Todas las clases</option>
          <?php foreach ($clases_arr as $c): ?>
            <option value="<?php echo htmlspecialchars($c['nombre']); ?>"><?php echo $c['año']." - ".$c['nombre']; ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="event-grid" id="eventGrid">
        <?php foreach ($eventos_arr as $e): ?>
          <div class="event-card" data-id="<?php echo $e['id_evento']; ?>"
               data-titulo="<?php echo strtolower($e['titulo']); ?>"
               data-tipo="<?php echo strtolower($e['tipo']); ?>"
               data-clase="<?php echo strtolower($e['clase_nombre']); ?>">
            <img src="uploads/<?php echo $e['imagen'] ? $e['imagen'] : 'default.jpg'; ?>" alt="Evento">
            <div class="info">
              <h3><?php echo htmlspecialchars($e['titulo']); ?></h3>
              <p>📅 <?php echo htmlspecialchars($e['fecha']); ?></p>
              <p>🏷️ <?php echo htmlspecialchars(ucfirst($e['tipo'])); ?></p>
              <?php if ($e['tipo'] === 'clase'): ?>
                <p>👩‍🏫 Clase: <?php echo htmlspecialchars($e['clase_nombre']); ?></p>
              <?php endif; ?>
              <button class="btn btn-danger btn-eliminar-evento" data-id="<?php echo $e['id_evento']; ?>">
                Eliminar
              </button>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </section>
  </main>

  <script>
    // Global variables
    let usuarios = <?php echo json_encode($usuarios_arr); ?>;
    let clases = <?php echo json_encode($clases_arr); ?>;

    // Utility functions
    function mostrarSeccion(id, link = null) {
      document.querySelectorAll("main section").forEach(s => s.style.display = "none");
      document.getElementById(id).style.display = "block";
      if (link) {
        document.querySelectorAll(".nav a").forEach(a => a.classList.remove("active"));
        link.classList.add("active");
      }
    }

    function toggleClase(tipo) {
      document.getElementById("claseSelect").style.display = (tipo === "clase") ? "inline-block" : "none";
    }

    function showNotification(message, type = 'success') {
      const notification = document.getElementById('notification');
      notification.textContent = message;
      notification.className = `notification ${type} show`;
      setTimeout(() => {
        notification.classList.remove('show');
      }, 4000);
    }

    function toggleLoadingState(button, isLoading) {
      const textSpan = button.querySelector('.btn-text');
      const spinnerSpan = button.querySelector('.btn-spinner');
      
      if (isLoading) {
        button.disabled = true;
        if (textSpan) textSpan.style.display = 'none';
        if (spinnerSpan) spinnerSpan.style.display = 'inline-block';
      } else {
        button.disabled = false;
        if (textSpan) textSpan.style.display = 'inline-block';
        if (spinnerSpan) spinnerSpan.style.display = 'none';
      }
    }

    async function sendAjaxRequest(formData) {
      formData.append('ajax', '1');
      const response = await fetch(window.location.href, {
        method: 'POST',
        body: formData
      });
      return await response.json();
    }

    // AJAX Form Handlers
    document.addEventListener('DOMContentLoaded', function() {
      // Crear Usuario
      document.getElementById('formCrearUsuario').addEventListener('submit', async function(e) {
        e.preventDefault();
        const button = this.querySelector('button[type="submit"]');
        toggleLoadingState(button, true);

        try {
          const formData = new FormData(this);
          formData.append('crear_usuario', '1');
          
          const result = await sendAjaxRequest(formData);
          
          if (result.success) {
            showNotification(result.message, 'success');
            this.reset();
            
            // Add new row to table
            if (result.data) {
              addUsuarioToTable(result.data);
              usuarios.push(result.data);
              updateUsuarioSelects();
            }
          } else {
            showNotification(result.message, 'error');
          }
        } catch (error) {
          showNotification('Error de conexión', 'error');
        } finally {
          toggleLoadingState(button, false);
        }
      });

      // Editar Usuario
      document.addEventListener('submit', async function(e) {
        if (e.target.classList.contains('form-editar-usuario')) {
          e.preventDefault();
          const userId = e.target.dataset.id;
          
          try {
            const formData = new FormData(e.target);
            formData.append('editar_usuario', '1');
            formData.append('id_usuario', userId);
            
            const result = await sendAjaxRequest(formData);
            
            if (result.success) {
              showNotification(result.message, 'success');
              updateUsuarioInTable(userId, formData);
            } else {
              showNotification(result.message, 'error');
            }
          } catch (error) {
            showNotification('Error de conexión', 'error');
          }
        }
      });

      // Eliminar Usuario
      document.addEventListener('click', async function(e) {
        if (e.target.classList.contains('btn-eliminar-usuario')) {
          if (!confirm('¿Eliminar este usuario?')) return;
          
          const userId = e.target.dataset.id;
          
          try {
            const formData = new FormData();
            formData.append('eliminar_usuario', '1');
            formData.append('id_usuario', userId);
            
            const result = await sendAjaxRequest(formData);
            
            if (result.success) {
              showNotification(result.message, 'success');
              removeUsuarioFromTable(userId);
              usuarios = usuarios.filter(u => u.id_usuario != userId);
              updateUsuarioSelects();
            } else {
              showNotification(result.message, 'error');
            }
          } catch (error) {
            showNotification('Error de conexión', 'error');
          }
        }
      });

      // Crear Clase
      document.getElementById('formCrearClase').addEventListener('submit', async function(e) {
        e.preventDefault();
        const button = this.querySelector('button[type="submit"]');
        toggleLoadingState(button, true);

        try {
          const formData = new FormData(this);
          formData.append('crear_clase', '1');
          
          const result = await sendAjaxRequest(formData);
          
          if (result.success) {
            showNotification(result.message, 'success');
            this.reset();
            
            if (result.data) {
              addClaseToTable(result.data);
              clases.push(result.data);
              updateClaseSelects();
            }
          } else {
            showNotification(result.message, 'error');
          }
        } catch (error) {
          showNotification('Error de conexión', 'error');
        } finally {
          toggleLoadingState(button, false);
        }
      });

      // Editar Clase
      document.addEventListener('submit', async function(e) {
        if (e.target.classList.contains('form-editar-clase')) {
          e.preventDefault();
          const claseId = e.target.dataset.id;
          
          try {
            const formData = new FormData(e.target);
            formData.append('editar_clase', '1');
            formData.append('id_clase', claseId);
            
            const result = await sendAjaxRequest(formData);
            
            if (result.success) {
              showNotification(result.message, 'success');
              updateClaseInTable(claseId, formData);
            } else {
              showNotification(result.message, 'error');
            }
          } catch (error) {
            showNotification('Error de conexión', 'error');
          }
        }
      });

      // Eliminar Clase
      document.addEventListener('click', async function(e) {
        if (e.target.classList.contains('btn-eliminar-clase')) {
          if (!confirm('¿Eliminar la clase y sus asignaciones?')) return;
          
          const claseId = e.target.dataset.id;
          
          try {
            const formData = new FormData();
            formData.append('eliminar_clase', '1');
            formData.append('id_clase', claseId);
            
            const result = await sendAjaxRequest(formData);
            
            if (result.success) {
              showNotification(result.message, 'success');
              removeClaseFromTable(claseId);
              clases = clases.filter(c => c.id_clase != claseId);
              updateClaseSelects();
              removeUsuariosClaseFromTable(claseId);
            } else {
              showNotification(result.message, 'error');
            }
          } catch (error) {
            showNotification('Error de conexión', 'error');
          }
        }
      });

      // Asignar Usuario
      document.getElementById('formAsignarUsuario').addEventListener('submit', async function(e) {
        e.preventDefault();
        const button = this.querySelector('button[type="submit"]');
        toggleLoadingState(button, true);

        try {
          const formData = new FormData(this);
          formData.append('asignar_usuario', '1');
          
          const result = await sendAjaxRequest(formData);
          
          if (result.success) {
            showNotification(result.message, 'success');
            this.reset();
            // Reload page to refresh user-class assignments table
            setTimeout(() => location.reload(), 1000);
          } else {
            showNotification(result.message, 'error');
          }
        } catch (error) {
          showNotification('Error de conexión', 'error');
        } finally {
          toggleLoadingState(button, false);
        }
      });

      // Quitar Usuario de Clase
      document.addEventListener('click', async function(e) {
        if (e.target.classList.contains('btn-quitar-usuario')) {
          if (!confirm('¿Quitar usuario de esta clase?')) return;
          
          const userId = e.target.dataset.usuario;
          const claseId = e.target.dataset.clase;
          
          try {
            const formData = new FormData();
            formData.append('quitar_usuario', '1');
            formData.append('id_usuario', userId);
            formData.append('id_clase', claseId);
            
            const result = await sendAjaxRequest(formData);
            
            if (result.success) {
              showNotification(result.message, 'success');
              removeUsuarioClaseFromTable(userId, claseId);
            } else {
              showNotification(result.message, 'error');
            }
          } catch (error) {
            showNotification('Error de conexión', 'error');
          }
        }
      });

      // Crear Evento (with file upload)
      document.getElementById('formCrearEvento').addEventListener('submit', async function(e) {
        e.preventDefault();
        const button = this.querySelector('button[type="submit"]');
        toggleLoadingState(button, true);

        try {
          const formData = new FormData(this);
          formData.append('crear_evento', '1');
          
          const result = await sendAjaxRequest(formData);
          
          if (result.success) {
            showNotification(result.message, 'success');
            this.reset();
            toggleClase('general'); // Reset clase select
            
            if (result.data) {
              addEventoToGrid(result.data);
            }
          } else {
            showNotification(result.message, 'error');
          }
        } catch (error) {
          showNotification('Error de conexión', 'error');
        } finally {
          toggleLoadingState(button, false);
        }
      });

      // Eliminar Evento
      document.addEventListener('click', async function(e) {
        if (e.target.classList.contains('btn-eliminar-evento')) {
          if (!confirm('¿Eliminar este evento?')) return;
          
          const eventoId = e.target.dataset.id;
          
          try {
            const formData = new FormData();
            formData.append('eliminar_evento', '1');
            formData.append('id_evento', eventoId);
            
            const result = await sendAjaxRequest(formData);
            
            if (result.success) {
              showNotification(result.message, 'success');
              removeEventoFromGrid(eventoId);
            } else {
              showNotification(result.message, 'error');
            }
          } catch (error) {
            showNotification('Error de conexión', 'error');
          }
        }
      });
    });

    // Helper functions for DOM manipulation
    function addUsuarioToTable(usuario) {
      const tbody = document.querySelector('#tablaUsuarios tbody');
      const row = document.createElement('tr');
      row.dataset.id = usuario.id_usuario;
      row.innerHTML = `
        <td>${usuario.email}</td>
        <td>${usuario.rol}</td>
        <td>
          <form class="form-editar-usuario form-row" style="gap:8px;" data-id="${usuario.id_usuario}">
            <input type="email" name="email" value="${usuario.email}">
            <select name="rol">
              <option value="alumno" ${usuario.rol === 'alumno' ? 'selected' : ''}>Alumno</option>
              <option value="profesor" ${usuario.rol === 'profesor' ? 'selected' : ''}>Profesor</option>
            </select>
            <input type="password" name="password" placeholder="Nueva contraseña (opcional)">
            <button type="submit" class="btn">Guardar</button>
          </form>
        </td>
        <td>
          <button class="btn btn-danger btn-eliminar-usuario" data-id="${usuario.id_usuario}">
            Eliminar
          </button>
        </td>
      `;
      tbody.appendChild(row);
    }

    function updateUsuarioInTable(userId, formData) {
      const row = document.querySelector(`#tablaUsuarios tr[data-id="${userId}"]`);
      if (row) {
        const email = formData.get('email');
        const rol = formData.get('rol');
        row.cells[0].textContent = email;
        row.cells[1].textContent = rol;
      }
    }

    function removeUsuarioFromTable(userId) {
      const row = document.querySelector(`#tablaUsuarios tr[data-id="${userId}"]`);
      if (row) row.remove();
    }

    function addClaseToTable(clase) {
      const tbody = document.querySelector('#tablaClases tbody');
      const row = document.createElement('tr');
      row.dataset.id = clase.id_clase;
      row.innerHTML = `
        <td>${clase.nombre}</td>
        <td>${clase.año}</td>
        <td>
          <form class="form-editar-clase form-row" data-id="${clase.id_clase}">
            <input type="text" name="nombre" value="${clase.nombre}" required>
            <input type="text" name="anio" value="${clase.año}" required>
            <button type="submit" class="btn">Guardar</button>
          </form>
        </td>
        <td>
          <button class="btn btn-danger btn-eliminar-clase" data-id="${clase.id_clase}">
            Eliminar
          </button>
        </td>
      `;
      tbody.appendChild(row);
    }

    function updateClaseInTable(claseId, formData) {
      const row = document.querySelector(`#tablaClases tr[data-id="${claseId}"]`);
      if (row) {
        const nombre = formData.get('nombre');
        const anio = formData.get('anio');
        row.cells[0].textContent = nombre;
        row.cells[1].textContent = anio;
      }
    }

    function removeClaseFromTable(claseId) {
      const row = document.querySelector(`#tablaClases tr[data-id="${claseId}"]`);
      if (row) row.remove();
    }

    function removeUsuariosClaseFromTable(claseId) {
      const rows = document.querySelectorAll(`#tablaUsuariosClases tr[data-clase="${claseId}"]`);
      rows.forEach(row => row.remove());
    }

    function removeUsuarioClaseFromTable(userId, claseId) {
      const row = document.querySelector(`#tablaUsuariosClases tr[data-usuario="${userId}"][data-clase="${claseId}"]`);
      if (row) row.remove();
    }

    function addEventoToGrid(evento) {
      const grid = document.getElementById('eventGrid');
      const eventCard = document.createElement('div');
      eventCard.className = 'event-card';
      eventCard.dataset.id = evento.id_evento;
      eventCard.dataset.titulo = evento.titulo.toLowerCase();
      eventCard.dataset.tipo = evento.tipo.toLowerCase();
      
      const imageSrc = evento.imagen ? `uploads/${evento.imagen}` : 'uploads/default.jpg';
      
      eventCard.innerHTML = `
        <img src="${imageSrc}" alt="Evento">
        <div class="info">
          <h3>${evento.titulo}</h3>
          <p>📅 ${evento.fecha}</p>
          <p>🏷️ ${evento.tipo.charAt(0).toUpperCase() + evento.tipo.slice(1)}</p>
          ${evento.tipo === 'clase' ? '<p>👩‍🏫 Clase: ' + (evento.clase_nombre || '') + '</p>' : ''}
          <button class="btn btn-danger btn-eliminar-evento" data-id="${evento.id_evento}">
            Eliminar
          </button>
        </div>
      `;
      
      grid.prepend(eventCard);
    }

    function removeEventoFromGrid(eventoId) {
      const eventCard = document.querySelector(`.event-card[data-id="${eventoId}"]`);
      if (eventCard) eventCard.remove();
    }

    function updateUsuarioSelects() {
      const selects = document.querySelectorAll('select[name="id_usuario"]');
      selects.forEach(select => {
        const currentValue = select.value;
        select.innerHTML = '<option value="">-- Usuario --</option>';
        usuarios.forEach(u => {
          const option = document.createElement('option');
          option.value = u.id_usuario;
          option.textContent = `${u.rol.charAt(0).toUpperCase() + u.rol.slice(1)} - ${u.email}`;
          if (u.id_usuario == currentValue) option.selected = true;
          select.appendChild(option);
        });
      });
    }

    function updateClaseSelects() {
      const selects = document.querySelectorAll('select[name="id_clase"], #claseSelect, #filtroClase, #filtroClaseEvento');
      selects.forEach(select => {
        const currentValue = select.value;
        const isFilter = select.id === 'filtroClase' || select.id === 'filtroClaseEvento';
        
        select.innerHTML = isFilter ? 
          '<option value="">Todas las clases</option>' : 
          '<option value="">-- Clase --</option>';
          
        clases.forEach(c => {
          const option = document.createElement('option');
          option.value = c.id_clase;
          option.textContent = `${c.año} - ${c.nombre}`;
          if (isFilter) {
            option.value = c.nombre;
          }
          if ((isFilter && c.nombre === currentValue) || (!isFilter && c.id_clase == currentValue)) {
            option.selected = true;
          }
          select.appendChild(option);
        });
      });
    }

    // Filtros Usuarios por clase
    document.addEventListener("DOMContentLoaded", function() {
      const buscarInput = document.getElementById("buscarUsuario");
      const filtroClase = document.getElementById("filtroClase");
      const filtroRol = document.getElementById("filtroRol");
      const filas = document.querySelectorAll("#tablaUsuariosClases tbody tr");

      function filtrar() {
        const texto = (buscarInput?.value || "").toLowerCase();
        const claseSel = (filtroClase?.value || "").toLowerCase();
        const rolSel = (filtroRol?.value || "").toLowerCase();

        filas.forEach(tr => {
          const clase = tr.cells[0].innerText.toLowerCase();
          const usuario = tr.cells[2].innerText.toLowerCase();
          const rol = tr.cells[3].innerText.toLowerCase();

          const coincideTexto = usuario.includes(texto);
          const coincideClase = !claseSel || clase.includes(claseSel);
          const coincideRol = !rolSel || rol.includes(rolSel);

          tr.style.display = (coincideTexto && coincideClase && coincideRol) ? "" : "none";
        });
      }
      if (buscarInput && filtroClase && filtroRol) {
        buscarInput.addEventListener("keyup", filtrar);
        filtroClase.addEventListener("change", filtrar);
        filtroRol.addEventListener("change", filtrar);
      }
    });

    // Filtros Eventos
    document.addEventListener("DOMContentLoaded", function() {
      const buscarEvento = document.getElementById("buscarEvento");
      const filtroTipo = document.getElementById("filtroTipo");
      const filtroClaseEvento = document.getElementById("filtroClaseEvento");
      const eventos = document.querySelectorAll(".event-card");

      function filtrarEventos() {
        const texto = (buscarEvento?.value || "").toLowerCase();
        const tipoSel = (filtroTipo?.value || "").toLowerCase();
        const claseSel = (filtroClaseEvento?.value || "").toLowerCase();

        eventos.forEach(ev => {
          const titulo = ev.dataset.titulo || "";
          const tipo = ev.dataset.tipo || "";
          const clase = ev.dataset.clase || "";

          const coincideTexto = titulo.includes(texto);
          const coincideTipo = !tipoSel || tipo === tipoSel;
          const coincideClase = !claseSel || clase.includes(claseSel);

          ev.style.display = (coincideTexto && coincideTipo && coincideClase) ? "block" : "none";
        });
      }

      if (buscarEvento && filtroTipo && filtroClaseEvento) {
        buscarEvento.addEventListener("keyup", filtrarEventos);
        filtroTipo.addEventListener("change", filtrarEventos);
        filtroClaseEvento.addEventListener("change", filtrarEventos);
      }
    });
  </script>
</body>
</html>