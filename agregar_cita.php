<?php
include 'assets/header.php';

if (!isset($_SESSION['userName']) || !isset($_SESSION['userId'])) {
    $errorMessage = "No tienes permiso para acceder a esta página.";
}

$userName = $_SESSION['userName'];
$userId = $_SESSION['userId'];
$id_habitacion = isset($_GET['id_habitacion']) ? intval($_GET['id_habitacion']) : 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Cita</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="principal">
        <h1>Agendar Citas</h1>
        <form class="formulario" action="procesar_agregar_cita.php" method="post">

            <?php if (!isset($errorMessage)): ?>
                <label for="id_paciente">Paciente:</label>
                <input type="text" id="id_paciente" name="id_paciente_nombre" value="<?php echo htmlspecialchars($userName); ?>" readonly><br>
                <input type="hidden" id="id_paciente" name="id_paciente" value="<?php echo htmlspecialchars($userId); ?>">

                <label for="id_personal">Medico:</label>
                <select id="id_personal" name="id_personal" required>
                    <?php
                    include 'includes/conexion.php';
                    $sql = "SELECT id_personal, CONCAT(nombre, ' ', apellido) as nombre_personal FROM personal";
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
