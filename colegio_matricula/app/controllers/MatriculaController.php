<?php
// Carga de todos los modelos necesarios
require_once __DIR__ . '/../models/Database.php';
require_once __DIR__ . '/../models/Alumno.php';
require_once __DIR__ . '/../models/Apoderado.php';
require_once __DIR__ . '/../models/Antecedentes.php'; // ¡Nuevo!

class MatriculaController {
    
    // Muestra el formulario
    public function index() {
        $this->loadView('formulario');
    }

    // Procesa el guardado
    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php');
            return;
        }

        // 1. Sanitizar los datos (versión corregida)
        $data = $this->sanitizar($_POST);

        // 2. Validar los datos (versión Fase 2)
        $errors = $this->validar($data);

        // 3. Validación de duplicado de ALUMNO (¡Importante!)
        $alumnoModel = new Alumno();
        if ($alumnoModel->findByRut($data['rut_alumno'])) {
            $errors[] = "El RUT del alumno ingresado ya se encuentra matriculado.";
        }

        if (!empty($errors)) {
            // Devolver al formulario con errores y los datos ya ingresados
            $this->loadView('formulario', ['errors' => $errors, 'data' => $data]);
            return;
        }

        // 4. Pre-procesamiento de datos (Arrays y Booleans)
        
        // Convertir array de "vive_con" a string
        $data['vive_con_string'] = implode(', ', $data['vive_con'] ?? []);
        
        // Asegurar valores 0 o 1 para radios (si no vienen, son 0)
        $data['restriccion_judicial'] = $data['restriccion_judicial'] ?? 0;
        $data['diagnostico'] = $data['diagnostico'] ?? 0;
        $data['diagnostico_documento'] = $data['diagnostico_documento'] ?? 0;
        $data['tratamiento'] = $data['tratamiento'] ?? 0;
        
        // Asegurar valor 1 para checkboxes (si vienen, son 1)
        $data['acepta_reglamento'] = $data['acepta_reglamento'] ?? 1; // Ya están validados como 'required'
        $data['acepta_no_pie'] = $data['acepta_no_pie'] ?? 1;
        $data['acepta_mensajeria'] = $data['acepta_mensajeria'] ?? 1;
        $data['acepta_fotos_rrss'] = $data['acepta_fotos_rrss'] ?? 1;


        // 5. Iniciar Transacción (CRÍTICO)
        $db = Database::getInstance()->getConnection();
        $db->beginTransaction();

        try {
            // Instanciar modelos
            $apoderadoModel = new Apoderado();
            $antecedentesModel = new Antecedentes();
            // $alumnoModel ya está instanciado

            // --- Lógica de Apoderados ---
            
            // a. Apoderado Titular (Buscar o crear)
            $titular = $apoderadoModel->findByRut($data['rut_titular']);
            if ($titular) {
                $apoderadoModel->update($titular['id_apoderado'], $data, 'titular');
                $idTitular = $titular['id_apoderado'];
            } else {
                $idTitular = $apoderadoModel->create($data, 'titular');
            }

            // b. Apoderado Suplente (Buscar o crear, si existe)
            if (!empty($data['rut_suplente'])) {
                $suplente = $apoderadoModel->findByRut($data['rut_suplente']);
                if ($suplente) {
                    $apoderadoModel->update($suplente['id_apoderado'], $data, 'suplente');
                    $idSuplente = $suplente['id_apoderado'];
                } else {
                    $idSuplente = $apoderadoModel->create($data, 'suplente');
                }
            }

            // c. Crear Alumno
            // (La validación de RUT duplicado ya se hizo arriba)
            $idAlumno = $alumnoModel->create($data);

            // d. Vincular en tabla pivote
            $alumnoModel->linkApoderado($idAlumno, $idTitular, 'titular');
            if (isset($idSuplente)) {
                $alumnoModel->linkApoderado($idAlumno, $idSuplente, 'suplente');
            }

            // e. Crear Antecedentes
            $antecedentesModel->create($idAlumno, $data);
            
            // 6. Confirmar Transacción
            $db->commit();

            // 7. Éxito: Redirigir
            header('Location: ' . BASE_URL . 'exito/' . $idAlumno);
            exit;

        } catch (\Exception $e) {
            // 8. Error: Revertir Transacción
            $db->rollBack();
            $errors[] = "Error fatal al guardar los datos: " . $e->getMessage();
            $this->loadView('formulario', ['errors' => $errors, 'data' => $data]);
        }
    }

    // Muestra la ficha imprimible
    public function imprimir(int $idAlumno) {
        $alumnoModel = new Alumno();
        // Llamamos al nuevo método que une las 4 tablas
        $datosFicha = $alumnoModel->getFichaCompleta($idAlumno); 

        if (!$datosFicha) {
            // Manejar error si el ID no existe o la consulta falla
            echo "Error: No se pudo generar la ficha. Alumno no encontrado.";
            return;
        }
        
        $this->loadView('ficha', ['ficha' => $datosFicha]);
    }

    // Muestra la página de éxito
    public function exito(int $idAlumno) {
        $this->loadView('exito', ['idAlumno' => $idAlumno]);
    }

    // --- Funciones Helper ---

    /**
     * Sanitiza los datos de entrada (POST).
     * Maneja arrays (como los checkboxes) de forma recursiva.
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
     * Valida los datos del formulario (Fase 2).
     */
    private function validar(array $data): array {
        $errors = [];
        $regexRUT = '/^(\d{1,2}\.?\d{3}\.?\d{3}-[\dkK])$/';
        $regexLetras = '/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/';

        // --- 1. ALUMNO ---
        if (empty($data['rut_alumno'])) $errors[] = "RUT del Alumno es obligatorio.";
        elseif (!preg_match($regexRUT, $data['rut_alumno'])) $errors[] = "Formato del RUT del Alumno es inválido.";
        
        if (empty($data['curso'])) $errors[] = "Curso es obligatorio.";
        if (empty($data['apellido_paterno'])) $errors[] = "Apellido Paterno (Alumno) es obligatorio.";
        if (empty($data['apellido_materno'])) $errors[] = "Apellido Materno (Alumno) es obligatorio.";
        if (empty($data['nombres_alumno'])) $errors[] = "Nombres del Alumno son obligatorios.";
        
        if (!empty($data['apellido_paterno']) && !preg_match($regexLetras, $data['apellido_paterno'])) $errors[] = "Apellido Paterno solo debe contener letras.";
        if (!empty($data['apellido_materno']) && !preg_match($regexLetras, $data['apellido_materno'])) $errors[] = "Apellido Materno solo debe contener letras.";
        if (!empty($data['nombres_alumno']) && !preg_match($regexLetras, $data['nombres_alumno'])) $errors[] = "Nombres (Alumno) solo debe contener letras.";

        if (empty($data['fecha_nacimiento'])) $errors[] = "Fecha de Nacimiento (Alumno) es obligatoria.";
        if (empty($data['domicilio_alumno'])) $errors[] = "Domicilio (Alumno) es obligatorio.";
        if (empty($data['poblacion_alumno'])) $errors[] = "Población (Alumno) es obligatoria.";
        if (empty($data['comuna_alumno'])) $errors[] = "Comuna (Alumno) es obligatoria.";

        // --- 2. APODERADO TITULAR ---
        if (empty($data['rut_titular'])) $errors[] = "RUT del Apoderado Titular es obligatorio.";
        elseif (!preg_match($regexRUT, $data['rut_titular'])) $errors[] = "Formato del RUT del Titular es inválido.";
        
        if (empty($data['nombre_titular'])) $errors[] = "Nombre del Apoderado Titular es obligatorio.";
        if (empty($data['direccion_titular'])) $errors[] = "Dirección del Titular es obligatoria.";
        if (empty($data['poblacion_titular'])) $errors[] = "Población del Titular es obligatoria.";
        if (empty($data['nivel_escolar_titular'])) $errors[] = "Nivel Escolar del Titular es obligatorio.";
        if (empty($data['parentesco_titular'])) $errors[] = "Parentesco del Titular es obligatorio.";
        if (empty($data['profesion_titular'])) $errors[] = "Profesión del Titular es obligatoria.";
        if (empty($data['telefono_titular'])) $errors[] = "Teléfono del Titular es obligatorio.";
        if (empty($data['correo_titular'])) $errors[] = "Correo del Titular es obligatorio.";

        // --- 3. APODERADO SUPLENTE (Opcional) ---
        if (!empty($data['rut_suplente'])) {
            if (!preg_match($regexRUT, $data['rut_suplente'])) $errors[] = "Formato del RUT del Suplente es inválido.";
            if (empty($data['nombre_suplente'])) $errors[] = "Nombre del Suplente es obligatorio (si se ingresa RUT).";
            if (empty($data['telefono_suplente'])) $errors[] = "Teléfono del Suplente es obligatorio (si se ingresa RUT).";
        }

        // --- 4. RETIROS ---
        if (empty($data['retira_1_nombre'])) $errors[] = "Nombre (Retira Persona 1) es obligatorio.";
        if (empty($data['retira_1_telefono'])) $errors[] = "Teléfono (Retira Persona 1) es obligatorio.";

        // --- 5. CONSENTIMIENTOS ---
        if (empty($data['acepta_reglamento'])) $errors[] = "Debe aceptar el Reglamento Interno.";
        if (empty($data['acepta_no_pie'])) $errors[] = "Debe aceptar la declaración sobre el PIE.";
        if (empty($data['acepta_mensajeria'])) $errors[] = "Debe darse por enterado sobre la mensajería.";
        if (empty($data['acepta_fotos_rrss'])) $errors[] = "Debe aceptar la política de fotos.";
        
        return $errors;
    }

    /**
     * Helper para cargar las vistas (header, content, footer).
     */
    private function loadView(string $viewName, array $data = []) {
        extract($data); // Convierte ['key' => 'val'] a $key = 'val'
        require __DIR__ . "/../views/layouts/header.php";
        require __DIR__ . "/../views/matricula/{$viewName}.php";
        require __DIR__ . "/../views/layouts/footer.php";
    }
}