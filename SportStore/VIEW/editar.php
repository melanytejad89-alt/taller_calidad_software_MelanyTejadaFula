<?php

require_once __DIR__ . "/../CONTROLLER/ProductoController.php";

$controller = new ProductoController();

$errores = [];


// ==========================================
// OBTENER ID
// ==========================================

$id = intval($_GET["id"] ?? $_POST["id_producto"] ?? 0);


if ($id <= 0) {

    die("Producto no válido.");

}


// ==========================================
// ACTUALIZAR
// ==========================================

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $resultado = $controller->actualizar($_POST);


    if ($resultado["success"]) {

        header("Location: productos.php");
        exit;

    }


    $errores = $resultado["errores"] ?? [];

    $producto = $_POST;

}


// ==========================================
// MOSTRAR PRODUCTO
// ==========================================

else {

    $producto = $controller->obtener($id);


    if (!$producto) {

        die("Producto no encontrado.");

    }

}

?>

<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar Producto</title>

    <link rel="stylesheet" href="../css/estilos.css">

</head>

<body>


<header>

    <h1>SPORTSTORE</h1>

    <p>Editar producto</p>

</header>


<nav>

    <a href="inicio.php">
        Inicio
    </a>

    <a href="productos.php">
        Productos
    </a>

    <a href="registrar.php">
        Registrar
    </a>

    <a href="ropa.php">
        Categorías
    </a>

</nav>


<section>

    <h2 class="titulo">
        Editar Producto
    </h2>


    <?php if (!empty($errores)): ?>

        <?php foreach ($errores as $error): ?>

            <p>
                <?= htmlspecialchars($error) ?>
            </p>

        <?php endforeach; ?>

    <?php endif; ?>


    <form method="POST" action="editar.php">


        <input
            type="hidden"
            name="id_producto"
            value="<?= htmlspecialchars($producto["id_producto"]) ?>"
        >


        <input
            type="text"
            name="nombre_producto"
            placeholder="Nombre"
            value="<?= htmlspecialchars($producto["nombre_producto"]) ?>"
            required
        >


        <input
            type="text"
            name="categoria"
            placeholder="Categoría"
            value="<?= htmlspecialchars($producto["categoria"]) ?>"
            required
        >


        <input
            type="number"
            name="precio"
            step="0.01"
            min="0"
            value="<?= htmlspecialchars($producto["precio"]) ?>"
            required
        >


        <input
            type="number"
            name="stock"
            min="0"
            value="<?= htmlspecialchars($producto["stock"]) ?>"
            required
        >


        <button type="submit">
            Actualizar producto
        </button>


    </form>


    <br>


    <a href="productos.php">
        Volver a productos
    </a>


</section>


</body>

</html>