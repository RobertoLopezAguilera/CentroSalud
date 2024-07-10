<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicamentos</title>
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
        .a_excel svg {
            vertical-align: middle;
        }
    </style>
</head>
<body>
<?php include 'assets/header.php'; ?>
    <div id="header"></div>
    <h1>Lista de medicamentos en nuestra farmacia</h1>

        <?php
        include 'includes/conexion.php';

        $search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';

        $sql = "SELECT * FROM Medicamentos";
        
        if (!empty($search)) {
            $sql .= " WHERE nombre LIKE '%$search%' OR descripcion LIKE '%$search%'";
        }

        $resultado = $conn->query($sql);

        if ($resultado->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Nombre</th><th>Descripción</th><th>Precio</th></tr>";
            while($fila = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($fila["nombre"]) . "</td>";
                echo "<td>" . htmlspecialchars($fila["descripcion"]) . "</td>";
                echo "<td> $" . htmlspecialchars($fila["precio"]) . "</td>";
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
