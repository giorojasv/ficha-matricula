<?php
class User {
    private $db;

    public function __construct() {
        if (!class_exists('Database')) {
            require_once 'Database.php';
        }
        $this->db = Database::getInstance()->getConnection();
    }

    /**
     * Busca un usuario por su email.
     */
    public function findByEmail(string $email): mixed {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch();
    }
}