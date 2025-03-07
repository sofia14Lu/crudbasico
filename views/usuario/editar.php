<h2>Editar Usuario</h2>

<?php if (isset($usuario)): ?>
<form action="<?php echo URL_BASE; ?>index.php?action=actualizar" method="POST">
    <input type="hidden" name="id" value="<?php echo $usuario->id; ?>">
    
    <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" value="<?php echo $usuario->nombre; ?>" required>
    </div>
    
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo $usuario->email; ?>" required>
    </div>
    
    <button type="submit">Actualizar</button>
</form>
<?php
http_response_code(500); // Error 500: Internal Server Error
echo "Error: Fallo interno del servidor.";
exit;
?>
<?php else: ?>
<p>Usuario no encontrado.</p>
<?php endif; ?>


<p><a href="<?php echo URL_BASE; ?>index.php?action=listar">Volver a la lista</a></p>
