<?php
include 'assets/header.php';
//session_start(); // Asegúrate de iniciar la sesión

if (!isset($_SESSION['userName']) || $_SESSION['userType'] !== 'Personal') {
    $errorMessage = "No tienes permiso para acceder a esta página.";
} else {
    $userName = $_SESSION['userName'];

    if ($userName !== "DR. Roberto") {
        $errorMessage = "No tienes permiso para ver todas las habitaciones.";
    }
}
$id_habitacion = isset($_GET['id_habitacion']) ? intval($_GET['id_habitacion']) : 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Agregar Cita</title>
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
   

    <div class="principal">
        <h1>Agendar Citas</h1>
        <form class="formulario" action="procesar_agregar_cita.php" method="post">

            <?php if (!isset($errorMessage)): ?>
                <label for="id_paciente">Paciente:</label>
                <select id="id_paciente" name="id_paciente" required>
                    <?php
                    include 'includes/conexion.php';
                    $sql = "SELECT id_paciente, CONCAT(nombre, ' ', apellido) as nombre_paciente FROM pacientes";
                    $resultado = $conn->query($sql);
                    while ($fila = $resultado->fetch_assoc()) {
                        echo "<option value='" . $fila["id_paciente"] . "'>" . $fila["nombre_paciente"] . "</option>";
                    }
                    ?>
                </select><br>
            <?php else: ?>
                <div class="error"></div>
            <?php endif; ?>

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
                <?php if (!isset($errorMessage)): ?>
                    <a href="citas.php">Volver a la lista de citas</a>
                <?php else: ?>
                    <div class="error"></div>
                <?php endif; ?>
            </div>
        </form>
    </div>

    <?php include 'assets/footer.html'; ?>
    <div id="footer"></div>
</body>

</html>