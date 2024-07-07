<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Datos del Paciente</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'assets/header.php'; ?>
<div id="header"></div>
    <h1>Editar Datos del Paciente</h1>

    <?php
    // Verificación de que se ha recibido un ID válido por GET
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        // Incluir archivo de conexión a la base de datos
        include 'includes/conexion.php';

        // Sanitizar el ID del paciente para evitar inyección SQL
        $id_paciente = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

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

        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param('i', $id_paciente);
            $stmt->execute();
            $resultado = $stmt->get_result();

            if ($resultado->num_rows == 1) {
                // paciente
                $paciente = $resultado->fetch_assoc();

                
                // areas
                $sql_areas = "SELECT id_area, nombre as nombre_area FROM areas";
                $resultado_areas = $conn->query($sql_areas);

                // habitaciones
                $sql_habitaciones = "SELECT id_habitacion, numero as nombre_area, id_area FROM habitaciones";
                $resultado_habitaciones = $conn->query($sql_habitaciones);
                ?>

                <form action="procesar_editar_paciente.php" method="POST">
                    <input type="hidden" name="id_paciente" value="<?php echo $paciente['id_paciente']; ?>">

                    <label for="nombre_paciente">Nombre:</label>
                    <input type="text" id="nombre_paciente" name="nombre_paciente" value="<?php echo $paciente['nombre_paciente']; ?>" required>

                    <label for="apellido">Apellido:</label>
                    <input type="text" id="apellido" name="apellido" value="<?php echo $paciente['apellido']; ?>" required>

                    <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                    <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo $paciente['fecha_nacimiento']; ?>" required>

                    <label for="direccion">Dirección:</label>
                    <input type="text" id="direccion" name="direccion" value="<?php echo $paciente['direccion']; ?>" required>

                    <label for="telefono">Teléfono:</label>
                    <input type="tel" id="telefono" name="telefono" value="<?php echo $paciente['telefono']; ?>" required>

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
            }
            $stmt->close();
        } else {
            echo "<p>Error al preparar la consulta.</p>";
        }

        $conn->close();

    } else {
        echo "<p>No se proporcionó un ID válido para editar los datos del paciente.</p>";
    }
    ?>

    <a href="pacientes.php">Volver a la Lista de Pacientes</a>
    <?php include 'assets/footer.html'; ?>
    <div id="footer"></div>
</body>
</html>
