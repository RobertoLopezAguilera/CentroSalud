<?php
include 'includes/conexion.php';

$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';

$sql = "SELECT * FROM Personal";

if (!empty($search)) {
    $sql .= " WHERE nombre LIKE '%$search%' 
              OR apellido LIKE '%$search%' 
              OR especialidad LIKE '%$search%' 
              OR tipo_personal LIKE '%$search%'";
}

$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="personal.xls"');
    header('Cache-Control: max-age=0');

    echo "ID\tNombre\tApellido\tTipo de Personal\tEspecialidad\tCorreo\tTeléfono\n";

    while ($row = $resultado->fetch_assoc()) {
        echo $row['id_personal'] . "\t" . 
             $row['nombre'] . "\t" . 
             $row['apellido'] . "\t" . 
             $row['tipo_personal'] . "\t" . 
             $row['especialidad'] . "\t" . 
             $row['Correo'] . "\t" . 
             $row['telefono'] . "\n";
    }
} else {
    echo "No se encontraron resultados";
}

$conn->close();
?>
