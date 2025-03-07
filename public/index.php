<?php
// Incluir archivo de configuración
require_once('../config/config.php');

// Incluir controlador de usuario
require_once(BASE_PATH . '/controllers/UsuarioController.php');

// Crear instancia del controlador
$usuarioController = new UsuarioController();

// Comprobar si existe una acción
if(isset($_GET['action'])) {
    $action = $_GET['action'];
    
    // Manejar diferentes acciones
    switch($action) {
        case 'registro':
            $usuarioController->mostrarFormularioRegistro();
            break;
        case 'registrar':
            $usuarioController->registrar();
            break;
        case 'login':
            $usuarioController->mostrarFormularioLogin();
            break;
        case 'loginProcesar':
            $usuarioController->login();
            break;
        case 'listar':
            $usuarioController->listar();
            break;
        case 'editar':
            $usuarioController->mostrarFormularioEditar();
            break;
        case 'actualizar':
            $usuarioController->actualizar();
            break;
        case 'eliminar':
            $usuarioController->eliminar();
            break;
        case 'logout':
            $usuarioController->logout();
            break;
        default:
            // Acción no reconocida, redirigir a login
            $usuarioController->mostrarFormularioLogin();
            break;
    }
} else {
    // Si no se especifica acción, mostrar página de login
    $usuarioController->mostrarFormularioLogin();
}