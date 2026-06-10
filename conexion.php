<?php

$conexion = new mysqli(
    "localhost",
    "root",
    "",
    "sistema_academico"
);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

?>