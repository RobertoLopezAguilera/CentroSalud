<?php
include 'includes/conexion.php';

$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';

$sqlFacturas = "SELECT c.id_cita, p.nombre, p.apellido, c.fecha_hora, c.tipo 
        FROM citas c 
        JOIN pacientes p ON c.id_paciente = p.id_paciente";

if (!empty($search)) {
    $sqlFacturas .= " WHERE p.nombre LIKE '%$search%'";
}

$resultado = $conn->query($sqlFacturas);

if ($resultado->num_rows > 0) {
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename=\"citas_hospital.xls\"');
    header('Cache-Control: max-age=0');

    echo "ID_Cita\tNombre\tApellido\tFecha_Hora\tTipo\n";

    while ($row = $resultado->fetch_assoc()) {
        echo $row['id_cita'] . "\t" . 
             $row['nombre'] . "\t" . 
             $row['apellido'] . "\t" . 
             $row['fecha_hora'] . "\t" . 
             $row['tipo'] . "\n";
    }
} else {
    echo "No se encontraron resultados";
}

$conn->close();
?>
