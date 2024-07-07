<?php
include 'includes/conexion.php';
$id_paciente = $_POST['id_paciente'];
$id_personal = $_POST['id_personal'];
$fecha_emision = isset($_POST['fecha_emision']) ? date('Y-m-d H:i:s', strtotime($_POST['fecha_emision'])) : null;
$observaciones = $_POST['observaciones'];

$id_medicamento = $_POST['id_medicamento'];
$dosis = $_POST['dosis'];


$sqlReceta = "INSERT INTO recetas_medicas (id_paciente, id_personal, fecha_emision, observaciones) 
VALUES ('$id_paciente', '$id_personal', '$fecha_emision', '$observaciones')";

if ($conn->query($sqlReceta) === TRUE) {
    // Obtener el id del último registro insertado
    $id_receta = mysqli_insert_id($conn);

    /*echo "Nueva receta insertada con ID: " . $id_receta;*/

    $sqlRecetaMedicamento = "INSERT INTO receta_medicamento (id_receta,id_medicamento, dosis) 
    VALUES ('$id_receta', '$id_medicamento', '$dosis')";

    /*echo "Nuevo registro creado exitosamente. ID de la receta: " . $id_receta;*/

    $conn->query($sqlRecetaMedicamento);
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("Location: recetas.php");
exit;
?>