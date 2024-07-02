<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citas</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Citas Medicas</h1>
    <?php
    include 'includes/conexion.php';

    // Verifica la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    $sql = "SELECT * from citas;";

    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Paciente</th><th>Medico</th><th>Fecha de Cita</th><th>Tipo de Cita</th></tr>";
        while($fila = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($fila["id_cita"]) . "</td>";
                echo "<td>" . htmlspecialchars($fila["id_paciente"]) . "</td>";
                echo "<td>" . htmlspecialchars($fila["id_personal"]) . "</td>";
                echo "<td>" . htmlspecialchars($fila["fecha_hora"]) . "</td>";
                echo "<td>" . htmlspecialchars($fila["tipo"]) . "</td>";
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
</body>
</html>