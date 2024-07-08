<?php
include 'includes/conexion.php';
$id = $_GET['id'];

$sql = "DELETE FROM facturas WHERE id_factura=$id";

//Eliminar detalles de la factura

if ($conn->query($sql) === TRUE) {
    echo "facturas eliminada exitosamente.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("Location: facturas.php");
exit;
?>