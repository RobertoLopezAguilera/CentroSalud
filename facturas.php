<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facturas Médicas</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'assets/header.php'; ?>
<div id="header"></div>
    <h1>Facturas Médicas</h1>
    <a href="agregar_factura.php" class="button-29">Agregar Factura</a>
    <?php
    include 'includes/conexion.php';

    $sql = "SELECT 
                CONCAT(p.nombre, ' ', p.apellido) AS nombre_paciente,
                fd.id_factura,
                fd.descripcion,
                fd.cantidad,
                fd.precio_unitario,
                fd.subtotal,
                f.total,
                f.fecha_emision,
                CASE 
                    WHEN f.pagada = 1 THEN 'LIQUIDADA'
                    WHEN f.pagada = 0 THEN 'ADEUDO'
                    ELSE 'DESCONOCIDO'  -- Opcional: para manejar otros posibles valores
                END AS Estatus
            FROM 
                facturas f
            JOIN 
                pacientes p ON f.id_paciente = p.id_paciente
            JOIN 
                detalle_factura fd ON f.id_factura = fd.id_factura;";

    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Paciente</th><th>ID Factura Médico</th><th>Descripcion</th><th>Cantidad</th><th>Precio Unitario</th><th>Subtotal</th><th>Total</th><th>Fecha de emision</th><th>Estatus</th><th>Acciones</th></tr>";
        while($fila = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $fila["nombre_paciente"] . "</td>";
            echo "<td>" . $fila["id_factura"] .  "</td>";
            echo "<td>" . $fila["descripcion"] . "</td>";
            echo "<td>" . $fila["cantidad"] . "</td>";
            echo "<td>" . $fila["precio_unitario"] . "</td>";
            echo "<td>" . $fila["subtotal"] . "</td>";
            echo "<td>" . $fila["total"] . "</td>";
            echo "<td>" . $fila["fecha_emision"] . "</td>";
            echo "<td>" . $fila["Estatus"] . "</td>";
            echo "<td>";
            echo "<a class='button-33' href='editar_factura.php?id=" . $fila["id_factura"] . "'>Editar</a>";
            echo "<a class='button-34' href='eliminar_factura.php?id=" . $fila["id_factura"] . "' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este registro?\")'>Eliminar</a>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No se encontraron facturas.";
    }

    $conn->close();
    ?>
    <?php include 'assets/footer.html'; ?>
    <div id="footer"></div>
</body>
</html>