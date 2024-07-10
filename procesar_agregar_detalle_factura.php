<?php
include 'includes/conexion.php';

$id_factura = $_POST['id_factura'];
$descripcion = $_POST['descripcion'];
$cantidad = $_POST['cantidad'];
$precio_unitario = $_POST['precio_unitario'];
$subtotal = $_POST['subtotal'];

$sqlDetalle = "INSERT INTO detalle_factura (id_factura, descripcion, cantidad, precio_unitario, subtotal) VALUES ('$id_factura', '$descripcion', '$cantidad', '$precio_unitario', '$subtotal')";
if ($conn->query($sqlDetalle) === TRUE) {
    echo "Detalle de factura insertado correctamente.";
} else {
    echo "Error al insertar el detalle de la factura: " . $conn->error;
}

$sqlUpdateTotal = "
    UPDATE facturas
    SET total = (
        SELECT SUM(subtotal)
        FROM detalle_factura
        WHERE id_factura = '$id_factura'
    )
    WHERE id_factura = '$id_factura'
";

// Ejecutar la consulta
if ($conn->query($sqlUpdateTotal) === TRUE) {
    echo "Total de factura actualizado correctamente.";
} else {
    echo "Error al actualizar el total de la factura: " . $conn->error;
}

$conn->close();
header("Location: facturas.php");
exit;
?>