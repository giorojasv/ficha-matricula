<?php
// Carga de todos los modelos necesarios
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Alumno.php';
require_once __DIR__ . '/../models/Apoderado.php';
require_once __DIR__ . '/../models/Antecedentes.php';

class AdminController {

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Verifica si el admin está logueado.
     * Si no, lo redirige al login.
     */
    private function checkAuth() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . 'login');
            exit;
        }
    }

    /**
     * Muestra el formulario de login.
     */
    public function login() {
        // Carga la vista de login (esta no usa el layout)
        require_once __DIR__ . '/../views/admin/login.php';
    }

    /**
     * Procesa la autenticación (el POST del login).
     */
    public function authenticate() {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $userModel = new User();
        $user = $userModel->findByEmail($email);

        if ($user && password_verify($password, $user['password_hash'])) {
            $_SESSION['user_id'] = $user['id_usuario'];
            $_SESSION['user_email'] = $user['email'];
            header('Location: ' . BASE_URL . 'admin/dashboard');
            exit;
        } else {
            $error = "Correo o contraseña incorrectos.";
            require_once __DIR__ . '/../views/admin/login.php';
        }
    }

    /**
     * Cierra la sesión.
     */
    public function logout() {
        session_destroy();
        header('Location: ' . BASE_URL . 'login');
        exit;
    }

    /**
     * Muestra el dashboard principal (buscador y estadísticas).
     */
    public function dashboard() {
        $this->checkAuth(); // ¡Protegido!
        
        $alumnoModel = new Alumno();
        
        // 1. Obtener estadísticas
        $totalAlumnos = $alumnoModel->getTotalAlumnos();
        $conteoCursos = $alumnoModel->getConteoPorCurso();

        // 2. Preparar datos para la vista
        $data = [
            'totalAlumnos' => $totalAlumnos,
            'conteoCursos' => $conteoCursos
        ];

        // Carga la vista del dashboard con los datos
        $this->loadAdminView('dashboard', $data);
    }

    /**
     * Procesa la búsqueda por RUT.
     * (VERSIÓN CORREGIDA: Ahora incluye las estadísticas)
     */
    public function buscar() {
        $this->checkAuth(); // ¡Protegido!
        
        $alumnoModel = new Alumno();
        
        // --- 1. OBTENER ESTADÍSTICAS (La parte que faltaba) ---
        $totalAlumnos = $alumnoModel->getTotalAlumnos();
        $conteoCursos = $alumnoModel->getConteoPorCurso();

        // --- 2. OBTENER DATOS DE BÚSQUEDA ---
        $rut = $_POST['rut_busqueda'] ?? '';
        $alumno = $alumnoModel->findByRut($rut); // Reutilizamos el método

        // --- 3. COMBINAR TODOS LOS DATOS PARA LA VISTA ---
        $data = [
            'totalAlumnos' => $totalAlumnos,
            'conteoCursos' => $conteoCursos,
            'alumno' => $alumno,
            'rut_buscado' => $rut
        ];

        // 4. Cargar la vista con TODOS los datos
        $this->loadAdminView('dashboard', $data);
    }

    /**
     * Muestra el formulario de edición para un alumno.
     */
    public function editar(int $idAlumno) {
        $this->checkAuth(); 

        $alumnoModel = new Alumno();
        $ficha = $alumnoModel->getFichaCompleta($idAlumno); // Usa la "Super-Consulta"

        if (!$ficha) {
            header('Location: ' . BASE_URL . 'admin/dashboard');
            exit;
        }

        // Convertir string "Mama, Papa" a array ['Mama', 'Papa'] para los checkboxes
        $ficha['vive_con_array'] = explode(', ', $ficha['alumno_vive_con'] ?? '');

        $this->loadAdminView('editar', ['ficha' => $ficha]);
    }

    /**
     * Procesa la actualización (POST) del formulario de edición.
     */
    public function actualizar(int $idAlumno) {
        $this->checkAuth();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . 'admin/dashboard');
            exit;
        }

        $data = $this->sanitizar($_POST);

        // Pre-procesamiento de datos (Arrays y Booleans)
        $data['vive_con_string'] = implode(', ', $data['vive_con'] ?? []);
        $data['restriccion_judicial'] = $data['restriccion_judicial'] ?? 0;
        $data['diagnostico'] = $data['diagnostico'] ?? 0;
        $data['diagnostico_documento'] = $data['diagnostico_documento'] ?? 0;
        $data['tratamiento'] = $data['tratamiento'] ?? 0;
        $data['acepta_reglamento'] = $data['acepta_reglamento'] ?? 0;
        $data['acepta_no_pie'] = $data['acepta_no_pie'] ?? 0;
        $data['acepta_mensajeria'] = $data['acepta_mensajeria'] ?? 0;
        $data['acepta_fotos_rrss'] = $data['acepta_fotos_rrss'] ?? 0;

        $db = Database::getInstance()->getConnection();
        $db->beginTransaction();

        try {
            $alumnoModel = new Alumno();
            $apoderadoModel = new Apoderado();
            $antecedentesModel = new Antecedentes();

            // a. Actualizar Alumno
            $alumnoModel->update($idAlumno, $data);

            // b. Actualizar Apoderado Titular (con cast (int))
            $apoderadoModel->update( (int)$data['id_titular_hidden'], $data, 'titular');

            // c. Actualizar Apoderado Suplente (si existe)
            if (!empty($data['rut_suplente']) && !empty($data['id_suplente_hidden'])) {
                $apoderadoModel->update( (int)$data['id_suplente_hidden'], $data, 'suplente');
            }
            
            // d. Actualizar Antecedentes
            $antecedentesModel->update($idAlumno, $data);

            $db->commit();
            header('Location: ' . BASE_URL . 'admin/dashboard');
            exit;

        } catch (\Exception $e) {
            $db->rollBack();
            echo "Error al actualizar: " . $e->getMessage();
            exit;
        }
    }

    /**
     * Elimina una ficha de alumno.
     */
    public function eliminar(int $idAlumno) {
        $this->checkAuth(); // Protegido

        $alumnoModel = new Alumno();
        $exito = $alumnoModel->delete($idAlumno); 

        header('Location: ' . BASE_URL . 'admin/dashboard');
        exit;
    }


    /**
     * Sanitiza los datos de entrada (POST).
     */
    private function sanitizar(array $data): array {
        $sanitized = [];
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $sanitized_array = [];
                foreach ($value as $item) {
                    $sanitized_array[] = trim(htmlspecialchars($item));
                }
                $sanitized[$key] = $sanitized_array;
            } else {
                $sanitized[$key] = trim(htmlspecialchars((string)$value));
            }
        }
        return $sanitized;
    }

    /**
     * Helper para cargar vistas de admin (con layout).
     */
    private function loadAdminView(string $viewName, array $data = []) {
        extract($data);
        require __DIR__ . "/../views/layouts/header.php";
        require __DIR__ . "/../views/admin/{$viewName}.php";
        require __DIR__ . "/../views/layouts/footer.php";
    }
}