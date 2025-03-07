<h2>Lista de Usuarios</h2>

<?php if(count($usuarios) > 0): ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($usuarios as $usuario): ?>
                <tr>
                    <td><?php echo $usuario['id']; ?></td>
                    <td><?php echo $usuario['nombre']; ?></td>
                    <td><?php echo $usuario['email']; ?></td>
                    <td>
                        <a href="<?php echo URL_BASE; ?>index.php?action=editar&id=<?php echo $usuario['id']; ?>">Editar</a>
                        <a href="<?php echo URL_BASE; ?>index.php?action=eliminar&id=<?php echo $usuario['id']; ?>" onclick="return confirm('¿Está seguro de eliminar este usuario?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No hay usuarios registrados</p>
<?php endif; ?>