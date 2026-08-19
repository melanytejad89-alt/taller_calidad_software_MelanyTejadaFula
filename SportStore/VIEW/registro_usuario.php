<?php

require_once __DIR__ . "/../CONTROLLER/UsuarioController.php";

$controller = new UsuarioController();

$errores = [];


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $resultado = $controller->registrar($_POST);

    if ($resultado["success"]) {

        header("Location: inicio.php");
        exit;

    }

    $errores = $resultado["errores"] ?? [];

}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Cliente</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>

<header>
    <h1>SPORTSTORE</h1>
    <p>La mejor ropa deportiva para ti</p>
</header>

<nav>
    <a href="inicio.php">Inicio</a>
    <a href="productos.php">Ver Productos</a>
</nav>

<section class="banner">
    <div class="banner-text">
        <h2>Entrena con Estilo</h2>
        <p>Encuentra la mejor ropa deportiva para acompañarte en cada entrenamiento.</p>
    </div>
</section>

<footer>
    <p>© 2026 SportStore - Todos los derechos reservados.</p>
</footer>


<div class="modal-overlay activo">

    <div class="modal-caja">

        <a href="inicio.php" class="modal-cerrar">&times;</a>

        <h2>Registro de Cliente</h2>

        <?php if (!empty($errores)): ?>

            <div class="modal-errores">
                <?php foreach ($errores as $error): ?>
                    <p><?= htmlspecialchars($error) ?></p>
                <?php endforeach; ?>
            </div>

        <?php endif; ?>

        <form method="POST" action="registro_usuario.php">

            <input
                type="text"
                name="numero_identificacion"
                placeholder="Ingresa tu número de identificación"
                pattern="[0-9]+"
                title="Solo se permiten números"
                required
            >

            <input
                type="text"
                name="nombre"
                placeholder="Ingresa tu nombre"
                pattern="[a-zA-ZÀ-ÿ\s]+"
                title="Solo se permiten letras"
                required
            >

            <input
                type="text"
                name="apellido"
                placeholder="Ingresa tu apellido"
                pattern="[a-zA-ZÀ-ÿ\s]+"
                title="Solo se permiten letras"
                required
            >

            <input
                type="email"
                name="correo"
                placeholder="Ingresa tu correo"
                required
            >

            <input
                type="text"
                name="telefono"
                placeholder="Ingresa tu número"
                pattern="[0-9]+"
                title="Solo se permiten números"
                required
            >

            <input
                type="text"
                name="direccion"
                placeholder="Ingresa tu dirección completa"
                required
            >

            <input
                type="password"
                name="contrasena"
                placeholder="Crea una contraseña segura"
                required
            >

            <input
                type="password"
                name="confirmar_contrasena"
                placeholder="Confirma tu contraseña"
                required
            >

            <button type="submit">
                Registrarme
            </button>

        </form>

    </div>

</div>

</body>
</html>