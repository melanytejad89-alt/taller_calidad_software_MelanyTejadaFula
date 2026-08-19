<?php

require_once __DIR__ . "/../MODEL/Usuario.php";

class UsuarioController
{
    private $usuario;

    public function __construct()
    {
        $this->usuario = new Usuario();
    }


    // ==============================
    // LISTAR
    // ==============================
    public function listar()
    {
        return $this->usuario->obtenerTodos();
    }


    // ==============================
    // OBTENER UNO
    // ==============================
    public function obtener($id)
    {
        return $this->usuario->obtenerPorId($id);
    }


    // ==============================
    // REGISTRAR
    // ==============================
    public function registrar($datos)
    {
        $errores = [];

        $identificacion = trim($datos["numero_identificacion"] ?? "");
        $nombre = trim($datos["nombre"] ?? "");
        $apellido = trim($datos["apellido"] ?? "");
        $correo = trim($datos["correo"] ?? "");
        $telefono = trim($datos["telefono"] ?? "");
        $direccion = trim($datos["direccion"] ?? "");
        $contrasena = $datos["contrasena"] ?? "";
        $confirmar = $datos["confirmar_contrasena"] ?? "";

        // El registro público SIEMPRE crea usuarios con rol Cliente.
        $rol = "Cliente";


        // Identificación: solo números
        if ($identificacion === "") {
            $errores[] = "El número de identificación es obligatorio.";
        } elseif (!preg_match("/^[0-9]+$/", $identificacion)) {
            $errores[] = "El número de identificación solo puede contener números.";
        }

        // Nombre: solo letras y espacios
        if ($nombre === "") {
            $errores[] = "El nombre es obligatorio.";
        } elseif (!preg_match("/^[a-zA-ZÀ-ÿ\s]+$/u", $nombre)) {
            $errores[] = "El nombre solo puede contener letras.";
        }

        // Apellido: solo letras y espacios
        if ($apellido === "") {
            $errores[] = "El apellido es obligatorio.";
        } elseif (!preg_match("/^[a-zA-ZÀ-ÿ\s]+$/u", $apellido)) {
            $errores[] = "El apellido solo puede contener letras.";
        }

        if ($correo === "" || !filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $errores[] = "Debes ingresar un correo válido.";
        }

        // Teléfono: solo números
        if ($telefono === "") {
            $errores[] = "El número de teléfono es obligatorio.";
        } elseif (!preg_match("/^[0-9]+$/", $telefono)) {
            $errores[] = "El teléfono solo puede contener números.";
        }

        if ($direccion === "") {
            $errores[] = "La dirección es obligatoria.";
        }

        if (strlen($contrasena) < 6) {
            $errores[] = "La contraseña debe tener al menos 6 caracteres.";
        }

        if ($contrasena !== $confirmar) {
            $errores[] = "Las contraseñas no coinciden.";
        }

        if ($identificacion !== "" && $this->usuario->obtenerPorIdentificacion($identificacion)) {
            $errores[] = "Ya existe un usuario registrado con ese número de identificación.";
        }

        if ($correo !== "" && $this->usuario->obtenerPorCorreo($correo)) {
            $errores[] = "Ya existe un usuario registrado con ese correo.";
        }


        if (!empty($errores)) {

            return [
                "success" => false,
                "errores" => $errores
            ];
        }


        // Contraseña guardada tal cual, sin encriptar.
        $guardado = $this->usuario->crear(
            $identificacion,
            $nombre,
            $apellido,
            $correo,
            $telefono,
            $direccion,
            $contrasena,
            $rol
        );


        if ($guardado) {

            return [
                "success" => true,
                "mensaje" => "Usuario registrado correctamente."
            ];

        }


        return [
            "success" => false,
            "errores" => [
                "No fue posible registrar el usuario."
            ]
        ];
    }


