<!DOCTYPE html>
<html lang="en">
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
    habitaciones.numero as Numero_habitacion
    FROM 
        camas
    JOIN 
    habitaciones ON camas.id_habitacion = habitaciones.id_habitacion;";

    $resultado = $conn->query($sql);
    $fila = $resultado->fetch_assoc();
    ?>
    <form action="procesar_editar_camas.php" method="post">
        <input type="hidden" name="id" value="<?php echo $fila['id_cama']; ?>">

        <label for="id_cama">Numero de la cama:</label>
        <input type="text" id="id_cama" name="id_cama" value="<?php echo $fila['numero_cama']; ?>" required>
        
        <label for="estado">Estatus:</label>
        <input type="text" id="estado" name="estado" value="<?php echo $fila['estado']; ?>" required>

        <div class="inputdiv">
            <input type="submit" value="Actualizar">
            <a href="camas.php">Volver a la lista de camas</a>
        </div>
    </form>
    <?php include 'assets/footer.html'; ?>
    <div id="footer"></div>
</body>
</html>