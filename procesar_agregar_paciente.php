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

// Verificar si la CURP ya está registrada
$sql_verificar_curp = "SELECT * FROM Pacientes WHERE CURP = '$CURP'";
$resultado = $conn->query($sql_verificar_curp);

if ($resultado->num_rows > 0) {
    // Mostrar mensaje de error en la página agregar_paciente.php usando JavaScript
    $_SESSION['error_message'] = "La CURP ya está registrada.";
    header("Location: agregar_paciente.php");
    exit;
} else {
    // Insertar los datos en la base de datos
    $sql_insertar = "INSERT INTO Pacientes (nombre, apellido, fecha_nacimiento, direccion, telefono, id_cama, CURP, contraseña) 
                     VALUES ('$nombre', '$apellido', '$fecha_nacimiento', '$direccion', '$telefono', '11', '$CURP', '$contraseñaPaciente')";

    if ($conn->query($sql_insertar) === TRUE) {
        // Redirigir al usuario a login.php después de insertar correctamente
        header("Location: login.php");
        exit;
    } else {
        echo "Error: " . $sql_insertar . "<br>" . $conn->error;
    }
}

$conn->close();
?>
