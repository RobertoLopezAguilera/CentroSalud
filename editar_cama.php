<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cama</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'assets/header.php'; ?>
    <div id="header"></div>
    <h1>Editar Cama</h1>
    <?php
    include 'includes/conexion.php';

    $id = $_GET['id'];
    $sql = "SELECT 
                camas.id_cama,
                camas.numero_cama,
                camas.estado,
                habitaciones.id_habitacion,
                habitaciones.numero as Numero_habitacion
            FROM 
                camas
            JOIN 
                habitaciones ON camas.id_habitacion = habitaciones.id_habitacion
            WHERE 
                camas.id_cama = $id";

    $resultado = $conn->query($sql);
    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
    ?>
        <form action="procesar_editar_camas.php" method="post">
            <input type="hidden" name="id" value="<?php echo $fila['id_cama']; ?>">
            <input type="hidden" name="id_habitacion" value="<?php echo $fila['id_habitacion']; ?>">

            <label for="numero_cama">Número de la cama:</label>
            <input type="text" id="numero_cama" name="numero_cama" value="<?php echo $fila['numero_cama']; ?>" required>
            
            <label for="estado">Estado:</label>
            <select id="estado" name="estado" required>
                <option value="Disponible" <?php echo $fila['estado'] === 'Disponible' ? 'selected' : ''; ?>>Disponible</option>
                <option value="Ocupada" <?php echo $fila['estado'] === 'Ocupada' ? 'selected' : ''; ?>>Ocupada</option>
                <option value="Mantenimiento" <?php echo $fila['estado'] === 'Mantenimiento' ? 'selected' : ''; ?>>Mantenimiento</option>
            </select>

            <div class="inputdiv">
                <input type="submit" value="Actualizar">
                <a href="camas.php?id_area=<?php echo $fila['id_habitacion']; ?>">Volver a la lista de camas</a>
            </div>
        </form>
    <?php
    } else {
        echo "No se encontró la cama especificada.";
    }
    $conn->close();
    ?>
    <?php include 'assets/footer.html'; ?>
    <div id="footer"></div>
</body>
</html>
