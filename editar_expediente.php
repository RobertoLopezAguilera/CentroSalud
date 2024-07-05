<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Expediente Médico</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'assets/header.php'; ?>
    <div id="header"></div>
    <h1>Editar Expediente Médico</h1>
    <?php
    include 'includes/conexion.php';
    $id = $_GET['id'];
    $sql = "SELECT * FROM Expedientes_Medicos WHERE id_expediente = $id";
    $resultado = $conn->query($sql);
    $fila = $resultado->fetch_assoc();
    ?>
    <form action="procesar_editar_expediente.php" method="post">
        <input type="hidden" name="id" value="<?php echo $fila['id_expediente']; ?>">
        <label for="id_paciente">Paciente:</label>
        <select id="id_paciente" name="id_paciente" required>
            <?php
            $sql_pacientes = "SELECT * FROM Pacientes";
            $resultado_pacientes = $conn->query($sql_pacientes);
            while ($fila_paciente = $resultado_pacientes->fetch_assoc()) {
                $selected = ($fila_paciente["id_paciente"] == $fila["id_paciente"]) ? "selected" : "";
                echo "<option value='" . $fila_paciente["id_paciente"] . "' $selected>" . $fila_paciente["nombre"] . " " . $fila_paciente["apellido"] . "</option>";
            }
            ?>
        </select><br>
        <label for="historial_medico">Historial Médico:</label>
        <textarea id="historial_medico" name="historial_medico" required><?php echo $fila['historial_medico']; ?></textarea><br>
        <label for="alergias">Alergias:</label>
        <textarea id="alergias" name="alergias" required><?php echo $fila['alergias']; ?></textarea><br>
        <label for="medicamentos_actuales">Medicamentos Actuales:</label>
        <textarea id="medicamentos_actuales" name="medicamentos_actuales" required><?php echo $fila['medicamentos_actuales']; ?></textarea><br>
        <label for="antecedentes_familiares">Antecedentes Familiares:</label>
        <textarea id="antecedentes_familiares" name="antecedentes_familiares" required><?php echo $fila['antecedentes_familiares']; ?></textarea><br>
        <label for="otras_notas">Otras Notas:</label>
        <textarea id="otras_notas" name="otras_notas" required><?php echo $fila['otras_notas']; ?></textarea><br>
        <div class="inputdiv">
            <input type="submit" value="Actualizar">
            <a href="expedientes_medicos.php">Volver a la lista de expedientes</a>
        </div>
    </form>
    <?php include 'assets/footer.html'; ?>
    <div id="footer"></div>
</body>
</html>
