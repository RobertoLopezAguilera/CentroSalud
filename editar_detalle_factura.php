<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Detalle Factura</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include 'assets/header.php'; ?>
    <div id="header"></div>

    <h1>Editar Detalle de Factura</h1>

    <?php
    include 'includes/conexion.php';

    $id = $_GET['id'];
    $sql = "SELECT * FROM detalle_factura WHERE id_detalle = $id";
    $resultado = $conn->query($sql);
    $fila = $resultado->fetch_assoc();

    $sqlPaciente = "SELECT 
        d.*, 
        f.id_paciente, 
        CONCAT(p.nombre, ' ', p.apellido) as nombre_paciente 
    FROM detalle_factura d 
        JOIN facturas f ON f.id_factura=d.id_factura 
        JOIN pacientes p ON p.id_paciente=f.id_paciente 
    WHERE d.id_factura=1";

    $resultado_paciente = $conn->query($sqlPaciente);
    $filaPaciente = $resultado_paciente->fetch_assoc();
    ?>

    <form action="procesar_editar_detalle_factura.php" method="post">
        <input type="hidden" name="id_factura" id="id_factura" value="<?php echo $fila['id_factura']; ?>" required>
        <input type="hidden" name="id_detalle" id="id_detalle" value="<?php echo $fila['id_detalle']; ?>" required>
        <input type="hidden" name="id_paciente" value="<?php echo $filaPaciente['id_paciente']; ?>" required>

        <label for="nombre_paciente">Paciente:</label>
        <input type="text" id="nombre_paciente" name="nombre_paciente"
            value="<?php echo $filaPaciente['nombre_paciente']; ?>" required disabled><br>

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
        <input type="decimal" id="precio_unitario" name="precio_unitario" required disabled>

        <label for="cantidad">Cantidad:</label>
        <input type="number" id="cantidad" name="cantidad" value="1" required oninput="updateSubtotal()">

        <label for="subtotal">Subtotal:</label>
        <input type="decimal" id="subtotal" name="subtotal" required disabled>

        <label for="descripcion">Descripción:</label>
        <input type="text" id="descripcion" name="descripcion" required>

        <div class="inputdiv">
            <input type="submit" value="Agregar elemento" onclick="updatePrecio(); updateSubtotal(); enable()">
            <a href="detalle_factura.php?id=<?php echo $fila['id_factura']; ?>">Volver a la lista de detalles</a>
        </div>

        <script>
            document.getElementById('descripcion').addEventListener('input', function () {
                var descripcion = document.getElementById('descripcion').value;
                var precio_unitario = document.getElementById('precio_unitario');
                var subtotal = document.getElementById('subtotal');

                if (descripcion === "") {
                    precio_unitario.disabled = true;
                    subtotal.disabled = true;
                }
            });

            function enable() {
                var descripcion = document.getElementById('descripcion').value;
                var precio_unitario = document.getElementById('precio_unitario');
                var subtotal = document.getElementById('subtotal');

                if (descripcion !== "") {
                    precio_unitario.disabled = false;
                    subtotal.disabled = false;
                }
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