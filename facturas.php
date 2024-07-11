<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facturas Médicas</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .search-form {
            display: flex;
            align-items: center;
        }
        .search-form input[type="text"] {
            margin-right: 10px;
        }
        .button-29 {
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <?php include 'assets/header.php'; ?>
    <div id="header"></div>

    <h1>Facturas Médicas</h1>
    <div class="actions">
        <a href="agregar_factura.php" class="button-29">Agregar Factura</a>
        <form method="GET" action="facturas.php" class="search-form">
            <input type="text" name="search" placeholder="Buscar por nombre de paciente" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            <button type="submit" class="button-29">Buscar</button>
            <button type="button" class="button-29" onclick="window.location.href='facturas.php'">Borrar</button>
        </form>
        <a href="descargar_excel_facturas.php?search=<?php echo isset($_GET['search']) ? urlencode($_GET['search']) : ''; ?>" class="button-29">Descargar Excel</a>
    </div>
    <?php
    include 'includes/conexion.php';

    // Verifica la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    $search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
    $sql = "SELECT 
                f.id_factura,
                CONCAT(p.nombre, ' ', p.apellido) AS nombre_paciente,
                f.fecha_emision,
                f.total,
                CASE 
                    WHEN f.pagada = 1 THEN 'LIQUIDADA'
                    WHEN f.pagada = 0 THEN 'ADEUDO'
                    ELSE 'DESCONOCIDO'  -- Opcional: para manejar otros posibles valores
                END AS Estatus
            FROM 
                facturas f
            JOIN 
                pacientes p ON f.id_paciente = p.id_paciente
            WHERE (p.nombre LIKE '%$search%' OR p.apellido LIKE '%$search%');";

    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID Factura</th><th>Paciente</th><th>Fecha de emision</th><th>Total</th><th>Estatus</th><th>Acciones</th></tr>";
        while($fila = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($fila["id_factura"]) .  "</td>";
            echo "<td>" . htmlspecialchars($fila["nombre_paciente"]) . "</td>";
            echo "<td>" . htmlspecialchars($fila["fecha_emision"]) . "</td>";
            echo "<td>" . htmlspecialchars($fila["total"]) . "</td>";
            echo "<td>" . htmlspecialchars($fila["Estatus"]) . "</td>";
            echo "<td>";
            echo "<a class='button-33' href='detalle_factura.php?id=" . htmlspecialchars($fila["id_factura"]) . "'>Detalles</a>";
            echo "<a class='button-33' href='editar_factura.php?id=" . htmlspecialchars($fila["id_factura"]) . "'>Editar</a>";
            echo "<a class='button-34' href='eliminar_factura.php?id=" . htmlspecialchars($fila["id_factura"]) . "' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este registro?\")'>Eliminar</a>";
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
