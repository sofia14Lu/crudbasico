<?php
// Incluir el modelo
require_once(BASE_PATH . '/models/Usuario.php');

class UsuarioController {
    private $db;
    private $usuario;
    
    public function __construct() {
        // Crear conexión a la base de datos
        $database = new Database();
        $this->db = $database->getConnection();
        
        // Instanciar el modelo Usuario
        $this->usuario = new Usuario($this->db);
    }
    
    // Mostrar formulario de registro
    public function mostrarFormularioRegistro() {
        include_once(BASE_PATH . '/views/templates/header.php');
        include_once(BASE_PATH . '/views/usuario/registro.php');
        include_once(BASE_PATH . '/views/templates/footer.php');
    }
    
    // Mostrar formulario de login
    public function mostrarFormularioLogin() {
        include_once(BASE_PATH . '/views/templates/header.php');
        include_once(BASE_PATH . '/views/usuario/login.php');
        include_once(BASE_PATH . '/views/templates/footer.php');
    }
    
    // Registrar un nuevo usuario
    public function registrar() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Asignar valores a las propiedades del usuario
            $this->usuario->nombre = $_POST['nombre'];
            $this->usuario->email = $_POST['email'];
            $this->usuario->password = $_POST['password'];
            
            // Crear el usuario
            $resultado = $this->usuario->crear();
            
