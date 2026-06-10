```php
<?php

include("conexion.php");

// Guardar nómina
if(isset($_POST['guardar'])){

    $id_profesor = $_POST['id_profesor'];
    $salario = $_POST['salario'];
    $fecha_pago = $_POST['fecha_pago'];
    $horas_trabajadas = $_POST['horas_trabajadas'];

    $sql = "INSERT INTO nomina
    (id_profesor,salario,fecha_pago,horas_trabajadas)
    VALUES
    ('$id_profesor','$salario','$fecha_pago','$horas_trabajadas')";

    $conexion->query($sql);
}

// Eliminar nómina
if(isset($_GET['eliminar'])){

    $id = $_GET['eliminar'];

    $conexion->query(
        "DELETE FROM nomina WHERE id_nomina = $id"
    );
}

$profesores = $conexion->query(
    "SELECT * FROM profesores"
);

$resultado = $conexion->query("
SELECT n.*, p.nombres, p.apellidos
FROM nomina n
INNER JOIN profesores p
ON n.id_profesor = p.id_profesor
");

?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Nómina</title>
<link rel="stylesheet" href="estilos.css">
</head>
<body>

<div class="contenedor">

<h1>Gestión de Nómina</h1>

<a href="index.php">Volver al menú</a>

<br><br>

<form method="POST">

<select name="id_profesor" required>

<option value="">Seleccione Profesor</option>

<?php while($p = $profesores->fetch_assoc()){ ?>

<option value="<?= $p['id_profesor']; ?>">
<?= $p['nombres']." ".$p['apellidos']; ?>
</option>

<?php } ?>

</select>

<input type="number"
name="salario"
placeholder="Salario"
required>

<input type="number"
name="horas_trabajadas"
placeholder="Horas Trabajadas">

<input type="date"
name="fecha_pago"
required>

<button type="submit" name="guardar">
Guardar
</button>

</form>

<br>

<table border="1" width="100%">

<tr>
<th>ID</th>
<th>Profesor</th>
<th>Salario</th>
<th>Horas</th>
<th>Fecha Pago</th>
<th>Acción</th>
</tr>

<?php while($fila = $resultado->fetch_assoc()){ ?>

<tr>

<td><?= $fila['id_nomina']; ?></td>

<td>
<?= $fila['nombres']." ".$fila['apellidos']; ?>
</td>

<td>$<?= $fila['salario']; ?></td>

<td><?= $fila['horas_trabajadas']; ?></td>

<td><?= $fila['fecha_pago']; ?></td>

<td>

<a href="?eliminar=<?= $fila['id_nomina']; ?>"
onclick="return confirm('¿Eliminar registro de nómina?')">
Eliminar
</a>

</td>

</tr>

<?php } ?>

</table>

</div>

</body>
</html>
```
