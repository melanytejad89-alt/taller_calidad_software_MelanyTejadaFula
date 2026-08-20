<?php

$host = "localhost";
$user = "root";
$password = "";
$db = "tienda_deportiva";

$mysql_conn = new mysqli($host, $user, $password, $db);

if ($mysql_conn->connect_error) {
    die("Error de conexión: " . $mysql_conn->connect_error);
}
