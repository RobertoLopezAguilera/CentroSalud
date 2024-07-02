<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Áreas del Hospital</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Áreas del Hospital</h1>
    <?php
    include 'includes/conexion.php';
    $sql = "SELECT * FROM Areas";
    $resultado = $conn->query($sql);
    if ($resultado->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Nombre</th><th>Acciones</th></tr>";
        while($fila = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $fila["id_area"] . "</td>";
            echo "<td>" . $fila["nombre"] . "</td>";
            echo "<td>";
            echo "<a class='edit' href='editar_area.php?id=" . $fila["id_area"] . "'>Editar</a>";
            echo "<a class='delete' href='eliminar_area.php?id=" . $fila["id_area"] . "' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este registro?\")'>Eliminar</a>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No se encontraron resultados";
    }
    $conn->close();
    ?>
    <a href="agregar_area.php">Agregar Área</a>
</body>
</html>
