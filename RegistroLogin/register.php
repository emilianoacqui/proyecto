<?php
header('Content-Type: application/json; charset=utf-8');
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  echo json_encode(['ok' => false, 'error' => 'Método no permitido']);
  exit;
}

$email = trim($_POST['email'] ?? '');
$pass  = $_POST['password'] ?? '';

if ($email === '' || $pass === '') {
  echo json_encode(['ok' => false, 'error' => 'Email y contraseña son obligatorios']);
  exit;
}

/* Enforce dominio institucional también en backend */
if (!preg_match('/@scuolaitaliana\.edu\.uy$/i', $email)) {
  echo json_encode(['ok' => false, 'error' => 'Debe usar un correo @scuolaitaliana.edu.uy']);
  exit;
}

/* ¿Ya existe? */
$stmt = $conn->prepare("SELECT id_usuario FROM usuarios WHERE email=? LIMIT 1");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
  echo json_encode(['ok' => false, 'error' => 'El correo ya está registrado']);
  exit;
}
$stmt->close();

/* Nombre: usamos la parte antes del @ para no tocar tu formulario */
list($nombre) = explode('@', $email, 2);
$hash = password_hash($pass, PASSWORD_DEFAULT);
$rol  = 'alumno';  // los profesores los crea coordinación

$stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, password, rol) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $nombre, $email, $hash, $rol);

if ($stmt->execute()) {
  echo json_encode(['ok' => true, 'message' => 'Registro exitoso']);
} else {
  echo json_encode(['ok' => false, 'error' => 'Error al registrar: '.$conn->error]);
}
