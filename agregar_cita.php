<?php
include 'assets/header.php';

if (!isset($_SESSION['userName']) || !isset($_SESSION['userId'])) {
    $errorMessage = "No tienes permiso para acceder a esta página.";
}

$userName = $_SESSION['userName'];
$userId = $_SESSION['userId'];

$isPersonal = $_SESSION['userType'] === 'Personal';
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
            return true;
        }
    </script>
</head>

<body>
    <div class="principal">
        <h1>Agendar Citas</h1>
        <form class="formulario" action="procesar_agregar_cita.php" method="post" onsubmit="return validateForm();">

            <?php if (!isset($errorMessage)): ?>
                <?php if ($isPersonal): ?>
                    <label for="id_paciente">Paciente:</label>
                    <select id="id_paciente" name="id_paciente" required>
                        <option value="">Selecciona un paciente</option>
                        <?php
                        include 'includes/conexion.php';
                        $sql = "SELECT id_paciente, CONCAT(nombre, ' ', apellido) AS nombre_paciente, CURP FROM pacientes";
                        $resultado = $conn->query($sql);
                        while ($fila = $resultado->fetch_assoc()) {
                            echo "<option value='" . $fila["id_paciente"] . "'>" . htmlspecialchars($fila["nombre_paciente"]) . " - " . $fila["CURP"] . "</option>";
                        }
                        ?>
                    </select><br>
                <?php else: ?>
                    <label for="id_paciente">Paciente:</label>
                    <input type="text" id="id_paciente" name="id_paciente_nombre" value="<?php echo htmlspecialchars($userName); ?>" readonly><br>
                    <input type="hidden" id="id_paciente" name="id_paciente" value="<?php echo htmlspecialchars($userId); ?>">
                <?php endif; ?>

                <label for="id_personal">Médico:</label>
                <select id="id_personal" name="id_personal" required>
                    <?php
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
            <?php else: ?>
                <div class="error"><?php echo $errorMessage; ?></div>
            <?php endif; ?>
        </form>
    </div>

    <?php include 'assets/footer.html'; ?>
    <div id="footer"></div>
</body>

</html>
