<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Agregar Receta Medica</title>
</head>
<body>
    <?php include 'assets/header.php'; ?>
    <div id="header"></div>

    <h1>Agregar Receta Medica</h1>
    <form action="procesar_agregar_receta_medica.php" method="post">

        <label for="id_paciente">Paciente:</label>
        <select id="id_paciente" name="id_paciente" required>

            <?php
            include 'includes/conexion.php';
            $sqlPaciente = "SELECT id_paciente, CONCAT(nombre, ' ', apellido) AS nombre_completo
            FROM pacientes";

            $resultadoPaciente = $conn->query($sqlPaciente);
            while ($fila = $resultadoPaciente->fetch_assoc()) {
                echo "<option value='" . $fila["id_paciente"] . "'>" . $fila["nombre_completo"] . "</option>";
            }
            ?>
        </select><br>

        <label for="id_personal">Medico:</label>
        <select id="id_personal" name="id_personal" required>

            <?php
            include 'includes/conexion.php';
            $sqlPersonal = "SELECT id_personal, CONCAT(nombre, ' ', apellido) AS nombre_personal
            FROM personal";

            $resultadoPersonal = $conn->query($sqlPersonal);
            while ($fila = $resultadoPersonal->fetch_assoc()) {
                echo "<option value='" . $fila["id_personal"] . "'>" . $fila["nombre_personal"] . "</option>";
            }
            ?>
        </select><br>

        <label for="fecha_emision">Fecha:</label>
        <input type="datetime-local" id="fecha_emision" name="fecha_emision" required><br>

        <label for="id_medicamento">Medicamento:</label>
        <select id="id_medicamento" name="id_medicamento" required>

            <?php
            include 'includes/conexion.php';
            $sqlMedicamento = "SELECT nombre AS nombre_medicamento,
            id_medicamento
            FROM medicamentos";

            $resultadoMedicamento = $conn->query($sqlMedicamento);
            while ($fila = $resultadoMedicamento->fetch_assoc()) {
                echo "<option value='" . $fila["id_medicamento"] . "'>" . $fila["nombre_medicamento"] . "</option>";
            }
            ?>
        </select><br>

        <label for="dosis">Dosis:</label>
        <input type="text" id="dosis" name="dosis" required><br>

        <label for="observaciones">Observaciones:</label>
        <textarea id="descripcion" name="observaciones" required></textarea><br>

        <div class="inputdiv">
            <input type="submit" value="Agregar">
            <a href="recetas.php">Volver a la lista de recetas</a>
        </div>
    </form>

    <?php include 'assets/footer.html'; ?>
    <div id="footer"></div>
</body>
</html>