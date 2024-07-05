<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'includes/conexion.php';

    $id_paciente = $_POST['id_paciente'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $CURP = $_POST['curp'];
    /*$contrasena = sha1($_POST['contrasenia']);*/

    $sql = "UPDATE pacientes SET nombre='$nombre', apellido='$apellido', fecha_nacimiento='$fecha_nacimiento', direccion='$direccion', 
    telefono='$telefono', CURP='$CURP' WHERE id_paciente=$id_paciente";

    if ($conn->query($sql) === TRUE) {
        header("Location: pacientes.php");

    } else {
        echo "Error al actualizar los datos: " . $conn->error;
    }
    $conn->close();
} else {
    $id_paciente = $_GET['id'];
    include 'includes/conexion.php';
    $sql = "SELECT * FROM pacientes WHERE id_paciente=$id_paciente";

    $resultado = $conn->query($sql);
    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        $nombre = $fila['nombre'];
        $apellido = $fila['apellido'];
        $fecha_nacimiento = $fila['fecha_nacimiento'];
        $direccion = $fila['direccion'];
        $telefono = $fila['telefono'];
        $CURP = $fila['CURP'];
        
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
    <title>Editar Paciente</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'assets/header.php'; ?>
<div id="header"></div>
    <h1>Editar Datos del Paciente</h1>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="id_paciente" value="<?php echo $id_paciente; ?>">
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>"><br>
        <label for="apellido">Apellido:</label><br>
        <input type="text" id="apellido" name="apellido" value="<?php echo $apellido; ?>"><br>
        <label for="fecha_nacimiento">Fecha de nacimiento:</label><br>
        <input type="text" id="fech_nac" name="fecha_nacimiento" value="<?php echo $fecha_nacimiento; ?>"><br>
        <label for="direccion">Direccion:</label><br>
        <input type="text" id="direccion" name="direccion" value="<?php echo $direccion; ?>"><br>
        <label for="curp">CURP:</label><br>
        <input type="text" id="curp" name="curp" value="<?php echo $CURP; ?>"><br>
        <label for="telefono">Teléfono:</label><br>
        <input type="text" id="telefono" name="telefono" value="<?php echo $telefono; ?>"><br>
        <label for="id_area">Area:</label>
        <select id="id_area" name="id_area" required>
            <?php
            $sql_areas = "SELECT * FROM Areas";
            $resultado_areas = $conn->query($sql_areas);
            while ($fila_area = $resultado_areas->fetch_assoc()) {
                $selected = ($fila_area["id_area"] == $fila["id_area"]) ? "selected" : "";
                echo "<option value='" . $fila_area["id_area"] . "' $selected>" . $fila_area["nombre"] . "</option>";
            }
            ?> 
        </select><br>
        <div class="inputdiv">
            <input type="submit" value="Actualizar">
            <a href="pacientes.php">Volver a la lista de pacientes</a>
        </div>
    </form>
    <?php include 'assets/footer.html'; ?>
    <div id="footer"></div>

</body>
</html>