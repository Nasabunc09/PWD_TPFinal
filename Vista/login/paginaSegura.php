<?php
require_once "../../configuracion.php";

$session = new Session();
if (!$session->activa()) {
    header("Location: login.php");
    exit;
}

$usuario = $session->getUsuario();
$idUsuario = $usuario->getIdUsuario();

$abmMenu = new AbmMenu();
$menus = $abmMenu->obtenerMenuPorUsuario($idUsuario);

include_once "../estructura/cabecera.php";
?>

<div class="container mt-5">

    <h2>Bienvenido, <?= $usuario->getUsNombre(); ?> 👋</h2>
    <p class="text-muted">Panel de usuario</p>

    <div class="row mt-4">
        <?php if (count($menus) == 0): ?>
            <p>No tenés accesos asignados.</p>
        <?php endif; ?>

        <?php foreach ($menus as $menu): ?>
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"><?= $menu->getMeNombre(); ?></h5>
                        <p class="card-text"><?= $menu->getMeDescripcion(); ?></p>

                        <!-- Esto no redirige a una URL porque tu menú NO tiene link -->
                        <button class="btn btn-primary w-100" disabled>
                            Función no implementada
                        </button>

                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <a href="accion/cerrarSesion.php" class="btn btn-danger mt-3">Cerrar sesión</a>

</div>

<?php include_once "../estructura/pie.php"; ?>
