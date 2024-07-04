<?php
include 'includes/conexion.php';

$userType = $_POST['userType'];

if ($userType === 'Personal') {
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseñaPersonal'];
    $sql = "SELECT * FROM Personal WHERE Correo='$correo' AND Contraseña=SHA1('$contraseña')";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        echo "Login exitoso. Bienvenido, Personal!";
        header("Location: personal.php");
    } else {
        echo"$contraseña";
        echo "Correo o contraseña incorrectos.";
    }
} elseif ($userType === 'Paciente') {
    $curp = $_POST['curp'];
    $contraseña = $_POST['contraseñaPaciente'];
    $sql = "SELECT * FROM Pacientes WHERE curp='$curp' AND contraseña=SHA1('$contraseña')";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        echo "Login exitoso. Bienvenido, Paciente!";
        header("Location: pacientes.php");
    } else {
        echo "CURP o contraseña incorrectos.";
    }
}

$conn->close();
?>
