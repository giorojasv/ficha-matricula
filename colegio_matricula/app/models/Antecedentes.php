<?php
class Antecedentes {
    private $db;

    public function __construct() {
        if (!class_exists('Database')) {
            require_once 'Database.php';
        }
        $this->db = Database::getInstance()->getConnection();
    }

    /**
     * Crea el registro de antecedentes para un alumno.
     */
    public function create(int $idAlumno, array $data): bool {
        $sql = "INSERT INTO antecedentes_alumno 
                    (id_alumno, retira_emergencia_1_nombre, retira_emergencia_1_telefono, 
                     retira_emergencia_2_nombre, retira_emergencia_2_telefono, 
                     alumno_vive_con, n_integrantes_familia, n_hijos, rsh_puntaje, 
                     restriccion_judicial, restriccion_motivo, 
                     diagnostico, diagnostico_documento, tratamiento, 
                     enfermedad, alergia_medicamento, 
                     acepta_reglamento, acepta_no_pie, acepta_mensajeria, acepta_fotos_rrss) 
                VALUES 
                    (:id_alumno, :r1_nombre, :r1_tel, :r2_nombre, :r2_tel, 
                     :vive_con, :n_integrantes, :n_hijos, :rsh_puntaje, 
                     :restriccion, :restriccion_motivo,
                     :diag, :diag_doc, :trat,
                     :enfermedad, :alergia,
                     :acepta_r, :acepta_pie, :acepta_msg, :acepta_fotos)";
        
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':id_alumno' => $idAlumno,
            ':r1_nombre' => $data['retira_1_nombre'],
            ':r1_tel' => $data['retira_1_telefono'],
            ':r2_nombre' => $data['retira_2_nombre'] ?? null,
            ':r2_tel' => $data['retira_2_telefono'] ?? null,
            ':vive_con' => $data['vive_con_string'], // El string "Mama, Papa"
            ':n_integrantes' => $data['n_integrantes_familia'],
            ':n_hijos' => $data['n_hijos'],
            ':rsh_puntaje' => $data['rsh_puntaje'] ?? null,
            ':restriccion' => $data['restriccion_judicial'], // 0 o 1
            ':restriccion_motivo' => $data['restriccion_motivo'] ?? null,
            ':diag' => $data['diagnostico'], // 0 o 1
            ':diag_doc' => $data['diagnostico_documento'], // 0 o 1
            ':trat' => $data['tratamiento'], // 0 o 1
            ':enfermedad' => $data['enfermedad'] ?? null,
            ':alergia' => $data['alergia_medicamento'],
            ':acepta_r' => $data['acepta_reglamento'], // 1
            ':acepta_pie' => $data['acepta_no_pie'], // 1
            ':acepta_msg' => $data['acepta_mensajeria'], // 1
            ':acepta_fotos' => $data['acepta_fotos_rrss'] // 1
        ]);
    }

    /**
     * Actualiza el registro de antecedentes para un alumno.
     */
    public function update(int $idAlumno, array $data): bool {
        // (Buscamos por id_alumno, ya que es UNIQUE)
        $sql = "UPDATE antecedentes_alumno SET 
                    retira_emergencia_1_nombre = :r1_nombre, 
                    retira_emergencia_1_telefono = :r1_tel, 
                    retira_emergencia_2_nombre = :r2_nombre, 
                    retira_emergencia_2_telefono = :r2_tel, 
                    alumno_vive_con = :vive_con, 
                    n_integrantes_familia = :n_integrantes, 
                    n_hijos = :n_hijos, 
                    rsh_puntaje = :rsh_puntaje, 
                    restriccion_judicial = :restriccion, 
                    restriccion_motivo = :restriccion_motivo, 
                    diagnostico = :diag, 
                    diagnostico_documento = :diag_doc, 
                    tratamiento = :trat, 
                    enfermedad = :enfermedad, 
                    alergia_medicamento = :alergia, 
                    acepta_reglamento = :acepta_r, 
                    acepta_no_pie = :acepta_pie, 
                    acepta_mensajeria = :acepta_msg, 
                    acepta_fotos_rrss = :acepta_fotos
                WHERE id_alumno = :id_alumno";
        
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':id_alumno' => $idAlumno,
            ':r1_nombre' => $data['retira_1_nombre'],
            ':r1_tel' => $data['retira_1_telefono'],
            ':r2_nombre' => $data['retira_2_nombre'] ?? null,
            ':r2_tel' => $data['retira_2_telefono'] ?? null,
            ':vive_con' => $data['vive_con_string'], // "Mama, Papa"
            ':n_integrantes' => $data['n_integrantes_familia'],
            ':n_hijos' => $data['n_hijos'],
            ':rsh_puntaje' => $data['rsh_puntaje'] ?? null,
            ':restriccion' => $data['restriccion_judicial'],
            ':restriccion_motivo' => $data['restriccion_motivo'] ?? null,
            ':diag' => $data['diagnostico'],
            ':diag_doc' => $data['diagnostico_documento'],
            ':trat' => $data['tratamiento'],
            ':enfermedad' => $data['enfermedad'] ?? null,
            ':alergia' => $data['alergia_medicamento'],
            ':acepta_r' => $data['acepta_reglamento'],
            ':acepta_pie' => $data['acepta_no_pie'],
            ':acepta_msg' => $data['acepta_mensajeria'],
            ':acepta_fotos' => $data['acepta_fotos_rrss']
        ]);
    }
}