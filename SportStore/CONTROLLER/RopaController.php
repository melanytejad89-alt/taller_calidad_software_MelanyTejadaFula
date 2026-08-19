<?php

require_once __DIR__ . "/../MODEL/Ropa.php";

class RopaController
{
    private $modelo;


    public function __construct()
    {
        $this->modelo = new Ropa();
    }


    public function index()
    {
        $ropa = $this->modelo->obtenerTodos();

        require __DIR__ . "/../VIEW/ropa.php";
    }


    public function guardar()
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {

            header("Location: index.php?accion=ropa");

            exit;
        }


        $serial_ropa = trim(
            $_POST["serial_ropa"] ?? ""
        );

        $nombre_ropa = trim(
            $_POST["nombre_ropa"] ?? ""
        );

        $marca = trim(
            $_POST["marca"] ?? ""
        );


        if (
            empty($serial_ropa) ||
            empty($nombre_ropa) ||
            empty($marca)
        ) {

            header(
                "Location: index.php?accion=ropa&error=campos"
            );

            exit;
        }


        $resultado = $this->modelo->crear(
            $serial_ropa,
            $nombre_ropa,
            $marca
        );


        if ($resultado) {

            header(
                "Location: index.php?accion=ropa&mensaje=creado"
            );

        } else {

            header(
                "Location: index.php?accion=ropa&error=guardar"
            );
        }

        exit;
    }
}

?>