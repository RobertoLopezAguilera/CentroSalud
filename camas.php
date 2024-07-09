<?php
include 'assets/header.php';

if (!isset($_SESSION['userName']) || $_SESSION['userType'] !== 'Personal') {
    $errorMessage = "No tienes permiso para acceder a esta página.";
} else {
    $userName = $_SESSION['userName'];
    if ($userName !== "DR. Roberto Lopez") {
        $errorMessage = "No tienes permiso para acceder a esta página.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Camas</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include 'assets/header.php'; ?>
    <div id="header"></div>

    <h1>Camas del hospital</h1>
    <a href="agregar_cama.php" class="button-29">Agregar Cama</a>
    <?php
    include 'includes/conexion.php';
    $sql = "SELECT 
    camas.id_cama,
    camas.numero_cama,
    camas.estado,
    habitaciones.numero as Numero_habitacion
    FROM 
        camas
    JOIN 
    habitaciones ON camas.id_habitacion = habitaciones.id_habitacion;";

    $resultado = $conn->query($sql);
    if ($resultado->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Numero de Cama</th><th>Estado</th><th>Numero de Habitacion</th></tr>";
        while($fila = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $fila["id_cama"] . "</td>";
            echo "<td>" . $fila["numero_cama"] . "</td>";
            echo "<td>" . $fila["estado"] . "</td>";
            echo "<td>" . $fila["Numero_habitacion"] . "</td>";
            echo "<td>";
            echo "<a class='button-33' href='editar_cama.php?id=" . $fila["id_cama"] . "'>Editar</a>";
            echo "<a class='button-34' href='eliminar_cama.php?id=" . $fila["id_cama"] . "' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este registro?\")'>Eliminar</a>";
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