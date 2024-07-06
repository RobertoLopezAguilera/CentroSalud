<?php
include 'includes/conexion.php';
$id = $_GET['id'];

$sql = "DELETE FROM citas WHERE id_cita=$id";

if ($conn->query($sql) === TRUE) {
    echo "Cita eliminada exitosamente.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("Location: citas.php");
exit;
?>