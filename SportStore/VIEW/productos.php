<?php

require_once __DIR__ . "/../CONTROLLER/ProductoController.php";

$controller = new ProductoController();


// ==========================================
// ELIMINAR PRODUCTO
// ==========================================

if (isset($_GET["eliminar"])) {

    $id = intval($_GET["eliminar"]);

    if ($id > 0) {

        $controller->eliminar($id);

    }

    header("Location: productos.php");
    exit;
}


// ==========================================
// OBTENER PRODUCTOS
// ==========================================

$productos = $controller->listar();

?>

<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Productos - SportStore</title>

    <link rel="stylesheet" href="../css/estilos.css">

</head>

<body>


<header>

    <h1>SPORTSTORE</h1>

    <p>La mejor ropa deportiva para ti</p>

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
        Productos registrados
    </h2>


    <div style="margin-bottom: 20px;">

        <a href="registrar.php">
            <button type="button">
                + Registrar producto
            </button>
        </a>

    </div>


    <?php if (empty($productos)): ?>

        <p>
            No hay productos registrados en la base de datos.
        </p>

    <?php else: ?>


        <table>

            <thead>

                <tr>

                    <th>ID</th>

                    <th>Nombre</th>

                    <th>Categoría</th>

                    <th>Precio</th>

                    <th>Stock</th>

                    <th>Fecha</th>

                    <th>Acciones</th>

                </tr>

            </thead>


            <tbody>


                <?php foreach ($productos as $producto): ?>


                    <tr>


                        <td>

                            <?= htmlspecialchars($producto["id_producto"]) ?>

                        </td>


                        <td>

                            <?= htmlspecialchars($producto["nombre_producto"]) ?>

                        </td>


                        <td>

                            <?= htmlspecialchars($producto["categoria"]) ?>

                        </td>


                        <td>

                            $<?= number_format(
                                $producto["precio"],
                                2
                            ) ?>

                        </td>


                        <td>

                            <?= htmlspecialchars($producto["stock"]) ?>

                        </td>


                        <td>

                            <?= htmlspecialchars($producto["fecha_registro"]) ?>

                        </td>


                        <td>


                            <a href="editar.php?id=<?= $producto["id_producto"] ?>">

                                Editar

                            </a>


                            |


                            <a
                                href="productos.php?eliminar=<?= $producto["id_producto"] ?>"
                                onclick="return confirm('¿Está seguro de eliminar este producto?');"
                            >

                                Eliminar

                            </a>


                        </td>


                    </tr>


                <?php endforeach; ?>


            </tbody>

        </table>


    <?php endif; ?>


</section>


<footer>

    <p>
        © 2026 SportStore - Todos los derechos reservados.
    </p>

</footer>


</body>

</html>