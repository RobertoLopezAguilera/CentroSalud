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

<<<<<<< HEAD
    $sql_areas = "SELECT id_area, nombre FROM Areas";
    $resultado_areas = $conn->query($sql_areas);
    ?>
    <form action="actualizar_paciente.php" method="post">
        <input type="hidden" name="id_paciente" value="<?php echo htmlspecialchars($paciente['id_paciente']); ?>">
=======
        // Consulta SQL para obtener los datos del paciente según el ID
        $sql = "SELECT 
	                p.id_paciente, 
                    p.nombre AS nombre_paciente, 
                    p.apellido, 
                    p.fecha_nacimiento, 
                    p.direccion, 
                    p.telefono,
                    a.id_area,
                    a.nombre AS nombre_area,
                    h.id_habitacion,
                    h.numero AS numero_habitacion,
                    h.estado AS estatus_habitacion,
                    p.id_cama,
                    c.numero_cama,
                    c.estado AS estatus_cama
                FROM pacientes p 
		            JOIN camas c ON p.id_cama = c.id_cama 
		            JOIN habitaciones h ON c.id_habitacion = h.id_habitacion
		            JOIN areas a ON h.id_area = a.id_area 
	            WHERE p.id_paciente = ?";
>>>>>>> 63f13079ea237c51b7cc41a979afa8cc16bff3c3

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($paciente['nombre']); ?>" required>

        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" value="<?php echo htmlspecialchars($paciente['apellido']); ?>" required>

        <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo htmlspecialchars($paciente['fecha_nacimiento']); ?>" required>

<<<<<<< HEAD
        <label for="direccion">Dirección:</label>
        <input type="text" id="direccion" name="direccion" value="<?php echo htmlspecialchars($paciente['direccion']); ?>" required>
=======
                
                // areas
                $sql_areas = "SELECT id_area, nombre as nombre_area FROM areas";
                $resultado_areas = $conn->query($sql_areas);

                // habitaciones
                $sql_habitaciones = "SELECT id_habitacion, numero as nombre_area, id_area FROM habitaciones";
                $resultado_habitaciones = $conn->query($sql_habitaciones);
                ?>
>>>>>>> 63f13079ea237c51b7cc41a979afa8cc16bff3c3

        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="telefono" value="<?php echo htmlspecialchars($paciente['telefono']); ?>" required>

<<<<<<< HEAD
        <label for="curp">CURP:</label>
        <input type="text" id="curp" name="curp" value="<?php echo htmlspecialchars($paciente['CURP']); ?>" required>
=======
                    <label for="nombre_paciente">Nombre:</label>
                    <input type="text" id="nombre_paciente" name="nombre_paciente" value="<?php echo $paciente['nombre_paciente']; ?>" required>
>>>>>>> 63f13079ea237c51b7cc41a979afa8cc16bff3c3

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

        <button type="submit">Actualizar</button>
    </form>

<<<<<<< HEAD
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
=======
                    <label for="nombre_area">Area:</label>
                    <select id="id_area" name="id_area" required>
                        <?php
                        $sql_areas = "SELECT * FROM Areas";
                        $resultado_areas = $conn->query($sql_areas);
                        while ($fila_area = $resultado_areas->fetch_assoc()) {
                            $selected = ($fila_area["id_area"] == $fila["id_area"]) ? "selected" : "";
                            echo "<option value='" . $fila_area["id_area"] . "' $selected>" . $fila_area["nombre"] . "</option>";
                        }
                        ?>
                    </select><br>

                    <label for="numero">Habitaciones:</label>
                    <select id="id_habitacion" name="id_habitacion" required>
                        <?php
                        $sql_habitaciones = "SELECT * FROM Habitaciones h JOIN Camas c WHERE h.id_habitacion = c.id_habitacion";
                        $resultado_habitaciones = $conn->query($sql_habitaciones);
                        while ($fila_habitaciones = $resultado_habitaciones->fetch_assoc()) {
                            $selected = ($fila_habitaciones["h.id_habitacion"] == $fila_habitaciones["c.id_habitacion"]) ? "selected" : "";
                            echo "<option value='" . $fila_habitaciones["id_habitacion"] . "' $selected>" . $fila_habitaciones["numero"] . "</option>";
                        }
                        ?>
                    </select><br>
                    <input type="submit" value="Actualizar"></input>
                </form>

                <?php
            } else {
                echo "<p>No se encontró el paciente con el ID proporcionado.</p>";
>>>>>>> 63f13079ea237c51b7cc41a979afa8cc16bff3c3
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
