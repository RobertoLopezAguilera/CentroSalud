<?php
include 'includes/conexion.php';
$id = $_GET['id'];

$sqlFacturas = "DELETE FROM detalle_factura WHERE id_detalle=$id";

if ($conn->query($sqlFacturas) === TRUE) {
    echo "Detalle factura eliminada exitosamente.";
} else {
    echo "Error: " . $sqlFacturas . "<br>" . $conn->error;
}

$conn->close();
header("Location: detalle_factura.php");
exit;
?>