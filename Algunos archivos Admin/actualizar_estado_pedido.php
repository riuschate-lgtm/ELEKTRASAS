<?php
require_once __DIR__ . '/../includes/auth_admin.php';
require_once __DIR__ . '/../includes/conexion.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Acceso inválido.");
}

if (
    !isset($_POST['id_pedido'], $_POST['estado']) ||
    !is_numeric($_POST['id_pedido'])
) {
    die("Datos incompletos.");
}

$idPedido = (int) $_POST['id_pedido'];
$estado = $_POST['estado'];

$estadosPermitidos = ['pendiente', 'pagado', 'enviado', 'cancelado'];

if (!in_array($estado, $estadosPermitidos)) {
    die("Estado no permitido.");
}

$stmt = $conexion->prepare("
    UPDATE elpedido
    SET Estado = ?
    WHERE ID_Pedido = ?
");
$stmt->bind_param("si", $estado, $idPedido);
$stmt->execute();

header("Location: pedido_detalle.php?id=" . $idPedido);
exit;
