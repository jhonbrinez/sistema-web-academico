<?php

include("conexion.php");

if(isset($_POST['guardar'])){

    $documento = $_POST['documento'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $programa = $_POST['programa'];

    $sql = "INSERT INTO estudiantes
    (documento,nombres,apellidos,correo,telefono,programa)
    VALUES
    ('$documento','$nombres','$apellidos','$correo','$telefono','$programa')";

    $conexion->query($sql);
}

if(isset($_GET['eliminar'])){

    $id = $_GET['eliminar'];

    $conexion->query(
        "DELETE FROM estudiantes WHERE id_estudiante=$id"
    );
}

$resultado = $conexion->query(
    "SELECT * FROM estudiantes"
);

?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Estudiantes</title>
<link rel="stylesheet" href="estilos.css">
</head>
<body>

<div class="contenedor">

<h1>Gestión de Estudiantes</h1>

<a href="index.php">Volver al menú</a>

<br><br>

<form method="POST">

<input type="text"
name="documento"
placeholder="Documento"
required>

<input type="text"
name="nombres"
placeholder="Nombres"
required>

<input type="text"
name="apellidos"
placeholder="Apellidos"
required>

<input type="email"
name="correo"
placeholder="Correo">

<input type="text"
name="telefono"
placeholder="Teléfono">

<input type="text"
name="programa"
placeholder="Programa">

<button type="submit"
name="guardar">
Guardar
</button>

</form>

<br>

<table border="1" width="100%">

<tr>
<th>ID</th>
<th>Documento</th>
<th>Nombres</th>
<th>Apellidos</th>
<th>Correo</th>
<th>Teléfono</th>
<th>Programa</th>
<th>Acción</th>
</tr>

<?php while($fila = $resultado->fetch_assoc()){ ?>

<tr>

<td><?= $fila['id_estudiante']; ?></td>

<td><?= $fila['documento']; ?></td>

<td><?= $fila['nombres']; ?></td>

<td><?= $fila['apellidos']; ?></td>

<td><?= $fila['correo']; ?></td>

<td><?= $fila['telefono']; ?></td>

<td><?= $fila['programa']; ?></td>

<td>

<a href="?eliminar=<?= $fila['id_estudiante']; ?>"
onclick="return confirm('¿Eliminar estudiante?')">
Eliminar
</a>

</td>

</tr>

<?php } ?>

</table>

</div>

</body>
</html>