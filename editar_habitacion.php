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
    <form id="editarHabitacionForm" action="procesar_editar_habitacion.php" method="post">
        <input type="hidden" name="id" value="<?php echo $fila['id_habitacion']; ?>">
        <label for="numero">Número:</label>
        <input type="number" id="numero" name="numero" value="<?php echo $fila['numero']; ?>" required><br>
        <label for="tipo">Tipo:</label>
        <select id="tipo" name="tipo" required>
            <option value="Individual" <?php if ($fila['tipo'] == 'Individual') echo 'selected'; ?>>Individual</option>
            <option value="Doble" <?php if ($fila['tipo'] == 'Doble') echo 'selected'; ?>>Doble</option>
            <option value="Triple" <?php if ($fila['tipo'] == 'Triple') echo 'selected'; ?>>Triple</option>
        </select><br>
        <label for="estado">Estado:</label>
        <select id="estado" name="estado" required>
            <option value="Disponible" <?php if ($fila['estado'] == 'Disponible') echo 'selected'; ?>>Disponible</option>
            <option value="Ocupada" <?php if ($fila['estado'] == 'Ocupada') echo 'selected'; ?>>Ocupada</option>
        </select><br>
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
    <script>
        document.getElementById('editarHabitacionForm').addEventListener('submit', function(event) {
            const numeroInput = document.getElementById('numero');
            const costoInput = document.getElementById('costo');
            const numeroValue = parseInt(numeroInput.value);
            const costoValue = parseFloat(costoInput.value);

            if (numeroValue <= 0) {
                alert('El número de la habitación debe ser un valor positivo.');
                event.preventDefault();
                return;
            }

            if (costoValue <= 0 || costoValue > 30000) {
                alert('El costo debe ser un valor positivo y no puede superar los 30,000.');
                event.preventDefault();
            }
        });
    </script>
    <?php include 'assets/footer.html'; ?>
    <div id="footer"></div>
</body>
</html>
