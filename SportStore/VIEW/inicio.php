<?php

require_once __DIR__ . "/../CONTROLLER/UsuarioController.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$controller = new UsuarioController();

$errores_login = [];


// ==========================================
// PROCESAR LOGIN
// ==========================================

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["login"])) {

    $resultado = $controller->iniciarSesion($_POST);

    if ($resultado["success"]) {

        header("Location: inicio.php");
        exit;

    }

    $errores_login = $resultado["errores"] ?? [];

}


// ==========================================
// CERRAR SESIÓN
// ==========================================

if (isset($_GET["logout"])) {

    $controller->cerrarSesion();

    header("Location: inicio.php");
    exit;

}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SportStore</title>

    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>

<header>

    <h1>SPORTSTORE</h1>
    <p>La mejor ropa deportiva para ti</p>

</header>

<nav>

    <a href="inicio.php">Inicio</a>
    <a href="#productos">Productos</a>
    <a href="productos.php">Ver Productos</a>

    <?php if (isset($_SESSION["id_usuario"])): ?>

        <span>Hola, <?= htmlspecialchars($_SESSION["nombre"]) ?> (<?= htmlspecialchars($_SESSION["rol"]) ?>)</span>

        <?php if ($_SESSION["rol"] === "Administrador"): ?>
            <a href="usuarios.php">Usuarios</a>
        <?php endif; ?>

        <a href="?logout=1">Cerrar sesión</a>

    <?php else: ?>

        <a href="#" onclick="document.getElementById('modalLogin').classList.add('activo'); return false;">
            Iniciar Sesión
        </a>

    <?php endif; ?>

</nav>

<section class="banner">

    <div class="banner-text">

        <h2>Entrena con Estilo</h2>

        <p>
            Encuentra la mejor ropa deportiva
            para acompañarte en cada entrenamiento.
        </p>

        <br>

        <a href="productos.php">
            <button>
                Ver productos
            </button>
        </a>

    </div>

</section>


<section id="productos">

    <h2 class="titulo">
        Productos Destacados
    </h2>


    <div class="contenedor">


        <div class="card">

            <img
                src="../ASSETS/IMG/camisa.webp"
                alt="Camiseta deportiva"
            >

            <h3>
                Camiseta Nike
            </h3>

            <p>
                $120.000
            </p>

        </div>


        <div class="card">

            <img
                src="../ASSETS/sudadera.jpg"
                alt="Sudadera deportiva"
            >

            <h3>
                Sudadera Adidas
            </h3>

            <p>
                $180.000
            </p>

        </div>


        <div class="card">

            <img
                src="../ASSETS/pantaloneta.jpg"
                alt="Pantaloneta deportiva"
            >

            <h3>
                Pantaloneta Puma
            </h3>

            <p>
                $90.000
            </p>

        </div>


    </div>

</section>

<footer>

    <p>© 2026 SportStore - Todos los derechos reservados.</p>

</footer>


<?php if (!isset($_SESSION["id_usuario"])): ?>

<div id="modalLogin" class="modal-overlay <?= !empty($errores_login) ? "activo" : "" ?>">

    <div class="modal-caja">

        <span class="modal-cerrar" onclick="document.getElementById('modalLogin').classList.remove('activo');">
            &times;
        </span>

        <h2>Iniciar Sesión</h2>

        <?php if (!empty($errores_login)): ?>

            <div class="modal-errores">

                <?php foreach ($errores_login as $error): ?>
                    <p><?= htmlspecialchars($error) ?></p>
                <?php endforeach; ?>

            </div>

        <?php endif; ?>

        <form method="POST" action="">

           <input
    type="text"
    name="numero_identificacion"
    placeholder="Número de identificación"
    pattern="[0-9]+"
    title="Solo se permiten números"
    required
>

            <input
                type="password"
                name="contrasena"
                placeholder="Contraseña"
                required
            >

            <select name="rol" required>
                <option value="" disabled selected>Seleccionar usuario</option>
                <option value="Administrador">Administrador</option>
                <option value="Cliente">Cliente</option>
            </select>

            <button type="submit" name="login">
                Iniciar Sesión
            </button>

        </form>

        <p class="modal-link">
            ¿No tienes cuenta?
            <a href="registro_usuario.php">Regístrate aquí</a>
        </p>

    </div>

</div>

<?php endif; ?>

</body>
</html>