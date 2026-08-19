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

$errores = [];

$id = intval($_GET["id"] ?? 0);

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $resultado = $controller->actualizar($_POST);

    if ($resultado["success"]) {
        header("Location: usuarios.php");
        exit;
    }

    $errores = $resultado["errores"] ?? [];
    $usuario = $_POST;
    $usuario["id_usuario"] = $id;

} else {

    $usuario = $controller->obtener($id);

    if (!$usuario) {
        header("Location: usuarios.php");
        exit;
    }

}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>

<header>
    <h1>SPORTSTORE</h1>
    <p>Editar usuario</p>
</header>

<nav>
    <a href="inicio.php">Inicio</a>
    <a href="usuarios.php">Usuarios</a>
</nav>

<section>

    <h2 class="titulo">Editar usuario</h2>

    <?php if (!empty($errores)): ?>

        <div>
            <?php foreach ($errores as $error): ?>
                <p><?= htmlspecialchars($error) ?></p>
            <?php endforeach; ?>
        </div>

    <?php endif; ?>

    <form method="POST" action="editar_usuario.php?id=<?= $id ?>">

        <input type="hidden" name="id_usuario" value="<?= $id ?>">

        <input
            type="text"
            name="numero_identificacion"
            placeholder="Número de identificación"
            value="<?= htmlspecialchars($usuario['numero_identificacion']) ?>"
            pattern="[0-9]+"
            title="Solo se permiten números"
            required
        >

        <input
            type="text"
            name="nombre"
            placeholder="Nombre"
            value="<?= htmlspecialchars($usuario['nombre']) ?>"
            pattern="[a-zA-ZÀ-ÿ\s]+"
            title="Solo se permiten letras"
            required
        >

        <input
            type="text"
            name="apellido"
            placeholder="Apellido"
            value="<?= htmlspecialchars($usuario['apellido']) ?>"
            pattern="[a-zA-ZÀ-ÿ\s]+"
            title="Solo se permiten letras"
            required
        >

        <input
            type="email"
            name="correo"
            placeholder="Correo"
            value="<?= htmlspecialchars($usuario['correo']) ?>"
            required
        >

        <input
            type="text"
            name="telefono"
            placeholder="Teléfono"
            value="<?= htmlspecialchars($usuario['telefono']) ?>"
            pattern="[0-9]+"
            title="Solo se permiten números"
            required
        >

        <input
            type="text"
            name="direccion"
            placeholder="Dirección"
            value="<?= htmlspecialchars($usuario['direccion']) ?>"
            required
        >

        <select name="rol" required>
            <option value="Administrador" <?= $usuario['rol'] === 'Administrador' ? 'selected' : '' ?>>Administrador</option>
            <option value="Cliente" <?= $usuario['rol'] === 'Cliente' ? 'selected' : '' ?>>Cliente</option>
        </select>

        <button type="submit">
            Guardar cambios
        </button>

    </form>

</section>

</body>
</html>