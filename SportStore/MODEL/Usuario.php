<?php

require_once __DIR__ . "/../conexion.php";

class Usuario
{
    private $conexion;

    public function __construct()
    {
        global $mysql_conn;

        $this->conexion = $mysql_conn;
    }

    // ==============================
    // BUSCAR USUARIO POR NÚMERO DE IDENTIFICACIÓN
    // ==============================
    public function obtenerPorIdentificacion($numero_identificacion)
    {
        $sql = "SELECT 
                    id_usuario,
                    numero_identificacion,
                    nombre,
                    apellido,
                    correo,
                    telefono,
                    direccion,
                    contrasena,
                    rol,
                    estado,
                    fecha_registro
                FROM usuarios
                WHERE numero_identificacion = ?";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bind_param("s", $numero_identificacion);

        $stmt->execute();

        $resultado = $stmt->get_result();

        return $resultado->fetch_assoc();
    }


    // ==============================
    // BUSCAR USUARIO POR CORREO
    // ==============================
    public function obtenerPorCorreo($correo)
    {
        $sql = "SELECT id_usuario
                FROM usuarios
                WHERE correo = ?";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bind_param("s", $correo);

        $stmt->execute();

        $resultado = $stmt->get_result();

        return $resultado->fetch_assoc();
    }


    // ==============================
    // BUSCAR USUARIO POR ID
    // ==============================
    public function obtenerPorId($id)
    {
        $sql = "SELECT 
                    id_usuario,
                    numero_identificacion,
                    nombre,
                    apellido,
                    correo,
                    telefono,
                    direccion,
                    rol,
                    estado,
                    fecha_registro
                FROM usuarios
                WHERE id_usuario = ?";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bind_param("i", $id);

        $stmt->execute();

        $resultado = $stmt->get_result();

        return $resultado->fetch_assoc();
    }


    // ==============================
    // MOSTRAR TODOS LOS USUARIOS
    // ==============================
    public function obtenerTodos()
    {
        $sql = "SELECT 
                    id_usuario,
                    numero_identificacion,
                    nombre,
                    apellido,
                    correo,
                    telefono,
                    direccion,
                    rol,
                    estado,
                    fecha_registro
                FROM usuarios
                ORDER BY id_usuario DESC";

        $resultado = $this->conexion->query($sql);

        $usuarios = [];

        if ($resultado) {

            while ($fila = $resultado->fetch_assoc()) {
                $usuarios[] = $fila;
            }

        }

        return $usuarios;
    }


    // ==============================
    // CREAR USUARIO (REGISTRO)
    // ==============================
    public function crear(
        $numero_identificacion,
        $nombre,
        $apellido,
        $correo,
        $telefono,
        $direccion,
        $contrasena,
        $rol
    ) {
        $sql = "INSERT INTO usuarios
                (numero_identificacion, nombre, apellido, correo, telefono, direccion, contrasena, rol, estado)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'Activo')";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bind_param(
            "ssssssss",
            $numero_identificacion,
            $nombre,
            $apellido,
            $correo,
            $telefono,
            $direccion,
            $contrasena,
            $rol
        );

        return $stmt->execute();
    }


    // ==============================
    // ACTUALIZAR USUARIO
    // ==============================
    public function actualizar(
        $id,
        $numero_identificacion,
        $nombre,
        $apellido,
        $correo,
        $telefono,
        $direccion,
        $rol
    ) {
        $sql = "UPDATE usuarios
                SET numero_identificacion = ?,
                    nombre = ?,
                    apellido = ?,
                    correo = ?,
                    telefono = ?,
                    direccion = ?,
                    rol = ?
                WHERE id_usuario = ?";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bind_param(
            "sssssssi",
            $numero_identificacion,
            $nombre,
            $apellido,
            $correo,
            $telefono,
            $direccion,
            $rol,
            $id
        );

        return $stmt->execute();
    }


    // ==============================
    // CAMBIAR ESTADO (ACTIVAR / INACTIVAR)
    // ==============================
    public function cambiarEstado($id, $estado)
    {
        $sql = "UPDATE usuarios
                SET estado = ?
                WHERE id_usuario = ?";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bind_param("si", $estado, $id);

        return $stmt->execute();
    }
}

?>