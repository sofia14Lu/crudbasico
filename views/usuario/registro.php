<h2>Registro de Usuario</h2>

<form action="<?php echo URL_BASE; ?>index.php?action=registrar" method="POST">
    <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" placeholder="Nombre" required>
    </div>
    
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" placeholder="Correo electrónico" required>
    </div>
    
    <div class="form-group">
        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" placeholder="Contraseña" required>
    </div>
    
    <button type="submit">Registrar</button>
    <?php if (isset($_GET['error'])): ?>
    <p style="color: red;"><?php echo htmlspecialchars($_GET['error']); ?></p>
<?php endif; ?>
</form>

<p>¿Ya tienes cuenta? <a href="<?php echo URL_BASE; ?>index.php?action=login">Inicia sesión</a></p>

