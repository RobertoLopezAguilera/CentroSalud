<?php
include 'includes/conexion.php';

// Obtener los valores del formulario
$id_detalle = $_POST['id_detalle'];
$id_factura = $_POST['id_factura'];
$descripcion = $_POST['descripcion'];
$cantidad = $_POST['cantidad'];
$precio_unitario = $_POST['precio_unitario'];
$subtotal = $_POST['subtotal'];

// Crear la consulta SQL para actualizar los valores
$sql = "UPDATE detalle_factura SET 
        id_factura = '$id_factura', 
        descripcion = '$descripcion', 
        cantidad = '$cantidad', 
        precio_unitario = '$precio_unitario', 
        subtotal = '$subtotal' 
        WHERE id_detalle = $id_detalle";

// Ejecutar la consulta y comprobar si fue exitosa
if ($conn->query($sql) === TRUE) {
    echo "Detalle de factura actualizado exitosamente.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar la conexión
$conn->close();

// Redirigir a la lista de detalles
header("Location: detalle_factura.php?id=$id_factura");
exit;
?>
