<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar elemento a la factura médica</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body onload="updatePrecio(); updateSubtotal()">
    <?php include 'assets/header.php'; ?>
    <div id="header"></div>

    <h1>Agregar elemento a la factura médica</h1>

    <?php
    include 'includes/conexion.php';
    $id = $_GET['id'];
    $sql = "SELECT * FROM facturas WHERE id_factura = $id";
    $resultado = $conn->query($sql);
    $fila = $resultado->fetch_assoc();

    $sqlPaciente = "SELECT CONCAT(p.nombre, ' ', p.apellido) as nombre_paciente
        FROM facturas f
        JOIN pacientes p ON f.id_paciente = p.id_paciente
        WHERE f.id_factura = $id";
    $resultado_paciente = $conn->query($sqlPaciente);
    $filaPaciente = $resultado_paciente->fetch_assoc();
    ?>

    <form action="procesar_agregar_detalle_factura.php" method="post">
        <input type="hidden" name="id_factura" id="id_factura" value="<?php echo $fila['id_factura']; ?>" required>
        <input type="hidden" name="id_paciente" value="<?php echo $fila['id_paciente']; ?>" required>

        <label for="nombre_paciente">Paciente:</label>
        <input type="text" id="nombre_paciente" name="nombre_paciente" value="<?php echo $filaPaciente['nombre_paciente']; ?>" required disabled><br>

        <label for="servicios">Servicio:</label>
        <select id="servicios" name="servicios" onchange="updatePrecio(); updateSubtotal()" required>
            <?php
            // Obtener habitaciones
            $sqlHabitaciones = "SELECT numero, costo FROM habitaciones";
            $resultadoHabitaciones = $conn->query($sqlHabitaciones);
            while ($filaHabitacion = $resultadoHabitaciones->fetch_assoc()) {
                echo "<option value='H{$filaHabitacion["numero"]}'>Habitación {$filaHabitacion["numero"]} - Costo: {$filaHabitacion["costo"]}</option>";
            }

            // Obtener medicamentos
            $sqlMedicamentos = "SELECT nombre, precio FROM medicamentos";
            $resultadoMedicamentos = $conn->query($sqlMedicamentos);
            while ($filaMedicamento = $resultadoMedicamentos->fetch_assoc()) {
                echo "<option value='M{$filaMedicamento["nombre"]}'>Medicamento: {$filaMedicamento["nombre"]} - Precio: {$filaMedicamento["precio"]}</option>";
            }
            ?>
            <option value="otro">Otro</option>
        </select>

        <label for="precio_unitario">Precio unitario:</label>
        <input type="number" step="0.01" id="precio_unitario" name="precio_unitario" required disabled min="0">

        <label for="cantidad">Cantidad:</label>
        <input type="number" id="cantidad" name="cantidad" value="1" min="0" required oninput="updateSubtotal()">

        <label for="subtotal">Subtotal:</label>
        <input type="decimal" id="subtotal" name="subtotal" required disabled>

        <label for="descripcion">Descripción:</label>
        <input type="text" id="descripcion" name="descripcion" required>

        <div class="inputdiv">
            <input type="submit" value="Agregar elemento" onclick="enable()">
            <a href="facturas.php">Volver a la lista de facturas</a>
        </div>

        <script>
            function enable() {
                var precio_unitario = document.getElementById('precio_unitario');
                var subtotal = document.getElementById('subtotal');
                precio_unitario.disabled = false;
                subtotal.disabled = false;
            }

            function updatePrecio() {
                var select = document.getElementById('servicios');
                var precio_unitario = document.getElementById('precio_unitario');
                var selectedOption = select.options[select.selectedIndex].text;
                var precio = selectedOption.split(" - Costo: ")[1] || selectedOption.split(" - Precio: ")[1];
                if (select.value === 'otro') {
                    precio_unitario.disabled = false;
                } else {
                    precio_unitario.value = precio;
                    precio_unitario.disabled = true;
                }
            }

            function updateSubtotal() {
                var precio_unitario = document.getElementById('precio_unitario').value;
                var cantidad = document.getElementById('cantidad').value;
                var subtotal = document.getElementById('subtotal');
                subtotal.value = precio_unitario * cantidad;
            }
        </script>
    </form>

    <?php include 'assets/footer.html'; ?>
    <div id="footer"></div>
</body>
</html>
