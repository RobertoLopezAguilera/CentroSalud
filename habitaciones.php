<?php
include 'assets/header.php';

if (!isset($_SESSION['userName']) || $_SESSION['userType'] !== 'Personal') {
    $errorMessage = "No tienes permiso para acceder a esta página.";
} else {
    $userName = $_SESSION['userName'];

    if ($userName !== "DR. Roberto") {
        $errorMessage = "No tienes permiso para ver todas las habitaciones.";
    }
}

$id_area = isset($_GET['id_area']) ? intval($_GET['id_area']) : 0;

$nombre_area = "";
if ($id_area > 0) {
    include 'includes/conexion.php';
    $sql = "SELECT nombre FROM Areas WHERE id_area = $id_area";
    $resultado = $conn->query($sql);
    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        $nombre_area = htmlspecialchars($fila['nombre']);
    }
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo empty($nombre_area) ? 'Habitaciones del Hospital' : 'Habitaciones de ' . $nombre_area; ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php if (isset($errorMessage)): ?>
        <div class="error"><?php echo $errorMessage; ?></div>
    <?php else: ?>
        <div id="header"></div>
        <h1><?php echo empty($nombre_area) ? 'Habitaciones del Hospital' : 'Habitaciones de ' . $nombre_area; ?></h1>
        <a href="agregar_habitacion.php" class="button-29">Agregar Habitación<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="-2 2 32 32"><path fill="#ffffff" d="M25 16h-8a2 2 0 0 0-2 2v6H4V14H2v16h2v-4h24v4h2v-9a5.006 5.006 0 0 0-5-5m3 8H17v-6h8a3.003 3.003 0 0 1 3 3Z"/><path fill="#ffffff" d="M9.5 17A1.5 1.5 0 1 1 8 18.5A1.5 1.5 0 0 1 9.5 17m0-2a3.5 3.5 0 1 0 3.5 3.5A3.5 3.5 0 0 0 9.5 15M21 6h-4V2h-2v4h-4v2h4v4h2V8h4z"/></svg> </a>
        <?php
        include 'includes/conexion.php';
        $sql = "SELECT Habitaciones.id_habitacion, Habitaciones.numero, Habitaciones.tipo, Habitaciones.estado, Habitaciones.costo, Areas.nombre AS nombre_area FROM Habitaciones JOIN Areas ON Habitaciones.id_area = Areas.id_area";

        // Si se proporciona un ID de área válido, filtrar las habitaciones por ese ID de área
        if ($id_area > 0) {
            $sql .= " WHERE Habitaciones.id_area = $id_area";
        }

        $resultado = $conn->query($sql);
        if ($resultado->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Número</th><th>Tipo</th><th>Estado</th><th>Costo</th><th>Área</th><th>Acciones</th></tr>";
            while($fila = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $fila["id_habitacion"] . "</td>";
                echo "<td>" . $fila["numero"] . "</td>";
                echo "<td>" . $fila["tipo"] . "</td>";
                echo "<td>" . $fila["estado"] . "</td>";
                echo "<td>" . $fila["costo"] . "</td>";
                echo "<td>" . $fila["nombre_area"] . "</td>";
                echo "<td>";
                echo "<a class='button-33' href='editar_habitacion.php?id=" . $fila["id_habitacion"] . "'>Editar</a>";
                echo "<a class='button-34' href='eliminar_habitacion.php?id=" . $fila["id_habitacion"] . "' onclick='return confirm(\"¿Estás seguro de que deseas eliminar esta habitación?\")'>Eliminar</a>";
                echo "<a class='button-29' href='camas.php?id_habitacion=" . htmlspecialchars($fila["id_habitacion"]) . "'>Ver Camas</a>";
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
    <?php endif; ?>
</body>
</html>
