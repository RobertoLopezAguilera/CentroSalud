<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'includes/conexion.php';

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $tipo_personal = $_POST['tipo_personal'];
    $especialidad = $_POST['especialidad'];
    $correo = $_POST['correo'];
    $contraseña = sha1($_POST['contraseña']);
    $telefono = $_POST['telefono'];

    $sql = "INSERT INTO Personal (nombre, apellido, tipo_personal, especialidad, correo, contraseña, telefono)
            VALUES ('$nombre', '$apellido', '$tipo_personal', '$especialidad', '$correo', '$contraseña', '$telefono')";

    if ($conn->query($sql) === TRUE) {
        header("Location: personal.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

?>