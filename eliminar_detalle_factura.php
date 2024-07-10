<?php
include 'includes/conexion.php';
$id = $_GET['id'];

$sql = "DELETE FROM detalle_factura WHERE id_detalle=$id";

if ($conn->query($sql) === TRUE) {
    echo "Detalle factura eliminada exitosamente.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("Location: detalle_factura.php");
exit;
?>