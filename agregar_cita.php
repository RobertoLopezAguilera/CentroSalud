<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Cita</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'assets/header.php'; ?>
    <div id="header"></div>

    <h1>Agregar Citas</h1>
    <form action="procesar_agregar_cita.php" method="post">

    <label for="id_paicente">Paciente:</label>
        <select id="id_paicente" name="id_paicente" required>
            <?php
            include 'includes/conexion.php';
            $sql = "SELECT CONCAT(p.nombre,' ',p.apellido) as nombre_paciente,
            p.id_paciente
            FROM citas c
            JOIN pacientes p ON c.id_paciente = p.id_paciente
            WHERE c.id_paciente = p.id_paciente";
            $resultado = $conn->query($sql);
            while ($fila = $resultado->fetch_assoc()) {
                echo "<option value='" . $fila["id_paciente"] . "'>" . $fila["nombre_paciente"] . "</option>";
            }
            ?>
    </select><br>

    <label for="id_personal">Medico:</label>
        <select id="id_personal" name="id_personal" required>
            <?php
            include 'includes/conexion.php';
            $sql = "SELECT CONCAT(p.nombre,' ',p.apellido) as nombre_personal
            FROM citas c
            JOIN personal p ON c.id_personal = p.id_personal
            WHERE c.id_personal = p.id_personal";
            $resultado = $conn->query($sql);
            while ($fila = $resultado->fetch_assoc()) {
                echo "<option value='" . $fila["id_personal"] . "'>" . $fila["nombre_personal"] . "</option>";
            }
            ?>
    </select><br>

        <label for="fecha_hora">Fecha de cita:</label>
        <input type="datetime-local" id="fecha_hora" name="fecha_hora" required><br>

        <label for="tipo">Tipo de cita:</label>
        <input type="text" id="tipo" name="tipo" required><br>

        <div class="inputdiv">
            <input type="submit" value="Agregar">
            <a href="habitaciones.php">Volver a la lista de habitaciones</a>
        </div>
    </form>

    <?php include 'assets/footer.html'; ?>
    <div id="footer"></div>
</body>
</html>