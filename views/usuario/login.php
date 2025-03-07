<h2>Login de Usuario</h2>

<form action="<?php echo URL_BASE; ?>index.php?action=loginProcesar" method="POST">
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" placeholder="Correo electrónico" required>
    </div>
    
    <div class="form-group">
        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" placeholder="Contraseña" required>
    </div>
    
    <button type="submit">Iniciar Sesión</button>
</form>

<p>¿No tienes cuenta? <a href="<?php echo URL_BASE; ?>index.php?action=registro">Regístrate</a></p>