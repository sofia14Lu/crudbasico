# CRUD Básico en PHP con MVC

Un sistema simple de gestión de usuarios con operaciones CRUD implementando el patrón MVC.

![PHP](https://img.shields.io/badge/PHP-7.0+-777BB4?style=flat-square&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-5.6+-4479A1?style=flat-square&logo=mysql&logoColor=white)
![Apache](https://img.shields.io/badge/Apache-2.4+-D22128?style=flat-square&logo=apache&logoColor=white)

## 📋 Índice

- [Características](#características)
- [Estructura del Proyecto](#estructura-del-proyecto)
- [Requisitos](#requisitos)
- [Instalación](#instalación)
- [Uso](#uso)
- [Seguridad](#seguridad)
- [Contribuciones](#contribuciones)
- [Licencia](#licencia)

## ✨ Características

- **Patrón MVC**: Estructura clara que separa datos, lógica y presentación
- **Gestión de Usuarios**: Registro, login, listado, edición y eliminación
- **Base de Datos**: Conexión segura mediante PDO y consultas preparadas
- **Seguridad**: Almacenamiento de contraseñas con hash y protección contra inyección SQL
- **Interfaz**: Diseño simple y responsivo con CSS

## 🗂️ Estructura del Proyecto

```
proyecto/
├── config/               # Configuraciones
│   ├── config.php        # Configuraciones generales
│   └── database.php      # Conexión a la base de datos
├── models/               # Modelos
│   └── Usuario.php       # Modelo de usuario
├── controllers/          # Controladores
│   └── UsuarioController.php
├── views/                # Vistas
│   ├── templates/        # Plantillas comunes
│   │   ├── header.php
│   │   └── footer.php
│   └── usuario/          # Vistas específicas
│       ├── registro.php
│       ├── login.php
│       ├── lista.php
│       └── editar.php
├── public/               # Archivos públicos
│   ├── index.php         # Punto de entrada único
│   ├── css/              # Estilos
│   │   └── style.css
│   └── js/               # JavaScript (opcional)
├── .htaccess             # Configuración Apache
└── database.sql          # Script de la base de datos
```

## 📋 Requisitos

- PHP 7.0 o superior
- MySQL 5.6 o superior
- Servidor web Apache con mod_rewrite habilitado

## 🚀 Instalación

1. **Clonar el repositorio**
   ```bash
   git clone https://github.com/cibersabueso/crudbasico.git
   cd crudbasico
   ```

2. **Configurar la base de datos**
   ```bash
   # Importar el esquema de la base de datos
   mysql -u root -p < database.sql
   ```

3. **Configuración**
   - Editar `config/database.php` con tus credenciales de MySQL
   - Asegurarse que el servidor web tenga permisos de escritura en el directorio

4. **Acceder a la aplicación**
   - Navegar a `http://localhost/crudbasico/` (ajustar según configuración del servidor)

## 💻 Uso

1. **Registro de usuario**
   - Accede a la página principal y selecciona "Registrarse"
   - Completa el formulario con nombre, email y contraseña

2. **Iniciar sesión**
   - Ingresa tus credenciales en el formulario de login

3. **Gestión de usuarios**
   - Después de iniciar sesión, podrás ver la lista de usuarios
   - Utiliza los botones de acción para editar o eliminar usuarios

## 🔒 Seguridad

Este proyecto implementa medidas básicas de seguridad:

- **Contraseñas**: Protegidas con hash mediante `password_hash()`
- **Protección contra SQL Injection**: Uso de PDO y consultas preparadas
- **Sanitización**: Limpieza básica de datos de entrada



