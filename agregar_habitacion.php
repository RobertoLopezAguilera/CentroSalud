<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Habitación</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Agregar Habitación</h1>
    <form action="procesar_agregar_habitacion.php" method="post">
        <label for="numero">Número:</label>
        <input type="number" id="numero" name="numero" required><br>
        <label for="tipo">Tipo:</label>
        <input type="text" id="tipo" name="tipo" required><br>
        <label for="estado">Estado:</label>
        <input type="text" id="estado" name="estado" required><br>
        <label for="costo">Costo:</label>
        <input type="number" step="0.01" id="costo" name="costo" required><br>
        <label for="id_area">Área:</label>
        <select id="id_area" name="id_area" required>
            <?php
            include 'includes/conexion.php';
            $sql = "SELECT * FROM Areas";
            $resultado = $conn->query($sql);
            while ($fila = $resultado->fetch_assoc()) {
                echo "<option value='" . $fila["id_area"] . "'>" . $fila["nombre"] . "</option>";
            }
            ?>
        </select><br>
        <button type="submit">Agregar Habitación</button>
    </form>
</body>
</html>
