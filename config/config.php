<?php
// Definir constantes globales
define('BASE_PATH', dirname(dirname(__FILE__)));

// Detectar automáticamente el entorno (Windows XAMPP o Mac MAMP)
$server_port = $_SERVER['SERVER_PORT'];
$server_name = $_SERVER['SERVER_NAME'];

// Configurar URL_BASE según el entorno
if ($server_port == '80') {
    // Entorno XAMPP Windows (puerto estándar)
    define('URL_BASE', 'http://' . $server_name . '/crudbasico/');
} else {
    // Entorno MAMP Mac u otro puerto personalizado
    define('URL_BASE', 'http://' . $server_name . ':' . $server_port . '/crudbasico/');
}

// Configuración de errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Incluir automáticamente la configuración de la base de datos
require_once(BASE_PATH . '/config/database.php');
