<?php
include 'includes/conexion.php';

$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';

$sql = "SELECT Equipos_Medicos.id_equipo, Equipos_Medicos.nombre_equipo, Equipos_Medicos.estado, Habitaciones.numero AS numero_habitacion, Areas.nombre AS nombre_area
        FROM Equipos_Medicos
        JOIN Habitaciones ON Equipos_Medicos.id_habitacion = Habitaciones.id_habitacion
        JOIN Areas ON Habitaciones.id_area = Areas.id_area";

if (!empty($search)) {
    $sql .= " WHERE Equipos_Medicos.nombre_equipo LIKE '%$search%' OR Areas.nombre LIKE '%$search%'";
}

$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="equipos_medicos_hospital.xls"');
    header('Cache-Control: max-age=0');

    echo "ID\tNombre del Equipo\tEstado\tHabitación\tÁrea\n";

    while ($row = $resultado->fetch_assoc()) {
        $estado = $row['estado'] ? 'Operativo' : 'No operativo';
        echo $row['id_equipo'] . "\t" . 
             $row['nombre_equipo'] . "\t" . 
             $estado . "\t" . 
             $row['numero_habitacion'] . "\t" . 
             $row['nombre_area'] . "\n";
    }
} else {
    echo "No se encontraron resultados";
}

$conn->close();
?>
