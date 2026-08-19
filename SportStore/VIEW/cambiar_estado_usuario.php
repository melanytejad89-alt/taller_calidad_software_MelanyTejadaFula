<?php

require_once __DIR__ . "/../CONTROLLER/UsuarioController.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["id_usuario"]) || $_SESSION["rol"] !== "Administrador") {
    header("Location: inicio.php");
    exit;
}

$controller = new UsuarioController();

$id = intval($_GET["id"] ?? 0);
$estado = $_GET["estado"] ?? "";

if ($id > 0 && in_array($estado, ["Activo", "Inactivo"])) {
    $controller->cambiarEstado($id, $estado);
}

header("Location: usuarios.php");
exit;

?>