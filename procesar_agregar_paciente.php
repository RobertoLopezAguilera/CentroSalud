<?php
include 'includes/conexion.php';
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$habitacion = $_POST['habitacion'];
$CURP = $_POST['CURP'];
$contrasena = $_POST['contrasena'];

$sql = "INSERT INTO Pacientes (nombre, apellido, fecha_nacimiento, direccion, telefono, habitacion, CURP, contrasena) VALUES ('$nombre','$apellido','$fecha_nacimiento','$direccion','$telefono','$habitacion','$CURP','$contrasena')";

if ($conn->query($sql) === TRUE) {
    echo "Nueva área agregada exitosamente.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("Location: pacientes.php");
exit;
?>
