<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SportStore</title>

    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

<header>

    <h1>SPORTSTORE</h1>
    <p>La mejor ropa deportiva para ti</p>

</header>

<nav>

    <a href="#">Inicio</a>
    <a href="#productos">Productos</a>
    <a href="#registro">Registrar</a>
    <a href="VIEW/productos.php">Ver Productos</a>

</nav>

<section class="banner">

    <div class="banner-text">
        <h2>Entrena con Estilo</h2>
        <p>Encuentra la mejor ropa deportiva.</p>
    </div>

</section>

<section id="productos">

    <h2 class="titulo">Productos Destacados</h2>

    <div class="contenedor">

        <div class="card">
            <img src="https://via.placeholder.com/250x200">
            <h3>Camiseta Nike</h3>
            <p>$120.000</p>
        </div>

        <div class="card">
            <img src="https://via.placeholder.com/250x200">
            <h3>Sudadera Adidas</h3>
            <p>$180.000</p>
        </div>

        <div class="card">
            <img src="https://via.placeholder.com/250x200">
            <h3>Pantaloneta Puma</h3>
            <p>$90.000</p>
        </div>

    </div>

</section>

<section id="registro">

    <h2 class="titulo">Registrar Producto</h2>

    <form action="guardar_producto.php" method="POST">

        <input
        type="text"
        name="nombre_producto"
        placeholder="Nombre del Producto"
        required>

        <input
        type="text"
        name="categoria"
        placeholder="Categoría"
        required>

        <input
        type="number"
        step="0.01"
        name="precio"
        placeholder="Precio"
        required>

        <input
        type="number"
        name="stock"
        placeholder="Stock"
        required>

        <button type="submit">
            Guardar Producto
        </button>

    </form>

</section>

<footer>

    <p>© 2026 SportStore - Todos los derechos reservados.</p>

</footer>

</body>
</html>