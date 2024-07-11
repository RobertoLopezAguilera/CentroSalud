<?php
include 'includes/conexion.php';
$id = $_GET['id'];

$sqlDetalle = "DELETE FROM detalle_factura WHERE id_factura=$id";
$sqlFacturas = "DELETE FROM facturas WHERE id_factura=$id";

//Eliminar detalles de la factura
if ($conn->query($sqlDetalle) === TRUE) {
    echo "detalles de facturas eliminada exitosamente.";
} else {
    echo "Error: " . $sqlDetalle . "<br>" . $conn->error;
}

if ($conn->query($sqlFacturas) === TRUE) {
    echo "facturas eliminada exitosamente.";
} else {
    echo "Error: " . $sqlFacturas . "<br>" . $conn->error;
}

$conn->close();
header("Location: facturas.php");
exit;
?>