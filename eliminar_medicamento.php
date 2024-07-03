<?php
include 'includes/conexion.php';
$id = $_GET['id'];

$sql = "DELETE FROM Medicamentos WHERE id_medicamento=$id";

if ($conn->query($sql) === TRUE) {
    echo "Medicamento eliminado exitosamente.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("Location: medicamentos.php");
exit;
?>
