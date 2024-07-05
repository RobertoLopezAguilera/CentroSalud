<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recetas Medicas</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'assets/header.php'; ?>
<div id="header"></div>
    <h1>Recetas Medicas</h1>
    <?php
    include 'includes/conexion.php';

    // Verifica la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    $sql = "SELECT r.id_receta,
        concat(p.nombre, ' ', p.apellido) as paciente_completo,
        concat(m.nombre, ' ', m.apellido) as medico_completo,
        r.fecha_emision,
        r.observaciones
        FROM recetas_medicas r
        JOIN pacientes p ON r.id_paciente = p.id_paciente
        JOIN personal m ON r.id_personal = m.id_personal
        WHERE r.id_paciente = p.id_paciente 
        AND r.id_personal = m.id_personal;";

    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Paciente</th><th>Medico</th><th>Fecha de Emision</th><th>Observaciones</th></tr>";
        while($fila = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($fila["id_receta"]) . "</td>";
                echo "<td>" . htmlspecialchars($fila["paciente_completo"]) . "</td>";
                echo "<td>" . htmlspecialchars($fila["medico_completo"]) . "</td>";
                echo "<td>" . htmlspecialchars($fila["fecha_emision"]) . "</td>";
                echo "<td>" . htmlspecialchars($fila["observaciones"]) . "</td>";
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