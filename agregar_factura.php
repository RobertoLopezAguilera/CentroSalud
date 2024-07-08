<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Agregar Factura Medica</title>
</head>
<body>
    <?php include 'assets/header.php'; ?>
    <div id="header"></div>

    <h1>Agregar Factura Medica</h1>

    <?php
    include 'includes/conexion.php';
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }
    ?>

    <form action="procesar_agregar_factura.php" method="post">

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
        
        <label for="fecha_emision">Fecha de Emision:</label>
        <input type ="date" id="fecha_emision" name="fecha_emision" required><br><br>

        <div class="inputdiv">
            <input type="submit" value="Agregar">
            <a href="facturas.php">Volver a la lista de facturas</a>
        </div>
    </form>

    <?php include 'assets/footer.html'; ?>
    <div id="footer"></div>
</body>
</html>