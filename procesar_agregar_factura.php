<?php
include 'includes/conexion.php';
$id_paciente = $_POST['id_paciente'];
$fecha_emision = isset($_POST['fecha_emision']) ? date('Y-m-d H:i:s', strtotime($_POST['fecha_emision'])) : null;

$sqlFactura = "INSERT INTO facturas (id_paciente, fecha_emision, total, pagada) 
VALUES ('$id_paciente', '$fecha_emision', '0.00','0')";

if ($conn->query($sqlFactura) === TRUE) {
    // Obtener el id del último registro insertado
    $id_factura = mysqli_insert_id($conn);

    echo "Nueva factura insertada con ID: " . $id_factura;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("Location: facturas.php");
exit;
?>