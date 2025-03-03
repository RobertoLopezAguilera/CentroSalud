<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cita Medica</title>
    <link rel="stylesheet" href="css/style.css">
    <script>
        function validateForm() {
            var fechaCita = new Date(document.getElementById("fecha_hora").value);
            var fechaActual = new Date();
            fechaActual.setHours(0, 0, 0, 0); // Resetear la hora a las 00:00

            var fechaLimite = new Date();
            fechaLimite.setDate(fechaLimite.getDate() + 2);
            fechaLimite.setHours(0, 0, 0, 0);
            if (fechaCita < fechaLimite) {
                alert("La fecha de la cita debe ser al menos dos días a partir de hoy.");
                return false;
            }

            const nombreValue = document.getElementById("tipo").value;
            const nombrePattern = /^[A-Za-z\u00C0-\u017F\s]+$/;

            if (!nombrePattern.test(nombreValue)) {
                alert('El tipo de cita solo puede contener letras, espacios y acentos.');
                event.preventDefault();
                return;
            }

            if (nombreValue.length < 5) {
                alert('El tipo de cita debe tener al menos 5 caracteres.');
                event.preventDefault();
            }
            return true;
        }
    </script>
</head>

<body>
    <?php include 'assets/header.php'; ?>
    <div id="header"></div>

    <h1>Editar Cita Medica</h1>

    <?php
    include 'includes/conexion.php';
    $id = $_GET['id'];
    $sql = "SELECT * FROM citas WHERE id_cita = $id";
    $resultado = $conn->query($sql);
    $fila = $resultado->fetch_assoc();

    $sqlPaciente = "SELECT CONCAT(p.nombre,' ',p.apellido) as nombre_paciente
        FROM citas c
        JOIN pacientes p ON c.id_paciente = p.id_paciente
        WHERE c.id_paciente = $id";
    $resultado_paciente = $conn->query($sqlPaciente);
    $filaPaciente = $resultado_paciente->fetch_assoc();
    ?>

    <form action="procesar_editar_cita.php" method="post" onsubmit="return validateForm();">
        <input type= "hidden" name="id" value="<?php echo $fila['id_cita']; ?>">
        <input type="hidden" name="id_paciente" value="<?php echo $fila['id_paciente']; ?>">

        <label for="nombre_paciente">Paciente:</label>
        <input type="text" id="nombre_paciente" name="nombre_paciente"
            value="<?php echo isset($filaPaciente['nombre_paciente']) ? htmlspecialchars($filaPaciente['nombre_paciente']) : ''; ?>"
            required disabled><br>

        <label for="id_personal">Medico:</label>
        <select id="id_personal" name="id_personal" required>
            <?php
            $sql_personal = "SELECT CONCAT(nombre, ' ', apellido) AS nombre_personal, id_personal FROM personal";
            $resultado_personal = $conn->query($sql_personal);
            while ($fila_personal = $resultado_personal->fetch_assoc()) {
                $selected = ($fila_personal["id_personal"] == $fila["id_personal"]) ? "selected" : "";
                echo "<option value='" . $fila_personal["id_personal"] . "' $selected>" . $fila_personal["nombre_personal"] . "</option>";
            }
            ?>
        </select><br>

        <label for="fecha_hora">Fecha de cita:</label>
        <input type="datetime-local" id="fecha_hora" maxlength="100" minlength="2" name="fecha_hora"
            value="<?php echo $fila['fecha_hora']; ?>" required><br>

        <label for="tipo">Tipo:</label>
        <input type="text" id="tipo" name="tipo" value="<?php echo $fila['tipo']; ?>" required><br>

        <div class="inputdiv">
            <input type="submit" value="Actualizar">
            <a href="citas.php">Volver a la lista de citas</a>
        </div>
    </form>
    <?php include 'assets/footer.html'; ?>
    <div id="footer"></div>
</body>

</html>