<?php
session_start();
require_once __DIR__ . '/../includes/auth_admin.php';
require_once __DIR__ . '/../includes/conexion.php';
require_once __DIR__ . '/../includes/head.php';
require_once __DIR__ . '/../includes/header.php';

$sql = "
    SELECT ID_Cliente, Primer_Nombre, Apellido_Paterno, email, Estado
    FROM elusuar_cliente
    ORDER BY created_at DESC
";
$result = $conexion->query($sql);
?>

<div class="container my-4">
    <h2>Gestión de Clientes</h2>

    <a href="cliente_crear.php" class="btn btn-success mb-3">
        ➕ Nuevo cliente
    </a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Estado</th>
                <th style="width:160px;">Acciones</th>
            </tr>
        </thead>
        <tbody>

        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($c = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= (int)$c['ID_Cliente'] ?></td>
                    <td><?= htmlspecialchars($c['Primer_Nombre'].' '.$c['Apellido_Paterno']) ?></td>
                    <td><?= htmlspecialchars($c['email']) ?></td>
                    <td><?= htmlspecialchars($c['Estado']) ?></td>
                    <td>
                        <a href="cliente_editar.php?id=<?= (int)$c['ID_Cliente'] ?>">✏️ Editar</a> |
                        <a href="cliente_eliminar.php?id=<?= (int)$c['ID_Cliente'] ?>"
                           onclick="return confirm('¿Desactivar este cliente?')">
                           🗑 Eliminar
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="5">No hay clientes registrados</td>
            </tr>
        <?php endif; ?>

        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
