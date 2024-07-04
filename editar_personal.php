<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'includes/conexion.php';

    $id_personal = $_POST['id_personal'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $tipo_personal = $_POST['tipo_personal'];
    $especialidad = $_POST['especialidad'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];

    $sql = "UPDATE Personal SET nombre='$nombre', apellido='$apellido', tipo_personal='$tipo_personal', especialidad='$especialidad', Correo='$correo', telefono='$telefono' WHERE id_personal=$id_personal";

    if ($conn->query($sql) === TRUE) {
        header("Location: personal.php");

    } else {
        echo "Error al actualizar los datos: " . $conn->error;
    }
    $conn->close();
} else {
    $id_personal = $_GET['id'];
    include 'includes/conexion.php';
    $sql = "SELECT * FROM Personal WHERE id_personal=$id_personal";

    $resultado = $conn->query($sql);
    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        $nombre = $fila['nombre'];
        $apellido = $fila['apellido'];
        $tipo_personal = $fila['tipo_personal'];
        $especialidad = $fila['especialidad'];
        $correo = $fila['Correo'];
        $telefono = $fila['telefono'];
    } else {
        echo "No se encontró el registro.";
        exit; 
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Personal</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'assets/header.html'; ?>
    <div id="header"></div>
    <h1>Editar Datos de Personal</h1>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="id_personal" value="<?php echo $id_personal; ?>">
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>"><br><br>
        <label for="apellido">Apellido:</label><br>
        <input type="text" id="apellido" name="apellido" value="<?php echo $apellido; ?>"><br><br>
        <label for="tipo_personal">Tipo de Personal:</label><br>
        <input type="text" id="tipo_personal" name="tipo_personal" value="<?php echo $tipo_personal; ?>"><br><br>
        <label for="especialidad">Especialidad:</label><br>
        <input type="text" id="especialidad" name="especialidad" value="<?php echo $especialidad; ?>"><br><br>
        <label for="correo">Correo Electrónico:</label><br>
        <input type="email" id="correo" name="correo" value="<?php echo $correo; ?>"><br><br>
        <label for="telefono">Teléfono:</label><br>
        <input type="text" id="telefono" name="telefono" value="<?php echo $telefono; ?>"><br><br>
        <div class="inputdiv">
            <input type="submit" value="Actualizar">
            <a href="personal.php">Volver a la lista de personal</a>
        </div>
    </form>
    <?php include 'assets/footer.html'; ?>
    <div id="footer"></div>
</body>
</html>
