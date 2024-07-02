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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Personal</title>
</head>
<body>
    <h1>Agregar Personal</h1>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="apellido">Apellido:</label><br>
        <input type="text" id="apellido" name="apellido" required><br><br>

        <label for="tipo_personal">Tipo de Personal:</label><br>
        <input type="text" id="tipo_personal" name="tipo_personal" required><br><br>

        <label for="especialidad">Especialidad:</label><br>
        <input type="text" id="especialidad" name="especialidad"><br><br>

        <label for="correo">Correo:</label><br>
        <input type="email" id="correo" name="correo" required><br><br>

        <label for="contraseña">Contraseña:</label><br>
        <input type="password" id="contraseña" name="contraseña" required><br><br>

        <label for="telefono">Teléfono:</label><br>
        <input type="text" id="telefono" name="telefono" required><br><br>

        <input type="submit" value="Agregar">
    </form>
</body>
</html>
