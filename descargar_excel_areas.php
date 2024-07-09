<?php
include 'includes/conexion.php';

$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';

$sql = "SELECT * FROM Areas";

if (!empty($search)) {
    $sql .= " WHERE nombre LIKE '%$search%'";
}

$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="areas_hospital.xls"');
    header('Cache-Control: max-age=0');

    echo "ID\tNombre\n";

    while ($row = $resultado->fetch_assoc()) {
        echo $row['id_area'] . "\t" . 
             $row['nombre'] . "\n";
    }
} else {
    echo "No se encontraron resultados";
}

$conn->close();
?>
