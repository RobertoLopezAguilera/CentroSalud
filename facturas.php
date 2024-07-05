<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facturas</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'assets/header.php'; ?>
    <div id="header"></div>

    <h1>Facturas</h1>
    <?php
    include 'includes/conexion.php';

    // Verifica la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    $sql = "SELECT 
    f.id_factura,
    CONCAT(p.nombre, ' ', p.apellido) AS nombre_completo,
    f.fecha_emision,
    f.total,
    CASE
        WHEN f.pagada = 1 THEN 'LIQUIDADA'
        WHEN f.pagada = 0 THEN 'ADEUDO'
    END AS estatus
    FROM 
    facturas f
    JOIN 
    pacientes p ON f.id_paciente = p.id_paciente;";

    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Paciente</th><th>Fecha de emision</th><th>Total</th><th>Estatus</th></tr>";
        while($fila = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($fila["id_factura"]) . "</td>";
                echo "<td>" . htmlspecialchars($fila["nombre_completo"]) . "</td>";
                echo "<td>" . htmlspecialchars($fila["fecha_emision"]) . "</td>";
                echo "<td>" . htmlspecialchars($fila["total"]) . "</td>";
                echo "<td>" . htmlspecialchars($fila["estatus"]) . "</td>";
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