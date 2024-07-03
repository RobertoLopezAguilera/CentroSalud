<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de Facturas</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'assets/header.html'; ?>
    <div id="header"></div>

    <h1>Detalles de Facturas Medicas</h1>
    <?php
    include 'includes/conexion.php';

    // Verifica la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    $sql = "SELECT * from detalle_factura;";

    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Factura</th><th>Descripcion</th><th>Cantidad</th><th>Precio Unitario</th><th>Subtotal</th></tr>";
        while($fila = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($fila["id_detalle"]) . "</td>";
                echo "<td>" . htmlspecialchars($fila["id_factura"]) . "</td>";
                echo "<td>" . htmlspecialchars($fila["descripcion"]) . "</td>";
                echo "<td>" . htmlspecialchars($fila["cantidad"]) . "</td>";
                echo "<td>" . htmlspecialchars($fila["precio_unitario"]) . "</td>";
                echo "<td>" . htmlspecialchars($fila["subtotal"]) . "</td>";
                echo "<td>";
               /* echo "<a class='button-33' href='editar_personal.php?id=" . htmlspecialchars($fila["id_personal"]) . "'>Editar</a>";
                echo "<a class='button-34' href='eliminar_personal.php?id=" . htmlspecialchars($fila["id_personal"]) . "' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este registro?\")'>Eliminar</a>";*/
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