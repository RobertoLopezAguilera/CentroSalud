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
    <title>Agregar Cita</title>
</head>
<body>
    <h1>Agregar Cita</h1>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="nombre">Paciente:</label><br>
        <?php
        include 'includes/conexion.php';

        // Verifica la conexión
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        $sql = "SELECT p.id_paciente, concat(p.nombre, ' ', p.apellido) as paciente_completo
            FROM pacientes p
            JOIN citas c ON c.id_paciente = p.id_paciente";

        $resultado = $conn->query($sql);

        if ($resultado->num_rows > 0) {
            echo "<select id='paciente' name='paciente' required>";
            while ($fila = $resultado->fetch_assoc()){
                echo "<option value=". htmlspecialchars($fila["id_paciente"]) .">". htmlspecialchars($fila["paciente_completo"]) ."</option>";
            }
            echo "</select><br><br>";
        } else {
            echo "No se encontraron resultados";
        }
    
        $conn->close();
        ?>

        <label for="nombre">Médico:</label><br>
        <?php
        include 'includes/conexion.php';

        // Verifica la conexión
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        $sql = "SELECT concat(m.nombre, ' ', m.apellido) as medico_completo
			FROM personal m
            WHERE tipo_personal = 'Médico'";

        $resultado = $conn->query($sql);

        if ($resultado->num_rows > 0) {
            echo "<select id='medico' name='medico' required>";
            while ($fila = $resultado->fetch_assoc()){
                echo "<option value=". htmlspecialchars($fila["id_personal"]) .">". htmlspecialchars($fila["medico_completo"]) ."</option>";
            }
            echo "</select><br><br>";
        } else {
            echo "No se encontraron resultados";
        }
    
        $conn->close();
        ?>

        <label for="fecha">Fecha de Cita:</label><br>
        <input type="datetime-local" id="fecha" name="fecha" required><br><br>

        <label for="tipo">Tipo de Cita:</label><br>
        <input type="text" id="tipo" name="tipo" required><br><br>

        <input type="submit" value="Agregar">
    </form>
</body>
</html>
