<?php
class Conexion
{
    private string $host = "localhost";
    private string $db = "codo_chat";
    private string $user = "root";
    private string $pass = "";
    private PDO $pdo;

    public function __construct()
    {
        $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db;
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        try {
            $this->pdo = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            print_r('Error de conexión: ' . $e->getMessage());
        }
    }

    public function getPDO(): PDO
    {
        return $this->pdo;
    }
}
