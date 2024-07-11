<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Equipo Médico</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'assets/header.php'; ?>
    <div id="header"></div>
    <h1>Editar Equipo Médico</h1>
    <?php
    include 'includes/conexion.php';

    if (isset($_GET['id'])) {
        $id_equipo = $_GET['id'];
        $sql = "SELECT * FROM Equipos_Medicos WHERE id_equipo = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_equipo);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            $equipo = $resultado->fetch_assoc();
            ?>
            <form id="editarEquipoForm" action="actualizar_equipo.php" method="post" enctype="multipart/form-data" onsubmit="return validarFormulario()">
                <input type="hidden" name="id_equipo" value="<?php echo htmlspecialchars($equipo['id_equipo'], ENT_QUOTES, 'UTF-8'); ?>">
                
                <label for="nombre_equipo">Nombre del Equipo:</label>
                <input type="text" id="nombre_equipo" name="nombre_equipo" value="<?php echo htmlspecialchars($equipo['nombre_equipo'], ENT_QUOTES, 'UTF-8'); ?>" required><br>
                
                <label for="estado">Estado:</label>
                <select id="estado" name="estado" required>
                    <option value="Operativo" <?php if ($equipo['estado'] == 'Operativo') echo 'selected'; ?>>Operativo</option>
                    <option value="No operativo" <?php if ($equipo['estado'] == 'No operativo') echo 'selected'; ?>>No operativo</option>
                </select><br>
                
                <label for="id_habitacion">Habitación:</label>
                <select id="id_habitacion" name="id_habitacion" required>
                    <?php
                    $sql_habitaciones = "SELECT id_habitacion, numero FROM Habitaciones WHERE estado = 'Disponible'";
                    $resultado_habitaciones = $conn->query($sql_habitaciones);
                    while($fila = $resultado_habitaciones->fetch_assoc()) {
                        $selected = ($equipo['id_habitacion'] == $fila['id_habitacion']) ? 'selected' : '';
                        echo "<option value='" . $fila['id_habitacion'] . "' $selected>" . $fila['numero'] . "</option>";
                    }
                    ?>
                </select><br>
                
                <label for="img">Imagen:</label>
                <input type="file" id="img" name="img" accept="image/*"><br>
                
                <div class="inputdiv">
                    <input type="submit" value="Actualizar">
                    <a href="equipos.php">Volver a la lista de equipos</a>
                </div>
            </form>
           
            <script>
                function validarFormulario() {
                    var nombre = document.getElementById("nombre_equipo").value.trim();
                    var estado = document.getElementById("estado").value;
                    var idHabitacion = document.getElementById("id_habitacion").value;
                    var img = document.getElementById("img").value;

                    // Validación del nombre
                    if (nombre === "") {
                        alert("Por favor, ingrese el nombre del equipo.");
                        return false;
                    }
                    var nombrePattern = /^[A-Za-z0-9\sáéíóúÁÉÍÓÚñÑ]+$/;
                    if (!nombrePattern.test(nombre)) {
                        alert("El nombre del equipo solo puede contener letras, números, acentos y espacios.");
                        return false;
                    }

                    // Validación del estado
                    if (estado !== "Operativo" && estado !== "No operativo") {
                        alert("Por favor, seleccione un estado válido.");
                        return false;
                    }

                    // Validación de la habitación
                    if (idHabitacion === "") {
                        alert("Por favor, seleccione una habitación.");
                        return false;
                    }

                    // Validación de la imagen
                    if (img !== "") {
                        var fileInput = document.getElementById("img");
                        var filePath = fileInput.value;
                        var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
                        if (!allowedExtensions.exec(filePath)) {
                            alert("Por favor, suba un archivo de imagen válido (JPG, JPEG, PNG, GIF).");
                            fileInput.value = "";
                            return false;
                        }
                    }

                    return true;
                }
            </script>
           
            <?php
        } else {
            echo "<script>
                alert('No se encontró el equipo.');
                window.history.back();
            </script>";
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "<script>
            alert('ID de equipo no proporcionado.');
            window.history.back();
        </script>";
    }
    ?>
    <?php include 'assets/footer.html'; ?>
    <div id="footer"></div>
</body>
</html>
