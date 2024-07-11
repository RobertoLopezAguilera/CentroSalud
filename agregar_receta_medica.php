<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Agregar Receta Médica</title>
    <style>
        body {
            background: 
                url("Equipos_Medicos/istockphoto-680899226-612x612.jpg") left no-repeat,
                url("Equipos_Medicos/istockphoto-680899226-612x612.jpg") right no-repeat;
            margin: 0;
        }
    </style>
</head>
<body>
    <?php include 'assets/header.php'; ?>
    <div id="header"></div>

    <h1>Agregar Receta Médica</h1>
    <form id="agregarRecetaForm" action="procesar_agregar_receta_medica.php" method="post" onsubmit="return validarFormulario()">

        <label for="id_paciente">Paciente:</label>
        <select id="id_paciente" name="id_paciente" required>
            <?php
            include 'includes/conexion.php';
            $sqlPaciente = "SELECT id_paciente, CONCAT(nombre, ' ', apellido) AS nombre_completo FROM pacientes";
            $resultadoPaciente = $conn->query($sqlPaciente);
            while ($fila = $resultadoPaciente->fetch_assoc()) {
                echo "<option value='" . $fila["id_paciente"] . "'>" . $fila["nombre_completo"] . "</option>";
            }
            ?>
        </select><br>

        <label for="id_personal">Médico:</label>
        <select id="id_personal" name="id_personal" required>
            <?php
            $sqlPersonal = "SELECT id_personal, CONCAT(nombre, ' ', apellido) AS nombre_personal FROM personal";
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
            $sqlMedicamento = "SELECT nombre AS nombre_medicamento, id_medicamento FROM medicamentos";
            $resultadoMedicamento = $conn->query($sqlMedicamento);
            while ($fila = $resultadoMedicamento->fetch_assoc()) {
                echo "<option value='" . $fila["id_medicamento"] . "'>" . $fila["nombre_medicamento"] . "</option>";
            }
            ?>
        </select><br>

        <label for="dosis">Dosis:</label>
        <input type="text" id="dosis" name="dosis" required><br>

        <label for="observaciones">Observaciones:</label>
        <textarea id="observaciones" name="observaciones" required></textarea><br>

        <div class="inputdiv">
            <input type="submit" value="Agregar">
            <a href="recetas.php">Volver a la lista de recetas</a>
        </div>
    </form>

    <script>
        function validarFormulario() {
            var idPaciente = document.getElementById('id_paciente').value;
            var idPersonal = document.getElementById('id_personal').value;
            var fechaEmision = document.getElementById('fecha_emision').value;
            var idMedicamento = document.getElementById('id_medicamento').value;
            var dosis = document.getElementById('dosis').value.trim();
            var observaciones = document.getElementById('observaciones').value.trim();

            if (idPaciente === '') {
                alert('Por favor, seleccione un paciente.');
                return false;
            }

            if (idPersonal === '') {
                alert('Por favor, seleccione un médico.');
                return false;
            }

            if (fechaEmision === '') {
                alert('Por favor, ingrese la fecha de emisión.');
                return false;
            }

            if (idMedicamento === '') {
                alert('Por favor, seleccione un medicamento.');
                return false;
            }

            if (dosis === '') {
                alert('Por favor, ingrese la dosis.');
                return false;
            }

            if (observaciones === '') {
                alert('Por favor, ingrese las observaciones.');
                return false;
            }

            var fechaActual = new Date();
            var fechaEmisionDate = new Date(fechaEmision);
            if (fechaEmisionDate <= fechaActual) {
                alert("La fecha de emisión debe ser posterior a la fecha actual.");
                return false;
            }

            fechaMaxima.setFullYear(fechaMaxima.getFullYear() + 50);
            if (fechaEmisionDate > fechaMaxima) {
                alert("La fecha de emisión no debe ser más de 50 años desde la fecha actual.");
                return false;
            }

            return true;
        }
    </script>

    <?php include 'assets/footer.html'; ?>
    <div id="footer"></div>
</body>
</html>
