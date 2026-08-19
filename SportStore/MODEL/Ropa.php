<?php

require_once __DIR__ . "/../conexion.php";

class Ropa
{
    private $conexion;

    public function __construct()
    {
        global $mysql_conn;

        $this->conexion = $mysql_conn;
    }


    // MOSTRAR ROPA

    public function obtenerTodos()
    {
        $sql = "SELECT serial_ropa,
                       nombre_ropa,
                       marca
                FROM ropa
                ORDER BY nombre_ropa ASC";

        $resultado = $this->conexion->query($sql);

        $ropa = [];

        if ($resultado) {

            while ($fila = $resultado->fetch_assoc()) {
                $ropa[] = $fila;
            }
        }

        return $ropa;
    }


    // CREAR ROPA

    public function crear(
        $serial_ropa,
        $nombre_ropa,
        $marca
    ) {

        $sql = "INSERT INTO ropa
                (
                    serial_ropa,
                    nombre_ropa,
                    marca
                )
                VALUES (?, ?, ?)";

        $stmt = $this->conexion->prepare($sql);

        if (!$stmt) {
            return false;
        }

        $stmt->bind_param(
            "sss",
            $serial_ropa,
            $nombre_ropa,
            $marca
        );

        return $stmt->execute();
    }
}

?>