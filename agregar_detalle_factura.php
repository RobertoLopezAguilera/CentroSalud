<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar elemento a la factura medica</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include 'assets/header.php'; ?>
    <div id="header"></div>

    <h1>Agregar elemento a la factura medica</h1>

    <?php
    include 'includes/conexion.php';
    $id = $_GET['id'];
    $sql = "SELECT * FROM facturas WHERE id_factura = $id";
    $resultado = $conn->query($sql);
    $fila = $resultado->fetch_assoc();

    $sqlPaciente = "SELECT CONCAT(p.nombre,' ',p.apellido) as nombre_paciente
        FROM facturas f
        JOIN pacientes p ON f.id_paciente = p.id_paciente
        WHERE f.id_factura = $id";
    $resultado_paciente = $conn->query($sqlPaciente);
    $filaPaciente = $resultado_paciente->fetch_assoc();
    ?>

    <form action="procesar_agregar_detalle_factura.php" method="post">
        <input type="hidden" name="id" value="<?php echo $fila['id_factura']; ?>">
        <input type="hidden" name="id_paciente" value="<?php echo $fila['id_paciente']; ?>">

        <label for="nombre_paciente">Paciente:</label>
        <input type="text" id="nombre_paciente" name="nombre_paciente"
            value="<?php echo $filaPaciente['nombre_paciente']; ?>" required disabled><br>

        <label for="servicios">Servicio:</label>
        <select id="servicios">
            <option value="habitacion">Habitación</option>
            <option value="medicamentos">Medicamentos</option>
            <option value="otro">Otro</option>
        </select>
        <label for="precio_unitario">Precio unitario:</label>
        <input type="number" id="precio_unitario" name="precio_unitario" disabled></input>

        <script>
            document.getElementById('servicios').addEventListener('change', function () {
                var precio_unitario = document.getElementById('precio_unitario');
                if (this.value === 'otro') {
                    precio_unitario.disabled = false;
                } else {
                    precio_unitario.disabled = true;
                }
            });
        </script>

        <label for="descripcion">Descripción:</label>
        <input type="text" id="descripcion" name="descripcion">
        
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

        <div class="inputdiv">
            <input type="submit" value="Actualizar">
            <a href="citas.php">Volver a la lista de citas</a>
        </div>
    </form>

    <?php include 'assets/footer.html'; ?>
    <div id="footer"></div>
</body>

</html>