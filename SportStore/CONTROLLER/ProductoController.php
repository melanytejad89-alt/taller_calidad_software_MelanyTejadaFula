<?php

require_once __DIR__ . "/../MODEL/Producto.php";

class ProductoController
{
    private $producto;

    public function __construct()
    {
        $this->producto = new Producto();
    }


    // ==============================
    // LISTAR
    // ==============================
    public function listar()
    {
        return $this->producto->obtenerTodos();
    }


    // ==============================
    // OBTENER UNO
    // ==============================
    public function obtener($id)
    {
        return $this->producto->obtenerPorId($id);
    }


    // ==============================
    // GUARDAR
    // ==============================
    public function guardar($datos)
    {
        $errores = [];

        $nombre = trim($datos["nombre_producto"] ?? "");
        $categoria = trim($datos["categoria"] ?? "");
        $precio = $datos["precio"] ?? "";
        $stock = $datos["stock"] ?? "";


        // Validar nombre
        if ($nombre === "") {
            $errores[] = "El nombre del producto es obligatorio.";
        }


        // Validar categoría
        if ($categoria === "") {
            $errores[] = "La categoría es obligatoria.";
        }


        // Validar precio
        if (!is_numeric($precio) || $precio < 0) {
            $errores[] = "El precio debe ser un número mayor o igual a 0.";
        }


        // Validar stock
        if (!is_numeric($stock) || $stock < 0 || intval($stock) != $stock) {
            $errores[] = "El stock debe ser un número entero mayor o igual a 0.";
        }


        if (!empty($errores)) {

            return [
                "success" => false,
                "errores" => $errores
            ];
        }


        $precio = (float) $precio;
        $stock = (int) $stock;


        $guardado = $this->producto->crear(
            $nombre,
            $categoria,
            $precio,
            $stock
        );


        if ($guardado) {

            return [
                "success" => true,
                "mensaje" => "Producto registrado correctamente."
            ];

        }


        return [
            "success" => false,
            "errores" => [
                "No fue posible guardar el producto."
            ]
        ];
    }


    // ==============================
    // ACTUALIZAR
    // ==============================
    public function actualizar($datos)
    {
        $errores = [];

        $id = intval($datos["id_producto"] ?? 0);

        $nombre = trim($datos["nombre_producto"] ?? "");
        $categoria = trim($datos["categoria"] ?? "");
        $precio = $datos["precio"] ?? "";
        $stock = $datos["stock"] ?? "";


        if ($id <= 0) {
            $errores[] = "ID del producto inválido.";
        }


        if ($nombre === "") {
            $errores[] = "El nombre del producto es obligatorio.";
        }


        if ($categoria === "") {
            $errores[] = "La categoría es obligatoria.";
        }


        if (!is_numeric($precio) || $precio < 0) {
            $errores[] = "El precio debe ser un número mayor o igual a 0.";
        }


        if (!is_numeric($stock) || $stock < 0 || intval($stock) != $stock) {
            $errores[] = "El stock debe ser un número entero mayor o igual a 0.";
        }


        if (!empty($errores)) {

            return [
                "success" => false,
                "errores" => $errores
            ];
        }


        $precio = (float) $precio;
        $stock = (int) $stock;


        $actualizado = $this->producto->actualizar(
            $id,
            $nombre,
            $categoria,
            $precio,
            $stock
        );


        if ($actualizado) {

            return [
                "success" => true,
                "mensaje" => "Producto actualizado correctamente."
            ];

        }


        return [
            "success" => false,
            "errores" => [
                "No fue posible actualizar el producto."
            ]
        ];
    }


    // ==============================
    // ELIMINAR
    // ==============================
    public function eliminar($id)
    {
        return $this->producto->eliminar($id);
    }
}

?>