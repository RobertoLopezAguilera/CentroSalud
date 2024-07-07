<?php
include 'includes/conexion.php';
$id = $_POST['id'];
$estado = $_POST['estado'];

$sql = "UPDATE camas SET estado='$estado'
WHERE id_cama=$id";

if ($conn->query($sql) === TRUE) {
    echo "Cama actualizada exitosamente.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("Location: camas.php");
exit;
?>