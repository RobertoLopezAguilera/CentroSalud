<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Personal Médico y Administrativo</h1>
    <?php
    include 'includes/conexion.php';
    $sql = "SELECT * FROM Personal";

    $resultado = $conn->query($sql);
    if ($resultado->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Nombre</th><th>Apellido</th><th>Tipo de Personal</th><th>Especialidad</th><th>Correo</th><th>Teléfono</th><th>Acciones</th></tr>";
        while($fila = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $fila["id_personal"] . "</td>";
            echo "<td>" . $fila["nombre"] . "</td>";
            echo "<td>" . $fila["apellido"] . "</td>";
            echo "<td>" . $fila["tipo_personal"] . "</td>";
            echo "<td>" . $fila["especialidad"] . "</td>";
            echo "<td>" . $fila["Correo"] . "</td>";
            echo "<td>" . $fila["telefono"] . "</td>";
            echo "<td>";
            echo "<a class='edit' href='editar_personal.php?id=" . $fila["id_personal"] . "'>Editar</a>";
            echo "<a class='delete' href='eliminar_personal.php?id=" . $fila["id_personal"] . "' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este registro?\")'>Eliminar</a>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No se encontraron resultados";
    }
    $conn->close();
    ?>
    <a href="agregar_personal.php">Agregar Personal</a>
</body>
</html>
