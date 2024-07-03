<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Habitaciones</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'assets/header.html'; ?>
    <div id="header"></div>

    <h1>Habitaciones del Hospital</h1>
    <a href="agregar_habitacion.php" class="button-29">Agregar Habitación</a>
    <?php
    include 'includes/conexion.php';
    $sql = "SELECT Habitaciones.id_habitacion, Habitaciones.numero, Habitaciones.tipo, Habitaciones.estado, Habitaciones.costo, Areas.nombre AS nombre_area FROM Habitaciones JOIN Areas ON Habitaciones.id_area = Areas.id_area";
    $resultado = $conn->query($sql);
    if ($resultado->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Número</th><th>Tipo</th><th>Estado</th><th>Costo</th><th>Área</th><th>Acciones</th></tr>";
        while($fila = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $fila["id_habitacion"] . "</td>";
            echo "<td>" . $fila["numero"] . "</td>";
            echo "<td>" . $fila["tipo"] . "</td>";
            echo "<td>" . $fila["estado"] . "</td>";
            echo "<td>" . $fila["costo"] . "</td>";
            echo "<td>" . $fila["nombre_area"] . "</td>";
            echo "<td>";
            echo "<a class='button-33' href='editar_habitacion.php?id=" . $fila["id_habitacion"] . "'>Editar</a>";
            echo "<a class='button-34' href='eliminar_habitacion.php?id=" . $fila["id_habitacion"] . "' onclick='return confirm(\"¿Estás seguro de que deseas eliminar esta habitación?\")'>Eliminar</a>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No se encontraron resultados";
    }
    $conn->close();
    ?>
        
    <?php include 'assets/footer.html'; ?>
    <div id="footer"></div>
</body>
</html>
