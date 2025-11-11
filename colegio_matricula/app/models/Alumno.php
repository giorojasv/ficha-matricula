<?php
class Alumno {
    private $db;

    public function __construct() {
        if (!class_exists('Database')) {
            require_once 'Database.php';
        }
        $this->db = Database::getInstance()->getConnection();
    }

    /**
     * Busca un alumno por su RUT.
     */
    public function findByRut(string $rut): mixed {
        $stmt = $this->db->prepare("SELECT * FROM alumnos WHERE rut = :rut");
        $stmt->execute(['rut' => $rut]);
        return $stmt->fetch();
    }

    /**
     * Crea un nuevo alumno con los campos del PDF.
     */
    public function create(array $data): int {
        $sql = "INSERT INTO alumnos (rut, curso, apellido_paterno, apellido_materno, nombre, nombre_social, fecha_nacimiento, domicilio, poblacion, comuna) 
                VALUES (:rut, :curso, :ap_paterno, :ap_materno, :nombres, :nombre_social, :fecha_nac, :domicilio, :poblacion, :comuna)";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':rut' => $data['rut_alumno'],
            ':curso' => $data['curso'],
            ':ap_paterno' => $data['apellido_paterno'],
            ':ap_materno' => $data['apellido_materno'],
            ':nombres' => $data['nombres_alumno'],
            ':nombre_social' => $data['nombre_social'] ?? null,
            ':fecha_nac' => $data['fecha_nacimiento'],
            ':domicilio' => $data['domicilio_alumno'],
            ':poblacion' => $data['poblacion_alumno'],
            ':comuna' => $data['comuna_alumno']
        ]);
        return (int)$this->db->lastInsertId();
    }

    /**
     * Vincula un alumno con un apoderado en la tabla pivote.
     */
    public function linkApoderado(int $idAlumno, int $idApoderado, string $tipo): bool {
        $sql = "INSERT INTO alumnos_apoderados (id_alumno, id_apoderado, tipo) VALUES (:id_alumno, :id_apoderado, :tipo)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':id_alumno' => $idAlumno,
            ':id_apoderado' => $idApoderado,
            ':tipo' => $tipo // 'titular' o 'suplente'
        ]);
    }

   /**
     * Obtiene TODOS los datos de la ficha uniendo las 4 tablas.
     * (Versión corregida que incluye todos los campos)
     */
    public function getFichaCompleta(int $idAlumno): mixed {
        
        $sql = "SELECT
                    -- Alumno (alias 'a')
                    a.*, 
                    
                    -- Antecedentes (alias 'ant')
                    ant.*,
                    
                    -- Apoderado Titular (alias 'apo_t')
                    apo_t.id_apoderado AS id_apoderado_titular,
                    apo_t.nombre AS nombre_titular,
                    apo_t.rut AS rut_titular,
                    apo_t.telefono AS telefono_titular,            /* <-- AÑADIDO */
                    apo_t.correo AS correo_titular,              /* <-- AÑADIDO */
                    apo_t.parentesco AS parentesco_titular,        /* <-- AÑADIDO */
                    apo_t.profesion_actividad AS profesion_titular, /* <-- AÑADIDO */
                    apo_t.direccion AS direccion_titular,         /* <-- AÑADIDO (para editar) */
                    apo_t.poblacion AS poblacion_titular,         /* <-- AÑADIDO (para editar) */
                    apo_t.nivel_escolar AS nivel_escolar_titular, /* <-- AÑADIDO (para editar) */
                    
                    -- Apoderado Suplente (alias 'apo_s')
                    apo_s.id_apoderado AS id_apoderado_suplente,
                    apo_s.nombre AS nombre_suplente,
                    apo_s.rut AS rut_suplente,
                    apo_s.telefono AS telefono_suplente,            /* <-- AÑADIDO */
                    apo_s.correo AS correo_suplente,              /* <-- AÑADIDO (para editar) */
                    apo_s.parentesco AS parentesco_suplente,        /* <-- AÑADIDO (para editar) */
                    apo_s.profesion_actividad AS profesion_suplente, /* <-- AÑADIDO (para editar) */
                    apo_s.direccion AS direccion_suplente,         /* <-- AÑADIDO (para editar) */
                    apo_s.poblacion AS poblacion_suplente,         /* <-- AÑADIDO (para editar) */
                    apo_s.nivel_escolar AS nivel_escolar_suplente /* <-- AÑADIDO (para editar) */
                    
                FROM alumnos a

                -- Join Antecedentes
                LEFT JOIN antecedentes_alumno ant ON a.id_alumno = ant.id_alumno

                -- Join Titular (vía tabla pivote)
                LEFT JOIN alumnos_apoderados pivot_t ON a.id_alumno = pivot_t.id_alumno AND pivot_t.tipo = 'titular'
                LEFT JOIN apoderados apo_t ON pivot_t.id_apoderado = apo_t.id_apoderado

                -- Join Suplente (vía tabla pivote)
                LEFT JOIN alumnos_apoderados pivot_s ON a.id_alumno = pivot_s.id_alumno AND pivot_s.tipo = 'suplente'
                LEFT JOIN apoderados apo_s ON pivot_s.id_apoderado = apo_s.id_apoderado

                WHERE a.id_alumno = :id_alumno";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id_alumno' => $idAlumno]);
        return $stmt->fetch();
    }
    /**
     * Busca un alumno por su ID.
     */
    public function findById(int $id): mixed {
        $stmt = $this->db->prepare("SELECT * FROM alumnos WHERE id_alumno = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    /**
     * Actualiza los datos de un alumno.
     */
    /**
     * Actualiza los datos de un alumno (Tabla 'alumnos').
     */
    public function update(int $id, array $data): bool {
        $sql = "UPDATE alumnos SET 
                    rut = :rut, 
                    curso = :curso,
                    apellido_paterno = :ap_paterno,
                    apellido_materno = :ap_materno,
                    nombre = :nombres,
                    nombre_social = :nombre_social,
                    fecha_nacimiento = :fecha_nac,
                    domicilio = :domicilio,
                    poblacion = :poblacion,
                    comuna = :comuna
                WHERE id_alumno = :id_alumno";
        
        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute([
            ':rut' => $data['rut_alumno'],
            ':curso' => $data['curso'],
            ':ap_paterno' => $data['apellido_paterno'],
            ':ap_materno' => $data['apellido_materno'],
            ':nombres' => $data['nombres_alumno'],
            ':nombre_social' => $data['nombre_social'] ?? null,
            ':fecha_nac' => $data['fecha_nacimiento'],
            ':domicilio' => $data['domicilio_alumno'],
            ':poblacion' => $data['poblacion_alumno'],
            ':comuna' => $data['comuna_alumno'],
            ':id_alumno' => $id
        ]);
    }


    /**
     * Cuenta el total de alumnos matriculados.
     */
    public function getTotalAlumnos(): int {
        $stmt = $this->db->query("SELECT COUNT(*) AS total FROM alumnos");
        return (int)$stmt->fetch()['total'];
    }

    /**
     * Devuelve un conteo de alumnos agrupados por curso.
     */
    public function getConteoPorCurso(): array {
        $sql = "SELECT curso, COUNT(*) AS cantidad 
                FROM alumnos 
                GROUP BY curso 
                ORDER BY curso ASC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }
    
    public function delete(int $idAlumno): bool {
        $stmt = $this->db->prepare("DELETE FROM alumnos WHERE id_alumno = :id_alumno");
        return $stmt->execute([':id_alumno' => $idAlumno]);
    }
}