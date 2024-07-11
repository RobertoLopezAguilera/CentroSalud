<?php
include 'assets/header.php';

if (!isset($_SESSION['userName']) || !isset($_SESSION['userId'])) {
    $errorMessage = "No tienes permiso para acceder a esta página.";
}

$userName = $_SESSION['userName'];
$userId = $_SESSION['userId'];
$userType = $_SESSION['userType'];

$isPersonal = $userType === 'Personal';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Cita</title>
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
    <div class="principal">
        <h1>Agendar Citas</h1>

        <?php if (!isset($errorMessage)): ?>
            <?php if ($isPersonal): ?>
                <!-- Formulario para Personal Médico -->
                <form class="formulario" action="procesar_agregar_cita.php" method="post" onsubmit="return validateForm();">
                    <label for="id_paciente">Paciente:</label>
                    <select id="id_paciente" name="id_paciente" required>
                        <option value="">Selecciona un paciente</option>
                        <?php
                        include 'includes/conexion.php';
                        $sql_pacientes = "SELECT id_paciente, CONCAT(nombre, ' ', apellido) AS nombre_paciente, CURP FROM pacientes";
                        $resultado_pacientes = $conn->query($sql_pacientes);
                        while ($fila_paciente = $resultado_pacientes->fetch_assoc()) {
                            echo "<option value='" . $fila_paciente["id_paciente"] . "'>" . htmlspecialchars($fila_paciente["nombre_paciente"]) . " - " . $fila_paciente["CURP"] . "</option>";
                        }
                        ?>
                    </select><br>

                    <label for="id_personal">Médico:</label>
                    <input type="text" id="id_personal" name="id_personal_nombre" value="<?php echo htmlspecialchars($userName); ?>" readonly><br>
                    <input type="hidden" id="id_personal" name="id_personal" value="<?php echo htmlspecialchars($userId); ?>">

                    <label for="fecha_hora">Fecha de cita:</label>
                    <input type="datetime-local" id="fecha_hora" name="fecha_hora" required><br>

                    <label for="tipo">Tipo de cita:</label>
                    <input type="text" id="tipo" name="tipo" required><br>

                    <div class="inputdiv">
                        <input type="submit" value="Agregar">
                        <a href="citas.php">Volver a la lista de citas</a>
                    </div>
                </form>
            <?php else: ?>
                <!-- Formulario para Paciente -->
                <form class="formulario" action="procesar_agregar_cita.php" method="post" onsubmit="return validateForm();">
                    <label for="id_paciente">Paciente:</label>
                    <input type="text" id="id_paciente" name="id_paciente_nombre" value="<?php echo htmlspecialchars($userName); ?>" readonly><br>
                    <input type="hidden" id="id_paciente" name="id_paciente" value="<?php echo htmlspecialchars($userId); ?>">

                    <label for="id_personal">Médico:</label>
                    <select id="id_personal" name="id_personal" required>
                        <?php
                        include 'includes/conexion.php';
                        $sql_personal = "SELECT id_personal, CONCAT(nombre, ' ', apellido) AS nombre_personal FROM personal";
                        $resultado_personal = $conn->query($sql_personal);
                        while ($fila_personal = $resultado_personal->fetch_assoc()) {
                            echo "<option value='" . $fila_personal["id_personal"] . "'>" . $fila_personal["nombre_personal"] . "</option>";
                        }
                        ?>
                    </select><br>

                    <label for="fecha_hora">Fecha de cita:</label>
                    <input type="datetime-local" id="fecha_hora" name="fecha_hora" required><br>

                    <label for="tipo">Tipo de cita:</label>
                    <input type="text" id="tipo" name="tipo" required><br>

                    <div class="inputdiv">
                        <input type="submit" value="Agregar">
                        <a href="citas.php">Volver a la lista de citas</a>
                    </div>
                </form>
            <?php endif; ?>
        <?php else: ?>
            <div class="error"><?php echo $errorMessage; ?></div>
        <?php endif; ?>
    </div>

    <?php include 'assets/footer.html'; ?>
    <div id="footer"></div>
</body>

</html>
