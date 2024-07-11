<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Receta Médica</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include 'assets/header.php'; ?>
    <div id="header"></div>

    <h1>Editar Receta Médica</h1>

    <?php
    // Verificación de que se ha recibido un ID válido por GET
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        // Incluir archivo de conexión a la base de datos
        include 'includes/conexion.php';

        // Sanitizar el ID de la receta para evitar inyección SQL
        $id_receta = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

        // Consulta SQL para obtener los datos de la receta médica según el ID
        $sql = "SELECT 
                    r.id_receta, 
                    r.id_paciente, 
                    p.nombre AS nombre_paciente,
                    p.apellido AS apellido_paciente,
                    r.id_personal, 
                    r.fecha_emision, 
                    r.observaciones, 
                    rm.dosis, 
                    rm.id_medicamento,
                    m.nombre AS nombre_medicamento
                FROM 
                    Recetas_Medicas r
                JOIN 
                    Pacientes p ON r.id_paciente = p.id_paciente
                JOIN 
                    Receta_Medicamento rm ON r.id_receta = rm.id_receta
                JOIN 
                    Medicamentos m ON rm.id_medicamento = m.id_medicamento
                WHERE 
                    r.id_receta = ?";

        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param('i', $id_receta);
            $stmt->execute();
            $resultado = $stmt->get_result();

            if ($resultado->num_rows == 1) {
                // receta
                $receta = $resultado->fetch_assoc();

                // personal
                $sql_personal = "SELECT id_personal, CONCAT(nombre, ' ', apellido) AS nombre_completo FROM Personal";
                $resultado_personal = $conn->query($sql_personal);

                // medicamentos
                $sql_medicamentos = "SELECT id_medicamento, nombre FROM Medicamentos";
                $resultado_medicamentos = $conn->query($sql_medicamentos);
                ?>

                <form action="procesar_editar_receta.php" method="POST">
                    <input type="hidden" name="id_receta" value="<?php echo $receta['id_receta']; ?>">

                    <label for="id_paciente">Paciente:</label>
                    <input type="text" id="id_paciente" name="id_paciente"
                        value="<?php echo $receta['nombre_paciente'] . ' ' . $receta['apellido_paciente']; ?>" readonly>

                    <label for="id_personal">Personal Médico:</label>
                    <select id="id_personal" name="id_personal" required>
                        <?php
                        // Mostrar opciones del personal médico
                        while ($fila = $resultado_personal->fetch_assoc()) {
                            $selected = ($fila['id_personal'] == $receta['id_personal']) ? 'selected' : '';
                            echo "<option value='" . $fila['id_personal'] . "' $selected>" . $fila['nombre_completo'] . "</option>";
                        }
                        ?>
                    </select>

                    <label for="fecha_emision">Fecha de Emisión:</label>
                    <input type="datetime-local" id="fecha_emision" name="fecha_emision"
                        value="<?php echo date('Y-m-d\TH:i', strtotime($receta['fecha_emision'])); ?>" required>

                    <label for="observaciones">Observaciones:</label>
                    <textarea id="observaciones" name="observaciones" rows="4"
                        required><?php echo $receta['observaciones']; ?></textarea>

                    <label for="dosis">Dosis:</label>
                    <input type="text" id="dosis" name="dosis" value="<?php echo $receta['dosis']; ?>" required>

                    <label for="id_medicamento">Medicamento:</label>
                    <select id="id_medicamento" name="id_medicamento" required>
                        <?php
                        // Mostrar opciones de medicamentos
                        while ($fila = $resultado_medicamentos->fetch_assoc()) {
                            $selected = ($fila['id_medicamento'] == $receta['id_medicamento']) ? 'selected' : '';
                            echo "<option value='" . $fila['id_medicamento'] . "' $selected>" . $fila['nombre'] . "</option>";
                        }
                        ?>
                    </select>
                    <div class="inputdiv">
                    <input type="submit" value="Actualizar"></input>
                    <a href="recetas.php">Volver a la lista de recetas</a>
                    </div>
                </form>

                <?php
            } else {
                echo "<p>No se encontró la receta médica con el ID proporcionado.</p>";
            }
            $resultado_personal->close();
            $resultado_medicamentos->close();
            $stmt->close();
        } else {
            echo "<p>Error al preparar la consulta.</p>";
        }

        $conn->close();

    } else {
        echo "<p>No se proporcionó un ID válido para editar la receta médica.</p>";
    }
    ?>

    <?php include 'assets/footer.html'; ?>
    <div id="footer"></div>
</body>

</html>