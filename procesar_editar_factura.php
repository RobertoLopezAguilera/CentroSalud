<?php
include 'includes/conexion.php';
$id_factura = $_POST['id_factura'];
$id_paciente = $_POST['id_paciente'];
$fecha_emision = $_POST['fecha_emision'];
$total = $_POST['total'];
$pagada = $_POST['pagada'];

$sql = "UPDATE facturas SET id_paciente='$id_paciente',pagada = '$pagada'
 WHERE id_factura=$id_factura";

if ($conn->query($sql) === TRUE) {
    echo "Facturas actualizada exitosamente.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("Location: facturas.php");
exit;
?>