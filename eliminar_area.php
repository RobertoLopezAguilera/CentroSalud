<?php
include 'includes/conexion.php';
$id = $_GET['id'];

$sql = "DELETE FROM Areas WHERE id_area=$id";

if ($conn->query($sql) === TRUE) {
    echo "Área eliminada exitosamente.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("Location: areas.php");
exit;
?>
