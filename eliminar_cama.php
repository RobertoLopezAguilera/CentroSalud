<?php
include 'includes/conexion.php';
$id = $_GET['id'];

$sql = "DELETE FROM camas WHERE id_cama=$id";

if ($conn->query($sql) === TRUE) {
    echo "Cama eliminada exitosamente.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("Location: camas.php");
exit;
?>