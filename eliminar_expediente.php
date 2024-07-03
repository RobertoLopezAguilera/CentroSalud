<?php
include 'includes/conexion.php';
$id = $_GET['id'];

$sql = "DELETE FROM Expedientes_Medicos WHERE id_expediente=$id";

if ($conn->query($sql) === TRUE) {
    echo "Expediente médico eliminado exitosamente.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("Location: expedientes_medicos.php");
exit;
?>
