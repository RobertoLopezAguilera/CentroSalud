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
    <link rel="stylesheet" href="css/style.css">
    <title>Agregar Personal</title>
</head>
<body>
    <?php include 'assets/header.php'; ?>
    <div id="header"></div>

    <h1>Agregar Personal</h1>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" required>

        <label for="tipo_personal">Tipo de Personal:</label>
        <input type="text" id="tipo_personal" name="tipo_personal" required><br>

        <label for="especialidad">Especialidad:</label>
        <input type="text" id="especialidad" name="especialidad"><br>

        <label for="correo">Correo:</label>
        <input type="email" id="correo" name="correo" required><br>

        <label for="contraseña">Contraseña:</label>
        <input type="password" id="contraseña" name="contraseña" required><br>

        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="telefono" required><br>

        <div class="inputdiv">
            <input type="submit" value="Agregar">
            <a href="personal.php">Volver a la lista de personal</a>
        </div>
    </form>
    
    <?php include 'assets/footer.html'; ?>
    <div id="footer"></div>
</body>
</html>
