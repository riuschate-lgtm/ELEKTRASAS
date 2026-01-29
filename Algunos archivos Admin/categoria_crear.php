<?php
session_start();

require_once __DIR__ . '/../includes/auth_admin.php';
require_once __DIR__ . '/../includes/conexion.php';

function generarSlug($texto) {
    $texto = strtolower($texto);
    $texto = iconv('UTF-8', 'ASCII//TRANSLIT', $texto);
    $texto = preg_replace('/[^a-z0-9]+/', '-', $texto);
    return trim($texto, '-');
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nombre = trim($_POST['nombre'] ?? '');
    $descripcion = trim($_POST['descripcion'] ?? '');
    $orden = (int)($_POST['orden'] ?? 0);
    $destacada = isset($_POST['destacada']) ? 1 : 0;

    if ($nombre === '') {
        $error = 'El nombre es obligatorio';
    } else {

        $slug = generarSlug($nombre);

        $stmt = $conexion->prepare(
            "INSERT INTO elcategoria
            (Nombre_Categoria, Descripcion, Slug, Orden, Destacada, Estado)
            VALUES (?, ?, ?, ?, ?, 1)"
        );

        $stmt->bind_param(
            "sssii",
            $nombre,
            $descripcion,
            $slug,
            $orden,
            $destacada
        );

        $stmt->execute();
        header("Location: categorias.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nueva Categoría</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h2>Nueva Categoría</h2>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="post">

        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Descripción</label>
            <textarea name="descripcion" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Orden</label>
            <input type="number" name="orden" class="form-control" value="0">
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="destacada" id="destacada">
            <label class="form-check-label" for="destacada">
                Categoría destacada
            </label>
        </div>

        <button class="btn btn-success">Guardar</button>
        <a href="categorias.php" class="btn btn-secondary">Cancelar</a>

    </form>
</div>

</body>
</html>
