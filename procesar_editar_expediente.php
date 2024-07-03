<?php
include 'includes/conexion.php';
$id = $_POST['id'];
$id_paciente = $_POST['id_paciente'];
$historial_medico = $_POST['historial_medico'];
$alergias = $_POST['alergias'];
$medicamentos_actuales = $_POST['medicamentos_actuales'];
$antecedentes_familiares = $_POST['antecedentes_familiares'];
$otras_notas = $_POST['otras_notas'];

$sql = "UPDATE Expedientes_Medicos SET id_paciente='$id_paciente', historial_medico='$historial_medico', alergias='$alergias', medicamentos_actuales='$medicamentos_actuales', antecedentes_familiares='$antecedentes_familiares', otras_notas='$otras_notas' WHERE id_expediente=$id";

if ($conn->query($sql) === TRUE) {
    echo "Expediente médico actualizado exitosamente.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("Location: expedientes_medicos.php");
exit;
?>
