<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios</title>
    <link rel="stylesheet" href="<?php echo URL_BASE; ?>public/css/style.css">
</head>
<body>
    <header>
        <h1>Sistema de Gestión de Usuarios</h1>
        <?php if(isset($_SESSION['id_usuario'])): ?>
            <nav>
                <ul>
                    <li><a href="<?php echo URL_BASE; ?>index.php?action=listar">Listar Usuarios</a></li>
                    <li><a href="<?php echo URL_BASE; ?>index.php?action=logout">Cerrar Sesión</a></li>
                </ul>
            </nav>
        <?php endif; ?>
    </header>
    <main>
        <?php if(isset($mensaje)): ?>
            <div class="mensaje-exito"><?php echo $mensaje; ?></div>
        <?php endif; ?>
        
        <?php if(isset($error)): ?>
            <div class="mensaje-error"><?php echo $error; ?></div>
        <?php endif; ?>