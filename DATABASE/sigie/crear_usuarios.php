<?php
require_once "conexion.php"; // tu conexión

$pass_coordinador = password_hash("123456", PASSWORD_DEFAULT);
$pass_profesor = password_hash("123456", PASSWORD_DEFAULT);

$sql = "INSERT INTO usuarios (nombre, email, contraseña, rol) VALUES
('Coordinador General', 'coordinador@scuolaitaliana.edu.uy', '$pass_coordinador', 'coordinador'),
('Marcos Méndez', 'mmendez@scuolaitaliana.edu.uy', '$pass_profesor', 'profesor')";

if ($conn->query($sql) === TRUE) {
    echo "Usuarios creados correctamente";
} else {
    echo "Error: " . $conn->error;
}
