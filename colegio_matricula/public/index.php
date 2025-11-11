<?php
session_start();
require_once __DIR__ . '/../config/config.php';

// Cargamos ambos controladores
require_once __DIR__ . '/../app/controllers/MatriculaController.php';
require_once __DIR__ . '/../app/controllers/AdminController.php';

$url = $_GET['url'] ?? '';
$url = rtrim($url, '/');
$url = filter_var($url, FILTER_SANITIZE_URL);
$parts = explode('/', $url);

$action = $parts[0] ?? 'index'; // 'index', 'guardar', 'admin'
$param1 = $parts[1] ?? null;  // 'imprimir' -> ID, 'admin' -> 'dashboard'
$param2 = $parts[2] ?? null;  // 'admin' -> 'editar' -> ID

// Instanciamos controladores
$matriculaController = new MatriculaController();
$adminController = new AdminController();

// --- ENRUTADOR PRINCIPAL ---
switch ($action) {
    // --- Rutas Públicas (Matrícula) ---
    case 'index':
    case '':
        $matriculaController->index();
        break;
    case 'guardar':
        $matriculaController->guardar();
        break;
    case 'imprimir':
        if ($param1) $matriculaController->imprimir((int)$param1);
        else header('Location: ' . BASE_URL);
        break;
    case 'exito':
        if ($param1) $matriculaController->exito((int)$param1);
        else header('Location: '. BASE_URL);
        break;

    // --- Rutas de Admin (Login) ---
    case 'login':
        $adminController->login();
        break;
        
    case 'admin':
        // Sub-enrutador para admin
        $adminAction = $param1 ?? 'dashboard'; // 'dashboard', 'authenticate', 'buscar'
        
        switch ($adminAction) {
            case 'dashboard':
                $adminController->dashboard();
                break;
            case 'authenticate':
                $adminController->authenticate();
                break;
            case 'buscar':
                $adminController->buscar();
                break;
            case 'logout':
                $adminController->logout();
                break;
            case 'editar':
                if ($param2) {
                    $adminController->editar((int)$param2);
                } else {
                    header('Location: ' . BASE_URL . 'admin/dashboard');
                }
                break;
            case 'actualizar':
                if ($param2) {
                    $adminController->actualizar((int)$param2);
                } else {
                    header('Location: ' . BASE_URL . 'admin/dashboard');
                }
                break;
            
            // ========================== //
            //      NUEVA RUTA AÑADIDA    //
            // ========================== //
            case 'eliminar':
                if ($param2) {
                    $adminController->eliminar((int)$param2);
                } else {
                    header('Location: ' . BASE_URL . 'admin/dashboard');
                }
                break;

            default:
                $adminController->dashboard();
                break;
        }
        break;

    // --- Default ---
    default:
        $matriculaController->index();
        break;
}