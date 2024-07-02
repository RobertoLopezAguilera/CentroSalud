<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Área</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Editar Área</h1>
    <?php
    include 'includes/conexion.php';
    $id = $_GET['id'];
    $sql = "SELECT * FROM Areas WHERE id_area = $id";
    $resultado = $conn->query($sql);
    $fila = $resultado->fetch_assoc();
    ?>
    <form action="procesar_editar_area.php" method="post">
        <input type="hidden" name="id" value="<?php echo $fila['id_area']; ?>">
        <label for="nombre">Nombre del Área:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo $fila['nombre']; ?>" required>
        <button type="submit">Actualizar Área</button>
    </form>
</body>
</html>