    // ==============================
    // ACTUALIZAR
    // ==============================
    public function actualizar($datos)
    {
        $errores = [];

        $id = intval($datos["id_usuario"] ?? 0);
        $identificacion = trim($datos["numero_identificacion"] ?? "");
        $nombre = trim($datos["nombre"] ?? "");
        $apellido = trim($datos["apellido"] ?? "");
        $correo = trim($datos["correo"] ?? "");
        $telefono = trim($datos["telefono"] ?? "");
        $direccion = trim($datos["direccion"] ?? "");
        $rol = trim($datos["rol"] ?? "");


        if ($id <= 0) {
            $errores[] = "ID de usuario inválido.";
        }

        // Identificación: solo números
        if ($identificacion === "") {
            $errores[] = "El número de identificación es obligatorio.";
        } elseif (!preg_match("/^[0-9]+$/", $identificacion)) {
            $errores[] = "El número de identificación solo puede contener números.";
        }

        // Nombre: solo letras y espacios
        if ($nombre === "") {
            $errores[] = "El nombre es obligatorio.";
        } elseif (!preg_match("/^[a-zA-ZÀ-ÿ\s]+$/u", $nombre)) {
            $errores[] = "El nombre solo puede contener letras.";
        }

        // Apellido: solo letras y espacios
        if ($apellido === "") {
            $errores[] = "El apellido es obligatorio.";
        } elseif (!preg_match("/^[a-zA-ZÀ-ÿ\s]+$/u", $apellido)) {
            $errores[] = "El apellido solo puede contener letras.";
        }

        if ($correo === "" || !filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $errores[] = "Debes ingresar un correo válido.";
        }

        // Teléfono: solo números
        if ($telefono === "") {
            $errores[] = "El número de teléfono es obligatorio.";
        } elseif (!preg_match("/^[0-9]+$/", $telefono)) {
            $errores[] = "El teléfono solo puede contener números.";
        }

        if ($direccion === "") {
            $errores[] = "La dirección es obligatoria.";
        }

        $roles_validos = ["Administrador", "Cliente"];
        if (!in_array($rol, $roles_validos)) {
            $errores[] = "El rol seleccionado no es válido.";
        }


        if (!empty($errores)) {

            return [
                "success" => false,
                "errores" => $errores
            ];
        }


        $actualizado = $this->usuario->actualizar(
            $id,
            $identificacion,
            $nombre,
            $apellido,
            $correo,
            $telefono,
            $direccion,
            $rol
        );


        if ($actualizado) {

            return [
                "success" => true,
                "mensaje" => "Usuario actualizado correctamente."
            ];

        }


        return [
            "success" => false,
            "errores" => [
                "No fue posible actualizar el usuario."
            ]
        ];
    }


    // ==============================
    // ACTIVAR / INACTIVAR
    // ==============================
    public function cambiarEstado($id, $estado)
    {
        $estados_validos = ["Activo", "Inactivo"];

        if (!in_array($estado, $estados_validos)) {
            return false;
        }

        return $this->usuario->cambiarEstado($id, $estado);
    }


    // ==============================
    // INICIAR SESIÓN
    // ==============================
    public function iniciarSesion($datos)
    {
        $errores = [];

        $identificacion = trim($datos["numero_identificacion"] ?? "");
        $contrasena = $datos["contrasena"] ?? "";
        $rol_seleccionado = trim($datos["rol"] ?? "");


        if ($identificacion === "" || $contrasena === "") {
            $errores[] = "Debes ingresar tu número de identificación y contraseña.";
        } elseif (!preg_match("/^[0-9]+$/", $identificacion)) {
            $errores[] = "El número de identificación solo puede contener números.";
        }


        if (!empty($errores)) {
            return [
                "success" => false,
                "errores" => $errores
            ];
        }


        $usuario = $this->usuario->obtenerPorIdentificacion($identificacion);


        // Comparación directa: la contraseña se guarda sin encriptar.
        if (!$usuario || $contrasena !== $usuario["contrasena"]) {

            return [
                "success" => false,
                "errores" => ["Número de identificación o contraseña incorrectos."]
            ];
        }


        if ($usuario["estado"] === "Inactivo") {

            return [
                "success" => false,
                "errores" => ["Tu cuenta está inactiva. Contacta a un administrador."]
            ];
        }


        if ($rol_seleccionado !== "" && $rol_seleccionado !== $usuario["rol"]) {

            return [
                "success" => false,
                "errores" => ["El rol seleccionado no coincide con tu cuenta."]
            ];
        }


        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION["id_usuario"] = $usuario["id_usuario"];
        $_SESSION["nombre"] = $usuario["nombre"];
        $_SESSION["rol"] = $usuario["rol"];


        return [
            "success" => true,
            "mensaje" => "Sesión iniciada correctamente.",
            "rol" => $usuario["rol"]
        ];
    }


    // ==============================
    // CERRAR SESIÓN
    // ==============================
    public function cerrarSesion()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        session_unset();
        session_destroy();
    }
}

?>