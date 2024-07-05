<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Habitación</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'assets/header.php'; ?>
    <div id="header"></div>
    <h1>Editar Habitación</h1>
    <?php
    include 'includes/conexion.php';
    $id = $_GET['id'];
    $sql = "SELECT * FROM Habitaciones WHERE id_habitacion = $id";
    $resultado = $conn->query($sql);
    $fila = $resultado->fetch_assoc();
    ?>
    <form action="procesar_editar_habitacion.php" method="post">
        <input type="hidden" name="id" value="<?php echo $fila['id_habitacion']; ?>">
        <label for="numero">Número:</label>
        <input type="number" id="numero" name="numero" value="<?php echo $fila['numero']; ?>" required><br>
        <label for="tipo">Tipo:</label>
        <input type="text" id="tipo" name="tipo" value="<?php echo $fila['tipo']; ?>" required><br>
        <label for="estado">Estado:</label>
        <input type="text" id="estado" name="estado" value="<?php echo $fila['estado']; ?>" required><br>
        <label for="costo">Costo:</label>
        <input type="number" step="0.01" id="costo" name="costo" value="<?php echo $fila['costo']; ?>" required><br>
        <label for="id_area">Área:</label>
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
        <div class="inputdiv">
            <input type="submit" value="Actualizar">
            <a href="habitaciones.php">Volver a la lista de habitaciones</a>
        </div>
    </form>
    <?php include 'assets/footer.html'; ?>
    <div id="footer"></div>
</body>
</html>
