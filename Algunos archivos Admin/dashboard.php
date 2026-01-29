<?php
require_once __DIR__ . '/../includes/auth_admin.php';
require_once __DIR__ . '/../includes/head.php';
?>

<body style="background-color:#e9f7dc;">

<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">

            <!-- TARJETA PRINCIPAL -->
            <div class="card shadow-lg border-0">

                <div class="card-header text-center text-white"
                     style="background-color:#2f6f4f;">
                    <h4 class="mb-0">Panel de Administración</h4>
                </div>

                <div class="card-body">

                    <p class="text-center mb-4">
                        👤 <strong>Administrador:</strong>
                        <?= htmlspecialchars($_SESSION['admin_nombre'] ?? 'Pablo') ?>
                    </p>

                    <div class="list-group list-group-flush">

                        <a href="categorias.php"
                           class="list-group-item list-group-item-action">
                            📂 Gestionar Categorías
                        </a>

                        <a href="subcategorias.php"
                           class="list-group-item list-group-item-action">
                            📁 Gestionar Subcategorías
                        </a>

                        <a href="productos.php"
                           class="list-group-item list-group-item-action">
                            📦 Gestionar Productos
                        </a>

                        <a href="clientes.php"
                           class="list-group-item list-group-item-action">
                            👥 Gestionar Clientes
                        </a>
<li class="list-group-item">
    <a href="pagos.php">
        💳 Gestionar Pagos
    </a>
</li>

                    </div>

                </div>

                <div class="card-footer text-center bg-light">
                    <a href="logout.php"
                       class="btn btn-danger btn-sm">
                        🚪 Cerrar sesión
                    </a>
                </div>

            </div>
            <!-- /TARJETA -->

        </div>
    </div>

</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
