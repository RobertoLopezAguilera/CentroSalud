<?php
include 'includes/conexion.php';

// Obtener el id del último registro insertado
$id_factura = $_POST['id_factura'];
echo "ID Factura: " . $id_factura;
// Recibir e insertar los detalles de la factura
$descripcion = $_POST['descripcion'];
echo "Descripcion: " . $descripcion;
$cantidad = $_POST['cantidad'];
echo "Cantidad: " . $cantidad;
$precio_unitario = $_POST['precio_unitario'];
echo "Precio Unitario: " . $precio_unitario;
$subtotal = $_POST['subtotal'];
echo "Subtotal: " . $subtotal;

$sqlDetalle = "INSERT INTO detalle_factura (id_factura, descripcion, cantidad, precio_unitario, subtotal) VALUES ('$id_factura', '$descripcion', '$cantidad', '$precio_unitario', '$subtotal')";
if ($conn->query($sqlDetalle) === TRUE) {
    echo "Detalle de factura insertado correctamente.";
} else {
    echo "Error al insertar el detalle de la factura: " . $conn->error;
}

$conn->close();
header("Location: facturas.php");
exit;
?>