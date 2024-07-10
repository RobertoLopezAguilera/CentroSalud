<?php
session_start(); // Asegúrate de iniciar la sesión

include 'includes/conexion.php';

// Obtener los datos del formulario POST
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$fecha_nacimiento = $_POST['fech_nac'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$CURP = $_POST['curp'];
$contraseñaPaciente = sha1($_POST['contraseñaPaciente']);

// Insertar los datos en la base de datos
$sql = "INSERT INTO Pacientes (nombre, apellido, fecha_nacimiento, direccion, telefono, id_cama, CURP, contraseña) 
        VALUES ('$nombre', '$apellido', '$fecha_nacimiento', '$direccion', '$telefono', '11', '$CURP', '$contraseñaPaciente')";

if ($conn->query($sql) === TRUE) {
    echo "Nuevo paciente agregado exitosamente.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

// Verificar si hay una sesión abierta
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
// Redirigir a la página de pacientes
header("Location: pacientes.php");
exit;
?>
