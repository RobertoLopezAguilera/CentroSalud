<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cita Medica</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'assets/header.php'; ?>
    <div id="header"></div>
    <h1>Editar Cita Medica</h1>
    <?php
    include 'includes/conexion.php';

    $sqlCita = "SELECT CONCAT(nombre, ' ', apellido) AS nombre_personal FROM personal;";
    $resultado_cita = $conn->query($sqlCita);


    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sqlPaciente = "SELECT CONCAT(p.nombre,p.apellido) as nombre_paciente
        FROM citas c
        JOIN pacientes p ON c.id_paciente = p.id_paciente
        WHERE c.id_paciente = $id";
        
        $resultado_paciente = $conn->query($sqlPaciente);
        $sql = "SELECT * FROM citas WHERE id_cita = $id";
        $resultado = $conn->query($sql);

        if ($resultado->num_rows > 0) {
            $cita = $resultado->fetch_assoc();
            $paci = $resultado_paciente->fetch_assoc();
            ?>
            <form action="procesar_editar_cita.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_cita" value="<?php echo $cita['id_cita']; ?>">
            
            <label for="nombre_paciente">Paciente:</label>
            <input type="text" id="nombre_paciente" name="nombre_paciente" value="<?php echo $paci['nombre_paciente']; ?>" required><br>
            <input type="hidden" name="id_paciente" value="<?php echo $cita['id_paciente']; ?>">
            
            <label for="id_personal">Medico:</label>
            <select id="id_personal" name="id_personal" required>
                <?php                        
                    // Mostrar opciones del personal
                    $sql = "SELECT * FROM personal";
                    $resultado = $conn->query($sql);
                     while ($fila = $resultado_cita->fetch_assoc()) {
                     $selected = ($fila['id_personal'] == $cita['id_personal']) ? 'selected' : '';
                    echo "<option value='" . $fila['id_personal'] . "' $selected>" . $fila['nombre_personal'] . "</option>";
                    }
                    ?>
                
            </select>
            

                <label for="fecha_hora">Fecha de la cita:</label>
                <input type="datetime-local" id="fecha_hora" name="fecha_hora" value="<?php echo $cita['fecha_hora']; ?>" required><br>
                
                <label for="tipo">Tipo de la cita:</label>
                <input type="text" id="tipo" name="tipo" value="<?php echo $cita['tipo']; ?>" required><br>

                
                <div class="inputdiv">
            <input type="submit" value="Actualizar">
            <a href="citas.php">Volver a la lista de citas</a>
        </div>
            </form>
           
            <?php
        } else {
            echo "No se encontró la cita.";
        }
        $conn->close();
    }
    ?>
    <?php include 'assets/footer.html'; ?>
    <div id="footer"></div>
</body>
</html>