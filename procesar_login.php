<?php
session_start();
include 'includes/conexion.php';

$userType = $_POST['userType'];

if ($userType === 'Personal') {
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseñaPersonal'];
    $sql = "SELECT * FROM Personal WHERE Correo='$correo' AND Contraseña=SHA1('$contraseña')";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();
        $_SESSION['userName'] = $row['nombre'];
        $_SESSION['userType'] = 'Personal';
        header("Location: index.php");
        exit();
    } else {
        echo "Correo o contraseña incorrectos.";
    }
} elseif ($userType === 'Paciente') {
    $curp = $_POST['curp'];
    $contraseña = $_POST['contraseñaPaciente'];
    $sql = "SELECT * FROM Pacientes WHERE curp='$curp' AND contraseña=SHA1('$contraseña')";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();
        $_SESSION['userName'] = $row['nombre'];
        $_SESSION['userType'] = 'Paciente';
        header("Location: index.php");
        exit();
    } else {
        echo "CURP o contraseña incorrectos.";
    }
}

$conn->close();
?>
