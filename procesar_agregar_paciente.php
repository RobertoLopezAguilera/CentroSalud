<?php
include 'includes/conexion.php';
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$fecha_nacimiento = $_POST['fech_nac'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$CURP = $_POST['curp'];
$contrasena = sha1($_POST['contrasenia']);

$sql = "INSERT INTO Pacientes (nombre, apellido, fecha_nacimiento, direccion, telefono, id_cama, CURP, contraseña) VALUES ('$nombre','$apellido','$fecha_nacimiento','$direccion','$telefono','11','$CURP','$contrasena')";

if ($conn->query($sql) === TRUE) {
    echo "Nueva área agregada exitosamente.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("Location: pacientes.php");
exit;
?>
