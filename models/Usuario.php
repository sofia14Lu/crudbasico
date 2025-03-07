<?php
class Usuario {
    // Conexión a la base de datos y nombre de la tabla
    private $conn;
    private $table_name = "usuarios";
    
    // Propiedades del objeto
    public $id;
    public $nombre;
    public $email;
    public $password;
    
    // Constructor con la conexión a la base de datos
    public function __construct($db) {
        $this->conn = $db;
    }
    
    // Crear un nuevo usuario
    public function crear() {
        // Consulta SQL segura
        $query = "INSERT INTO " . $this->table_name . " (nombre, email, password) VALUES (:nombre, :email, :password)";
        
        // Preparar la consulta
        $stmt = $this->conn->prepare($query);
        
        // Limpiar y sanitizar datos
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->email = htmlspecialchars(strip_tags($this->email));
        // Hash de la contraseña para seguridad
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        
        // Vincular los parámetros
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        
        // Ejecutar la consulta
        if($stmt->execute()) {
            return true;
        }
        return false;
    }
    
    // Obtener todos los usuarios
    public function leer() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    
    // Obtener un usuario por ID
    public function leerUno() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($row) {
            $this->nombre = $row['nombre'];
            $this->email = $row['email'];
            return true;
        }
        return false;
    }
    
    // Actualizar un usuario
    public function actualizar() {
        $query = "UPDATE " . $this->table_name . " SET nombre = :nombre, email = :email WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);
        
        
        // Limpiar y sanitizar datos

$this->nombre = htmlspecialchars(strip_tags($this->nombre));
$this->email = htmlspecialchars(strip_tags($this->email));
$this->id = htmlspecialchars(strip_tags($this->id));

        
        // Vincular los parámetros
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':id', $this->id);
        
        // Ejecutar la consulta
        if($stmt->execute()) {
            return true;
        }
        return false;
    }
    
    // Eliminar un usuario
    public function eliminar() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);
        
        $this->id = htmlspecialchars(strip_tags($this->id));
        
        $stmt->bindParam(':id', $this->id);
        
        if($stmt->execute()) {
            return true;
        }
        return false;
    }
    
    // Verificar login
    public function login() {
        $query = "SELECT id, nombre, password FROM " . $this->table_name . " WHERE email = :email";
        
        $stmt = $this->conn->prepare($query);
        
        $this->email = htmlspecialchars(strip_tags($this->email));
        
        $stmt->bindParam(':email', $this->email);
        
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($row && password_verify($this->password, $row['password'])) {
            $this->id = $row['id'];
            $this->nombre = $row['nombre'];
            return true;
        }
        return false;
    }
}
