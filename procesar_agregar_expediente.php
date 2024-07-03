<?php
include 'includes/conexion.php';
$id_paciente = $_POST['id_paciente'];
$historial_medico = $_POST['historial_medico'];
$alergias = $_POST['alergias'];
$medicamentos_actuales = $_POST['medicamentos_actuales'];
$antecedentes_familiares = $_POST['antecedentes_familiares'];
$otras_notas = $_POST['otras_notas'];

$sql = "INSERT INTO Expedientes_Medicos (id_paciente, historial_medico, alergias, medicamentos_actuales, antecedentes_familiares, otras_notas) VALUES ('$id_paciente', '$historial_medico', '$alergias', '$medicamentos_actuales', '$antecedentes_familiares', '$otras_notas')";

if ($conn->query($sql) === TRUE) {
    echo "Nuevo expediente médico agregado exitosamente.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("Location: expedientes_medicos.php");
exit;
?>
