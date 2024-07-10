<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de Facturas</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include 'assets/header.php'; ?>
    <div id="header"></div>

    <h1>Detalles de Facturas Medicas</h1>
    <?php
    include 'includes/conexion.php';

    // Verifica la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    $id_factura = isset($_GET['id']) ? intval($_GET['id']) : 0;

    // Modifica la consulta SQL para seleccionar solo los registros relacionados al ID obtenido
    $sql = "SELECT * FROM detalle_factura WHERE id_factura = $id_factura;";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Factura</th><th>Descripcion</th><th>Cantidad</th><th>Precio Unitario</th><th>Subtotal</th><th>Acciones</th></tr>";
        while ($fila = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($fila["id_detalle"]) . "</td>";
            echo "<td>" . htmlspecialchars($fila["id_factura"]) . "</td>";
            echo "<td>" . htmlspecialchars($fila["descripcion"]) . "</td>";
            echo "<td>" . htmlspecialchars($fila["cantidad"]) . "</td>";
            echo "<td>" . htmlspecialchars($fila["precio_unitario"]) . "</td>";
            echo "<td>" . htmlspecialchars($fila["subtotal"]) . "</td>";
            echo "<td>";
            echo "<a class='button-33' href='editar_detalle_factura.php?id=" . htmlspecialchars($fila["id_detalle"]) . "'>Editar</a>";
            echo "<a class='button-34' href='eliminar_detalle_factura.php?id=" . htmlspecialchars($fila["id_detalle"]) . "' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este registro?\")'>Eliminar</a>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No se encontraron resultados";
    }

    $conn->close();
    ?>

    <div class="inputdiv">
        <a href="facturas.php">Volver a la lista de facturas</a>
    </div>

    <?php include 'assets/footer.html'; ?>
    <div id="footer"></div>
</body>

</html>