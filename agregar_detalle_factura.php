<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Agregar Elemento a la Factura</title>
</head>
<body>
    <?php include 'assets/header.php'; ?>
    <div id="header"></div>

    <h1>Agregar Elemento a la Factura Medica</h1>

    <?php
    include 'includes/conexion.php';
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }
    ?>

    <form action="procesar_agregar_detalle_factura.php" method="post">

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
        
        <label for="descripcion">Descripcion:</label>
        <textarea id="descripcion" name="descripcion" required></textarea><br>

        <label for="cantidad">Cantidad:</label>
        <input type="number" step="0" id="cantidad" name="cantidad" required><br>

        <label for="precio_unitario">Precio unitario:</label>
        <input type="number" step="0.01" id="precio_unitario" name="precio_unitario" required><br>

        <label for="subtotal">Subtotal:</label>
        <input type="number" step="0.01" id="subtotal" name="subtotal" required><br>

        <div class="inputdiv">
            <input type="submit" value="Agregar">
            <a href="detalle_factura.php">Volver a la lista de facturas</a>
        </div>
    </form>

    <?php include 'assets/footer.html'; ?>
    <div id="footer"></div>
</body>
</html>