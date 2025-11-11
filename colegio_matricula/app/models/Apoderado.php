<?php
class Apoderado {
    private $db;

    public function __construct() {
        if (!class_exists('Database')) {
            require_once 'Database.php';
        }
        $this->db = Database::getInstance()->getConnection();
    }

    /**
     * Busca un apoderado por su RUT.
     */
    public function findByRut(string $rut): mixed {
        $stmt = $this->db->prepare("SELECT * FROM apoderados WHERE rut = :rut");
        $stmt->execute(['rut' => $rut]);
        return $stmt->fetch();
    }

    /**
     * Crea un nuevo apoderado (Titular o Suplente)
     */
    public function create(array $data, string $tipo): int {
        $sql = "INSERT INTO apoderados (rut, nombre, direccion, poblacion, nivel_escolar, parentesco, profesion_actividad, telefono, correo) 
                VALUES (:rut, :nombre, :direccion, :poblacion, :nivel_escolar, :parentesco, :profesion, :telefono, :correo)";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':rut' => $data["rut_{$tipo}"],
            ':nombre' => $data["nombre_{$tipo}"],
            ':direccion' => $data["direccion_{$tipo}"],
            ':poblacion' => $data["poblacion_{$tipo}"],
            ':nivel_escolar' => $data["nivel_escolar_{$tipo}"] ?? null,
            ':parentesco' => $data["parentesco_{$tipo}"] ?? null,
            ':profesion' => $data["profesion_{$tipo}"] ?? null,
            ':telefono' => $data["telefono_{$tipo}"],
            ':correo' => $data["correo_{$tipo}"] ?? null
        ]);
        return (int)$this->db->lastInsertId();
    }

    /**
     * Actualiza un apoderado existente (Titular o Suplente)
     */
    public function update(int $id, array $data, string $tipo): bool {
        $sql = "UPDATE apoderados SET
                    nombre = :nombre, 
                    direccion = :direccion, 
                    poblacion = :poblacion, 
                    nivel_escolar = :nivel_escolar, 
                    parentesco = :parentesco, 
                    profesion_actividad = :profesion, 
                    telefono = :telefono, 
                    correo = :correo
                WHERE id_apoderado = :id_apoderado";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':nombre' => $data["nombre_{$tipo}"],
            ':direccion' => $data["direccion_{$tipo}"],
            ':poblacion' => $data["poblacion_{$tipo}"],
            ':nivel_escolar' => $data["nivel_escolar_{$tipo}"] ?? null,
            ':parentesco' => $data["parentesco_{$tipo}"] ?? null,
            ':profesion' => $data["profesion_{$tipo}"] ?? null,
            ':telefono' => $data["telefono_{$tipo}"],
            ':correo' => $data["correo_{$tipo}"] ?? null,
            ':id_apoderado' => $id
        ]);
    }
}