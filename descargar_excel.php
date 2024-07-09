<?php
include 'includes/conexion.php';

$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="recetas_medicas.xls"');
header('Cache-Control: max-age=0');

echo "Paciente\tPersonal Médico\tFecha Emisión\tObservaciones\tDosis\tMedicamento\n";

$sql = "SELECT 
            p.nombre AS nombre_paciente, 
            p.apellido AS apellido_paciente, 
            pe.nombre AS nombre_personal, 
            pe.apellido AS apellido_personal, 
            r.fecha_emision, 
            r.observaciones, 
            rm.dosis, 
            rm.id_receta,
            m.nombre AS nombre_medicamento
        FROM 
            Recetas_Medicas r
        JOIN 
            Pacientes p ON r.id_paciente = p.id_paciente
        JOIN 
            Personal pe ON r.id_personal = pe.id_personal
        JOIN 
            Receta_Medicamento rm ON r.id_receta = rm.id_receta
        JOIN 
            Medicamentos m ON rm.id_medicamento = m.id_medicamento";

if (!empty($search)) {
    $sql .= " WHERE p.nombre LIKE '%$search%' 
              OR p.apellido LIKE '%$search%' 
              OR m.nombre LIKE '%$search%' 
              OR pe.nombre LIKE '%$search%'
              OR pe.apellido LIKE '%$search%'";
}

$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
    while($fila = $resultado->fetch_assoc()) {
        echo htmlspecialchars($fila["nombre_paciente"]) . "\t" . 
             htmlspecialchars($fila["apellido_paciente"]) . "\t" . 
             htmlspecialchars($fila["nombre_personal"]) . "\t" . 
             htmlspecialchars($fila["apellido_personal"]) . "\t" . 
             htmlspecialchars($fila["fecha_emision"]) . "\t" . 
             htmlspecialchars($fila["observaciones"]) . "\t" . 
             htmlspecialchars($fila["dosis"]) . "\t" . 
             htmlspecialchars($fila["nombre_medicamento"]) . "\n";
    }
} else {
    echo "No se encontraron recetas.";
}

$conn->close();
?>
