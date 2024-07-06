<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Cama</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'assets/header.php'; ?>
    <div id="header"></div>
    
    <h1>Agregar Cama</h1>
    <form action="procesar_agregar_cama.php" method="post">

        <label for="numero_cama">Numero de la cama:</label>
        <input type="text" id="numero_cama" name="numero_cama" required>

        <label for="estado">Estado:</label>
        <input type="text" id="estado" name="estado" required>

        <label for="id_habitacion">Habitacion:</label>
        <input type="text" id="id_habitacion" name="id_habitacion" required>

        <div class="inputdiv">
            <input type="submit" value="Agregar">
            <a href="camas.php">Volver a la lista de camas</a>
        </div>
    </form>

    <?php include 'assets/footer.html'; ?>
    <div id="footer"></div>
</body>
</html>