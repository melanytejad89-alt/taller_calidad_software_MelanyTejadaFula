<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Categorías - SportStore</title>

    <link rel="stylesheet"
          href="css/estilos.css">

</head>

<body>

<header>

    <h1>SPORTSTORE</h1>

    <p>Tipos de ropa deportiva</p>

</header>


<nav>

    <a href="index.php?accion=inicio">
        Inicio
    </a>

    <a href="index.php?accion=productos">
        Productos
    </a>

    <a href="index.php?accion=registrar">
        Registrar
    </a>

    <a href="index.php?accion=ropa">
        Categorías
    </a>

</nav>


<section class="productos">

    <h2 class="titulo">
        Categorías / Tipos de ropa
    </h2>


    <?php if (isset($_GET["mensaje"])): ?>

        <div class="mensaje">
            Ropa registrada correctamente.
        </div>

    <?php endif; ?>


    <?php if (isset($_GET["error"])): ?>

        <div class="error">
            Todos los campos son obligatorios.
        </div>

    <?php endif; ?>


    <div class="formulario">

        <h3>Registrar tipo de ropa</h3>


        <form
            action="index.php?accion=guardarRopa"
            method="POST">


            <label>
                Serial
            </label>

            <input
                type="text"
                name="serial_ropa"
                required>


            <label>
                Nombre de ropa
            </label>

            <input
                type="text"
                name="nombre_ropa"
                placeholder="Ejemplo: Camiseta"
                required>


            <label>
                Marca
            </label>

            <input
                type="text"
                name="marca"
                placeholder="Ejemplo: Nike"
                required>


            <button type="submit">
                Guardar
            </button>


        </form>

    </div>


    <div class="tabla-container">

        <table>

            <thead>

                <tr>

                    <th>Serial</th>

                    <th>Nombre</th>

                    <th>Marca</th>

                </tr>

            </thead>


            <tbody>

                <?php foreach ($ropa as $item): ?>

                    <tr>

                        <td>
                            <?= htmlspecialchars(
                                $item["serial_ropa"]
                            ) ?>
                        </td>


                        <td>
                            <?= htmlspecialchars(
                                $item["nombre_ropa"]
                            ) ?>
                        </td>


                        <td>
                            <?= htmlspecialchars(
                                $item["marca"]
                            ) ?>
                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    </div>

</section>

</body>

</html>