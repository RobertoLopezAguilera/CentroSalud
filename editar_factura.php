<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Factura</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include 'assets/header.php'; ?>
    <div id="header"></div>

    <h1>Editar Factura</h1>
    <?php
    include 'includes/conexion.php';
    $id = $_GET['id'];
    $sql = "SELECT * FROM facturas WHERE id_factura = $id";
    $resultado = $conn->query($sql);
    $fila = $resultado->fetch_assoc();

    $sqlPaciente = "SELECT CONCAT(p.nombre, ' ', p.apellido) as nombre_paciente, p.id_paciente
        FROM facturas f
        JOIN pacientes p ON f.id_paciente = p.id_paciente
        WHERE f.id_factura = $id";

    $resultado_paciente = $conn->query($sqlPaciente);
    $filaPaciente = $resultado_paciente->fetch_assoc();

    // Formatear la fecha de emisión al formato YYYY-MM-DD
    $fecha_emision = date('Y-m-d', strtotime($fila['fecha_emision']));
    ?>

    <form action="procesar_editar_factura.php" method="post">
        <input type="hidden" name="id_factura" value="<?php echo $fila['id_factura']; ?>">
        <input type="hidden" name="id_paciente" value="<?php echo $filaPaciente['id_paciente']; ?>">

        <label for="id_paciente">Paciente:</label>
        <input type="text" id="id_paciente" name="id_paciente" value="<?php echo $filaPaciente['nombre_paciente']; ?>" required disabled><br>

        <label for="fecha_emision">Fecha de Emision:</label>
        <input type="date" id="fecha_emision" name="fecha_emision" value="<?php echo $fecha_emision; ?>" required>

        <label for="total">Total:</label>
        <input type="number" id="total" name="total" step="0.01" value="<?php echo $fila['total']; ?>" required><br>

        <label for="pagada">Estatus:</label>
        <select id="pagada" name="pagada" required>
            <option value="1" <?php echo ($fila['pagada'] == 1) ? "selected" : ""; ?>>LIQUIDADA</option>
            <option value="0" <?php echo ($fila['pagada'] == 0) ? "selected" : ""; ?>>ADEUDO</option>
        </select><br>

        <div class="inputdiv">
            <input type="submit" value="Actualizar">
            <a href="facturas.php">Volver a la lista de facturas</a>
        </div>
    </form>

    <?php include 'assets/footer.html'; ?>
    <div id="footer"></div>
</body>

</html>
