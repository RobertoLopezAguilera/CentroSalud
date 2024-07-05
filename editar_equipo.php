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
        $sql = "SELECT * FROM Equipos_Medicos WHERE id_equipo = $id_equipo";
        $resultado = $conn->query($sql);

        if ($resultado->num_rows > 0) {
            $equipo = $resultado->fetch_assoc();
            ?>
            <form action="actualizar_equipo.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id_equipo" value="<?php echo $equipo['id_equipo']; ?>">
                <label for="nombre_equipo">Nombre del Equipo:</label>
                <input type="text" id="nombre_equipo" name="nombre_equipo" value="<?php echo $equipo['nombre_equipo']; ?>" required><br>
                <label for="estado">Estado:</label>
                <select id="estado" name="estado" required>
                    <option value="1" <?php if ($equipo['estado']) echo 'selected'; ?>>Operativo</option>
                    <option value="0" <?php if (!$equipo['estado']) echo 'selected'; ?>>No operativo</option>
                </select><br>
                <label for="id_habitacion">ID Habitación:</label>
                <input type="number" id="id_habitacion" name="id_habitacion" value="<?php echo $equipo['id_habitacion']; ?>" required><br>
                <label for="img">Imagen:</label>
                <input type="file" id="img" name="img" accept="image/*"><br>
                
                <div class="inputdiv">
            <input type="submit" value="Actualizar">
            <a href="equipos.php">Volver a la lista de equipos</a>
        </div>
            </form>
           
            <?php
        } else {
            echo "No se encontró el equipo.";
        }
        $conn->close();
    }
    ?>
    <?php include 'assets/footer.html'; ?>
    <div id="footer"></div>
</body>
</html>
