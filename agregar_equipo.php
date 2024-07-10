<?php
include 'assets/header.php';

if (!isset($_SESSION['userName']) || $_SESSION['userType'] !== 'Personal') {
    $errorMessage = "No tienes permiso para acceder a esta página.";
} else {
    $userName = $_SESSION['userName'];

    if ($userName !== "DR. Roberto") {
        $errorMessage = "No tienes permiso para ver todas las recetas.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Agregar Equipo Médico</title>
</head>
<body>
<?php if (isset($errorMessage)): ?>
    <div class="error"><?php echo $errorMessage; ?></div>
<?php else: ?>
    <div id="header"></div>

    <h1>Agregar Equipo Médico</h1>
    <form action="guardar_equipo.php" method="post" enctype="multipart/form-data" onsubmit="return validarFormulario()">
        <label for="nombre_equipo">Nombre del Equipo:</label>
        <input type="text" id="nombre_equipo" name="nombre_equipo" required><br>
        
        <label for="estado">Estado:</label>
        <select id="estado" name="estado" required>
            <option value="Operativo">Operativo</option>
            <option value="No operativo">No operativo</option>
        </select><br>
        
        <label for="id_habitacion">Habitación:</label>
        <select id="id_habitacion" name="id_habitacion" required>
            <?php
            include 'includes/conexion.php';
            $sql = "SELECT id_habitacion, numero FROM Habitaciones WHERE estado = 'Disponible'";
            $resultado = $conn->query($sql);
            while($fila = $resultado->fetch_assoc()) {
                echo "<option value='" . $fila['id_habitacion'] . "'>" . $fila['numero'] . "</option>";
            }
            $conn->close();
            ?>
        </select><br>
        
        <label for="img">Imagen:</label>
        <input type="file" id="img" name="img" accept="image/*"><br>
        
        <div class="inputdiv">
            <input type="submit" value="Agregar">
            <a href="equipos.php">Volver a la lista de equipos</a>
        </div>
    </form>

    <script>
        function validarFormulario() {
            var nombre = document.getElementById("nombre_equipo").value;
            var estado = document.getElementById("estado").value;
            var idHabitacion = document.getElementById("id_habitacion").value;
            var img = document.getElementById("img").value;
            
            if (nombre.trim() === "") {
                alert("Por favor, ingrese el nombre del equipo.");
                return false;
            }

            if (estado !== "Operativo" && estado !== "No operativo") {
                alert("Por favor, seleccione un estado válido.");
                return false;
            }

            if (idHabitacion === "") {
                alert("Por favor, seleccione una habitación.");
                return false;
            }

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

    <?php include 'assets/footer.html'; ?>
    <div id="footer"></div>
<?php endif; ?>
</body>
</html>