            // Verificar si es una petición API
            if(isset($_GET['format']) && $_GET['format'] == 'json') {
                header('Content-Type: application/json');
                if($resultado) {
                    echo json_encode(['success' => true, 'message' => 'Usuario creado correctamente']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'No se pudo crear el usuario']);
                }
                exit;
            } else {
                // Comportamiento normal
                if($resultado) {
                    // Configurar mensaje de éxito
                    $mensaje = "Usuario creado correctamente";
                    include_once(BASE_PATH . '/views/templates/header.php');
                    include_once(BASE_PATH . '/views/usuario/login.php');
                    include_once(BASE_PATH . '/views/templates/footer.php');
                } else {
                    // Configurar mensaje de error
                    $error = "No se pudo crear el usuario";
                    include_once(BASE_PATH . '/views/templates/header.php');
                    include_once(BASE_PATH . '/views/usuario/registro.php');
                    include_once(BASE_PATH . '/views/templates/footer.php');
                }
            }
        }
    }
    
    // Login de usuario
    public function login() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Asignar valores a las propiedades del usuario
            $this->usuario->email = $_POST['email'];
            $this->usuario->password = $_POST['password'];
            
            // Verificar login
            $resultado = $this->usuario->login();
            
            // Verificar si es una petición API
            if(isset($_GET['format']) && $_GET['format'] == 'json') {
                header('Content-Type: application/json');
                if($resultado) {
                    echo json_encode([
                        'success' => true, 
                        'message' => 'Login exitoso',
                        'user' => [
                            'id' => $this->usuario->id,
                            'nombre' => $this->usuario->nombre
                        ]
                    ]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Email o contraseña incorrectos']);
                }
                exit;
            } else {
                // Comportamiento normal
                if($resultado) {
                    // Iniciar sesión
                    session_start();
                    $_SESSION['id_usuario'] = $this->usuario->id;
                    $_SESSION['nombre_usuario'] = $this->usuario->nombre;
                    
                    // Redirigir a la lista de usuarios
                    header('Location: ' . URL_BASE . 'index.php?action=listar');
                } else {
                    // Configurar mensaje de error
                    $error = "Email o contraseña incorrectos";
                    include_once(BASE_PATH . '/views/templates/header.php');
                    include_once(BASE_PATH . '/views/usuario/login.php');
                    include_once(BASE_PATH . '/views/templates/footer.php');
                }
            }
        }
    }
    
    // Listar usuarios
    public function listar() {
        // Obtener todos los usuarios
        $result = $this->usuario->leer();
        
        // Verificar si hay usuarios
        if($result->rowCount() > 0) {
            $usuarios = $result->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $usuarios = array();
        }
        
        // Verificar si es una petición API
        if(isset($_GET['format']) && $_GET['format'] == 'json') {
            header('Content-Type: application/json');
            echo json_encode($usuarios);
            exit;
        } else {
            // Comportamiento normal
            include_once(BASE_PATH . '/views/templates/header.php');
            include_once(BASE_PATH . '/views/usuario/lista.php');
            include_once(BASE_PATH . '/views/templates/footer.php');
        }
    }
    
    // Mostrar formulario de edición
    public function mostrarFormularioEditar() {
        if(isset($_GET['id'])) {
            $this->usuario->id = $_GET['id'];
            
            // Obtener los datos del usuario
            $resultado = $this->usuario->leerUno();
            
            // Verificar si es una petición API
            if(isset($_GET['format']) && $_GET['format'] == 'json') {
                header('Content-Type: application/json');
                if($resultado) {
                    echo json_encode([
                        'id' => $this->usuario->id,
                        'nombre' => $this->usuario->nombre,
                        'email' => $this->usuario->email
                    ]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Usuario no encontrado']);
                }
                exit;
            } else {
                // Comportamiento normal
                if($resultado) {
                    include_once(BASE_PATH . '/views/templates/header.php');
                    include_once(BASE_PATH . '/views/usuario/editar.php');
                    include_once(BASE_PATH . '/views/templates/footer.php');
                } else {
                    header('Location: ' . URL_BASE . 'index.php?action=listar');
                }
            }
        } else {
            if(isset($_GET['format']) && $_GET['format'] == 'json') {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => 'ID no especificado']);
                exit;
            } else {
                header('Location: ' . URL_BASE . 'index.php?action=listar');
            }
        }
    }
    
    // Actualizar usuario
    public function actualizar() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Asignar valores a las propiedades del usuario
            $this->usuario->id = $_POST['id'];
            $this->usuario->nombre = $_POST['nombre'];
            $this->usuario->email = $_POST['email'];
            
            // Actualizar el usuario
            $resultado = $this->usuario->actualizar();
            
            // Verificar si es una petición API
            if(isset($_GET['format']) && $_GET['format'] == 'json') {
                header('Content-Type: application/json');
                if($resultado) {
                    echo json_encode(['success' => true, 'message' => 'Usuario actualizado correctamente']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'No se pudo actualizar el usuario']);
                }
                exit;
            } else {
                // Comportamiento normal
                if($resultado) {
                    header('Location: ' . URL_BASE . 'index.php?action=listar');
                } else {
                    // Volver al formulario de edición con mensaje de error
                    $error = "No se pudo actualizar el usuario";
                    include_once(BASE_PATH . '/views/templates/header.php');
                    include_once(BASE_PATH . '/views/usuario/editar.php');
                    include_once(BASE_PATH . '/views/templates/footer.php');
                }
            }
        }
    }
    
    // Eliminar usuario
    public function eliminar() {
if (isset($_GET['id'])) {
            $this->usuario->id = $_GET['id'];
            
            // Eliminar el usuario
            $resultado = $this->usuario->eliminar();
            
            // Verificar si es una petición API
            if(isset($_GET['format']) && $_GET['format'] == 'json') {
                header('Content-Type: application/json');
                if($resultado) {
                    echo json_encode(['success' => true, 'message' => 'Usuario eliminado correctamente']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'No se pudo eliminar el usuario']);
                }
                exit;
            } else {
                // Comportamiento normal
                if($resultado) {
                    header('Location: ' . URL_BASE . 'index.php?action=listar');
                } else {
                    // Configurar mensaje de error
                    $error = "No se pudo eliminar el usuario";
                    include_once(BASE_PATH . '/views/templates/header.php');
                    include_once(BASE_PATH . '/views/usuario/lista.php');
                    include_once(BASE_PATH . '/views/templates/footer.php');
                }
            }
        } else {
            header('Location: ' . URL_BASE . 'index.php?action=listar');
        }
    }
    
    // Cerrar sesión
    public function logout() {
        session_start();
        session_destroy();
        
        // Verificar si es una petición API
        if(isset($_GET['format']) && $_GET['format'] == 'json') {
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'Sesión cerrada correctamente']);
            exit;
        } else {
            // Comportamiento normal
            header('Location: ' . URL_BASE . 'index.php?action=login');
        }
    }
}
 // Validar campos obligatorios
 if (empty($nombre)) {
    http_response_code(400); // Código 400: Bad Request
    echo json_encode(["error" => "El campo 'nombre' es obligatorio."]);
    exit; // Detener ejecución
}

if (empty($email)) {
    http_response_code(400);
    echo json_encode(["error" => "El campo 'email' es obligatorio."]);
    exit;
}

// Aquí puedes seguir con la lógica de guardar o actualizar.
echo json_encode(["mensaje" => "Usuario actualizado correctamente."]);
exit;
// Validar campos obligatorios
if (empty($nombre)) {
    http_response_code(400); // Código 400: Bad Request
    echo json_encode(["error" => "El campo 'nombre' es obligatorio."]);
}

?>