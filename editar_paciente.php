<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Paciente</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'assets/header.php'; ?>
    <div id="header"></div>
    <h1>Editar Paciente</h1>
    <?php
    include 'includes/conexion.php';
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }
    $id_paciente = intval($_GET['id']);

    $sql_paciente = "SELECT * FROM pacientes WHERE id_paciente = ?";
    $stmt_paciente = $conn->prepare($sql_paciente);
    $stmt_paciente->bind_param("i", $id_paciente);
    $stmt_paciente->execute();
    $resultado_paciente = $stmt_paciente->get_result();
    $paciente = $resultado_paciente->fetch_assoc();

    $sql_areas = "SELECT id_area, nombre FROM Areas";
    $resultado_areas = $conn->query($sql_areas);
    ?>
    <form action="procesar_editar_paciente.php" method="post">
        <input type="hidden" name="id_paciente" value="<?php echo htmlspecialchars($paciente['id_paciente']); ?>">

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($paciente['nombre']); ?>" required>

        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" value="<?php echo htmlspecialchars($paciente['apellido']); ?>" required>

        <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo htmlspecialchars($paciente['fecha_nacimiento']); ?>" required>

        <label for="direccion">Dirección:</label>
        <input type="text" id="direccion" name="direccion" value="<?php echo htmlspecialchars($paciente['direccion']); ?>" required>

        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="telefono" value="<?php echo htmlspecialchars($paciente['telefono']); ?>" required>

        <label for="curp">CURP:</label>
        <input type="text" id="curp" name="curp" value="<?php echo htmlspecialchars($paciente['CURP']); ?>" required>

        <label for="id_area">Área:</label>
        <select id="id_area" name="id_area" required onchange="cargarHabitaciones(this.value)">
            <option value="">Seleccione un área</option>
            <?php while($area = $resultado_areas->fetch_assoc()) { ?>
                ----------  
                <option value="<?php echo htmlspecialchars($area['id_area']); ?>" <?php if ($area['id_area'] == $paciente['id_area']) echo 'selected'; ?>>
                    <?php echo htmlspecialchars($area['nombre']); ?>
                </option>
            <?php } ?>
        </select>

        <label for="id_habitacion">Habitación:</label>
        <select id="id_habitacion" name="id_habitacion" required onchange="cargarCamas(this.value)">
            <option value="">Seleccione una habitación</option>
        </select>

        <label for="id_cama">Cama:</label>
        <select id="id_cama" name="id_cama" required>
            <option value="">Seleccione una cama</option>
        </select>

        <div class="inputdiv">
            <input type="submit" value="Actualizar">
            <a href="pacientes.php">Volver a la lista de pacientes</a>
        </div>
    </form>

    <script>
        function cargarHabitaciones(id_area) {
            if (id_area) {
                fetch('obtener_habitaciones.php?id_area=' + id_area)
                    .then(response => response.json())
                    .then(data => {
                        let habitacionesSelect = document.getElementById('id_habitacion');
                        habitacionesSelect.innerHTML = '<option value="">Seleccione una habitación</option>';
                        data.habitaciones.forEach(habitacion => {
                            habitacionesSelect.innerHTML += `<option value="${habitacion.id_habitacion}">${habitacion.numero}</option>`;
                        });
                    });
            }
        }

        function cargarCamas(id_habitacion) {
            if (id_habitacion) {
                fetch('obtener_camas.php?id_habitacion=' + id_habitacion)
                    .then(response => response.json())
                    .then(data => {
                        let camasSelect = document.getElementById('id_cama');
                        camasSelect.innerHTML = '<option value="">Seleccione una cama</option>';
                        data.camas.forEach(cama => {
                            camasSelect.innerHTML += `<option value="${cama.id_cama}">${cama.numero_cama}</option>`;
                        });
                    });
            }
        }
    </script>

    <?php
    $stmt_paciente->close();
    $conn->close();
    ?>

    <?php include 'assets/footer.html'; ?>
    <div id="footer"></div>
</body>
</html>
