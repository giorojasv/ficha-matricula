<?php
// Configuración de la Base de Datos
define('DB_HOST', 'localhost'); // O tu host
define('DB_NAME', 'colegio_matricula');
define('DB_USER', 'root');      // Tu usuario de BD
define('DB_PASS', ''); // Tu contraseña de BD
define('DB_CHARSET', 'utf8mb4');

// Configuración de la Aplicación
// Ajusta la URL base según tu entorno (ej. http://localhost/colegio_matricula/public/)
define('BASE_URL', 'https://academiahospicio.cl/colegio_matricula/public/'); 

// Configuración de zona horaria (opcional pero recomendado)
date_default_timezone_set('America/Santiago');