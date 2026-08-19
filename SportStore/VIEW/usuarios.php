<?php

require_once __DIR__ . "/../CONTROLLER/UsuarioController.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["id_usuario"]) || $_SESSION["rol"] !== "Administrador") {
    header("Location: inicio.php");
    exit;
}

$controller = new UsuarioController();

$usuarios = $controller->listar();

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>

<header>
    <h1>SPORTSTORE</h1>
    <p>Gestión de usuarios</p>
</header>

<nav>
    <a href="inicio.php">Inicio</a>
    <a href="productos.php">Productos</a>
    <a href="usuarios.php">Usuarios</a>
    <a href="?logout=1">Cerrar sesión</a>
</nav>

<section>

    <h2 class="titulo">Usuarios registrados</h2>

    <table border="1" cellpadding="8" style="width:100%; border-collapse: collapse;">

        <tr>
            <th>ID</th>
            <th>Identificación</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Correo</th>
            <th>Teléfono</th>
            <th>Rol</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>

        <?php foreach ($usuarios as $u): ?>

            <tr>
                <td><?= htmlspecialchars($u["id_usuario"]) ?></td>
                <td><?= htmlspecialchars($u["numero_identificacion"]) ?></td>
                <td><?= htmlspecialchars($u["nombre"]) ?></td>
                <td><?= htmlspecialchars($u["apellido"]) ?></td>
                <td><?= htmlspecialchars($u["correo"]) ?></td>
                <td><?= htmlspecialchars($u["telefono"]) ?></td>
                <td><?= htmlspecialchars($u["rol"]) ?></td>
                <td><?= htmlspecialchars($u["estado"]) ?></td>
                <td>
                    <a href="editar_usuario.php?id=<?= $u['id_usuario'] ?>">Editar</a>
                    |

                    <?php if ($u["estado"] === "Activo"): ?>

                        <a href="cambiar_estado_usuario.php?id=<?= $u['id_usuario'] ?>&estado=Inactivo"
                           onclick="return confirm('¿Inactivar este usuario?');">
                            Inactivar
                        </a>

                    <?php else: ?>

                        <a href="cambiar_estado_usuario.php?id=<?= $u['id_usuario'] ?>&estado=Activo"
                           onclick="return confirm('¿Activar este usuario?');">
                            Activar
                        </a>

                    <?php endif; ?>

                </td>
            </tr>

        <?php endforeach; ?>

    </table>

</section>

</body>
</html>