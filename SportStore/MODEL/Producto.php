<?php

require_once __DIR__ . "/../conexion.php";

class Producto
{
    private $conexion;

    public function __construct()
    {
        global $mysql_conn;

        $this->conexion = $mysql_conn;
    }

    // ==============================
    // MOSTRAR TODOS LOS PRODUCTOS
    // ==============================
    public function obtenerTodos()
    {
        $sql = "SELECT 
                    id_producto,
                    nombre_producto,
                    categoria,
                    precio,
                    stock,
                    fecha_registro
                FROM productos
                ORDER BY id_producto DESC";

        $resultado = $this->conexion->query($sql);

        $productos = [];

        if ($resultado) {

            while ($fila = $resultado->fetch_assoc()) {
                $productos[] = $fila;
            }

        }

        return $productos;
    }


    // ==============================
    // BUSCAR PRODUCTO POR ID
    // ==============================
    public function obtenerPorId($id)
    {
        $sql = "SELECT 
                    id_producto,
                    nombre_producto,
                    categoria,
                    precio,
                    stock,
                    fecha_registro
                FROM productos
                WHERE id_producto = ?";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bind_param("i", $id);

        $stmt->execute();

        $resultado = $stmt->get_result();

        return $resultado->fetch_assoc();
    }


    // ==============================
    // CREAR PRODUCTO
    // ==============================
    public function crear($nombre, $categoria, $precio, $stock)
    {
        $sql = "INSERT INTO productos
                (nombre_producto, categoria, precio, stock)
                VALUES (?, ?, ?, ?)";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bind_param(
            "ssdi",
            $nombre,
            $categoria,
            $precio,
            $stock
        );

        return $stmt->execute();
    }


    // ==============================
    // ACTUALIZAR PRODUCTO
    // ==============================
    public function actualizar(
        $id,
        $nombre,
        $categoria,
        $precio,
        $stock
    ) {

        $sql = "UPDATE productos
                SET nombre_producto = ?,
                    categoria = ?,
                    precio = ?,
                    stock = ?
                WHERE id_producto = ?";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bind_param(
            "ssdii",
            $nombre,
            $categoria,
            $precio,
            $stock,
            $id
        );

        return $stmt->execute();
    }


    // ==============================
    // ELIMINAR PRODUCTO
    // ==============================
    public function eliminar($id)
    {
        $sql = "DELETE FROM productos
                WHERE id_producto = ?";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }
}

?>