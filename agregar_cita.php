<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Cita Medica</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'assets/header.php'; ?>
    <div id="header"></div>

    <h1>Agregar Cita Medica</h1>

    <?php
    // Incluir archivo de conexión a la base de datos
    include 'includes/conexion.php';

    // Consulta SQL para obtener los nombres completos de los pacientes
    $sql = "SELECT CONCAT(nombre, ' ', apellido) AS nombre_completo FROM Pacientes;";
    $resultado_pacientes = $conn->query($sql);

    $sqlPersonal = "SELECT CONCAT(nombre, ' ', apellido) AS nombre_personal FROM personal;";
    $resultado_personal = $conn->query($sqlPersonal);
    ?>

    <form action="procesar_agregar_cita.php" method="post">
        <label for="id_paciente">Paciente:</label>
            <select id="id_paciente" name="id_paciente" required>
                <?php                        
                    // Mostrar opciones de los pacientes
                     while ($fila = $resultado_pacientes->fetch_assoc()) {
                     $selected = ($fila['id_paciente'] == $pa['id_paciente']) ? 'selected' : '';
                    echo "<option value='" . $fila['id_paciente'] . "' $selected>" . $fila['nombre_completo'] . "</option>";
                    }
                    ?>
            </select>
            <input type="hidden" name="id_paciente" value="<?php echo $cita['id_paciente']; ?>">

        <label for="id_personal">Medico:</label>
        <select id="id_personal" name="id_personal" required>
                <?php                        
                    // Mostrar opciones del personal
                     while ($fila = $resultado_personal->fetch_assoc()) {
                     $selected = ($fila['id_personal'] == $pa['id_personal']) ? 'selected' : '';
                    echo "<option value='" . $fila['id_personal'] . "' $selected>" . $fila['nombre_personal'] . "</option>";
                    }
                    ?>
            </select>
        <input type="hidden" name="id_personal" value="<?php echo $cita['id_personal']; ?>">

        <label for="fecha_hora">Fecha de cita:</label>
        <input type="datetime-local" id="fecha_hora" name="fecha_hora" required><br>

        <label for="tipo">Tipo de cita:</label>
        <input type="text" id="tipo" name="tipo" required><br>

        <div class="inputdiv">
            <input type="submit" value="Agregar">
            <a href="pacientes.php">Volver a la lista de citas medicas</a>
        </div>
    </form>

    <?php include 'assets/footer.html'; ?>
    <div id="footer"></div>
</body>
</html>