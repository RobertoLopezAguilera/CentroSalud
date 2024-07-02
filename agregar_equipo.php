<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Equipo Médico</title>
</head>
<body>
    <h1>Agregar Equipo Médico</h1>
    <form action="guardar_equipo.php" method="post" enctype="multipart/form-data">
        <label for="nombre_equipo">Nombre del Equipo:</label>
        <input type="text" id="nombre_equipo" name="nombre_equipo" required><br>
        <label for="estado">Estado:</label>
        <select id="estado" name="estado" required>
            <option value="1">Operativo</option>
            <option value="0">No operativo</option>
        </select><br>
        <label for="id_habitacion">ID Habitación:</label>
        <input type="number" id="id_habitacion" name="id_habitacion" required><br>
        <label for="img">Imagen:</label>
        <input type="file" id="img" name="img" accept="image/*"><br>
        <input type="submit" value="Agregar">
    </form>
    <a href="equipos.php">Volver a la lista de equipos</a>
</body>
</html>
