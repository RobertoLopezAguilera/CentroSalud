<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Expediente Médico</title>
</head>
<body>
    <h1>Agregar Expediente Médico</h1>
    <form action="procesar_agregar_expediente.php" method="post">
        <label for="id_paciente">Paciente:</label>
        <select id="id_paciente" name="id_paciente" required>
            <?php
            include 'includes/conexion.php';
            $sql = "SELECT * FROM Pacientes";
            $resultado = $conn->query($sql);
            while ($fila = $resultado->fetch_assoc()) {
                echo "<option value='" . $fila["id_paciente"] . "'>" . $fila["nombre"] . " " . $fila["apellido"] . "</option>";
            }
            ?>
        </select><br>
        <label for="historial_medico">Historial Médico:</label>
        <textarea id="historial_medico" name="historial_medico" required></textarea><br>
        <label for="alergias">Alergias:</label>
        <textarea id="alergias" name="alergias" required></textarea><br>
        <label for="medicamentos_actuales">Medicamentos Actuales:</label>
        <textarea id="medicamentos_actuales" name="medicamentos_actuales" required></textarea><br>
        <label for="antecedentes_familiares">Antecedentes Familiares:</label>
        <textarea id="antecedentes_familiares" name="antecedentes_familiares" required></textarea><br>
        <label for="otras_notas">Otras Notas:</label>
        <textarea id="otras_notas" name="otras_notas" required></textarea><br>
        <button type="submit">Agregar Expediente</button>
    </form>
</body>
</html>
