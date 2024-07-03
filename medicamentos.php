<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicamentos</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'assets/header.html'; ?>
    <div id="header"></div>

    <h1>Medicamentos</h1>
    <a href="agregar_medicamento.php" class="button-29">Agregar Medicamento</a>
    <?php
    include 'includes/conexion.php';
    $sql = "SELECT * FROM Medicamentos";
    $resultado = $conn->query($sql);
    if ($resultado->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Nombre</th><th>Descripción</th><th>Stock</th><th>Precio</th><th>Fecha de Caducidad</th><th>Acciones</th></tr>";
        while($fila = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $fila["id_medicamento"] . "</td>";
            echo "<td>" . $fila["nombre"] . "</td>";
            echo "<td>" . $fila["descripcion"] . "</td>";
            echo "<td>" . $fila["stock"] . "</td>";
            echo "<td>" . $fila["precio"] . "</td>";
            echo "<td>" . $fila["fecha_caducidad"] . "</td>";
            echo "<td>";
            echo "<a class='button-33' href='editar_medicamento.php?id=" . $fila["id_medicamento"] . "'>Editar</a>";
            echo "<a class='button-34' href='eliminar_medicamento.php?id=" . $fila["id_medicamento"] . "' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este registro?\")'>Eliminar</a>";
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
