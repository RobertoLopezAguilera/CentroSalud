<?php
include 'includes/conexion.php';
$nombre = $_POST['nombre'];

$sql = "INSERT INTO Areas (nombre) VALUES ('$nombre')";

if ($conn->query($sql) === TRUE) {
    echo "Nueva área agregada exitosamente.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("Location: areas.php");
exit;
?>
