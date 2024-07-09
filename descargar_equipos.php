<?php
include 'includes/conexion.php';

if (!isset($_SESSION['userName']) || $_SESSION['userType'] !== 'Personal') {
    die("No tienes permiso para acceder a esta página.");
}

$sql = "SELECT Equipos_Medicos.id_equipo, Equipos_Medicos.nombre_equipo, Equipos_Medicos.estado, Habitaciones.numero AS numero_habitacion, Areas.nombre AS nombre_area
        FROM Equipos_Medicos 
        JOIN Habitaciones ON Equipos_Medicos.id_habitacion = Habitaciones.id_habitacion 
        JOIN Areas ON Habitaciones.id_area = Areas.id_area";

if (!empty($_GET['search'])) {
    $search = $conn->real_escape_string($_GET['search']);
    $sql .= " WHERE Equipos_Medicos.nombre_equipo LIKE '%$search%' OR Areas.nombre LIKE '%$search%'";
}

$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="equipos_medicos.xls"');

    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Nombre del Equipo</th><th>Estado</th><th>Habitación</th><th>Área</th></tr>";
    while ($fila = $resultado->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $fila["id_equipo"] . "</td>";
        echo "<td>" . htmlspecialchars($fila["nombre_equipo"]) . "</td>";
        echo "<td>" . ($fila["estado"] ? 'Operativo' : 'No operativo') . "</td>";
        echo "<td>" . htmlspecialchars($fila["numero_habitacion"]) . "</td>";
        echo "<td>" . htmlspecialchars($fila["nombre_area"]) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No se encontraron resultados";
}

$conn->close();
?>
