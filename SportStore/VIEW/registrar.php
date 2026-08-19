<?php

require_once __DIR__ . "/../CONTROLLER/ProductoController.php";

$controller = new ProductoController();

$errores = [];

$mensaje = "";


// ==========================================
// GUARDAR PRODUCTO
// ==========================================

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $resultado = $controller->guardar($_POST);


    if ($resultado["success"]) {

        header("Location: productos.php");
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

    <title>Registrar Producto</title>

    <link rel="stylesheet" href="../css/estilos.css">

</head>

<body>


<header>

    <h1>SPORTSTORE</h1>

    <p>Registrar producto</p>

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
        Registrar Producto
    </h2>


    <?php if (!empty($errores)): ?>

        <div>

            <?php foreach ($errores as $error): ?>

                <p>
                    <?= htmlspecialchars($error) ?>
                </p>

            <?php endforeach; ?>

        </div>

    <?php endif; ?>


    <form method="POST" action="registrar.php">


        <input
            type="text"
            name="nombre_producto"
            placeholder="Nombre del producto"
            required
        >


        <input
            type="text"
            name="categoria"
            placeholder="Categoría"
            required
        >


        <input
            type="number"
            name="precio"
            placeholder="Precio"
            step="0.01"
            min="0"
            required
        >


        <input
            type="number"
            name="stock"
            placeholder="Stock"
            min="0"
            required
        >


        <button type="submit">
            Guardar producto
        </button>


    </form>


</section>


</body>

</html>