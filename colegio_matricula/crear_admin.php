<?php
// Carga la conexión de la BD
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/app/models/Database.php';

// Contraseña que quieres usar
$password_plano = 'admin123'; // ¡Cámbiala!

// El hash que se guardará
$password_hasheado = password_hash($password_plano, PASSWORD_DEFAULT);

$email = 'admin@colegio.cl';
$nombre = 'Admin General';

try {
    $db = Database::getInstance()->getConnection();
    
    $stmt = $db->prepare("INSERT INTO usuarios (email, password_hash, nombre) VALUES (:email, :pass, :nombre)");
    $stmt->execute([
        ':email' => $email,
        ':pass' => $password_hasheado,
        ':nombre' => $nombre
    ]);

    echo "¡Usuario Admin creado exitosamente!";

} catch (\PDOException $e) {
    echo "Error: " . $e->getMessage();
}