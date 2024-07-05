<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Área</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'assets/header.php'; ?>
    <div id="header"></div>
    
    <h1>Agregar Área</h1>
    <form action="procesar_agregar_area.php" method="post">
        <label for="nombre">Nombre del Área:</label>
        <input type="text" id="nombre" name="nombre" required>
        <div class="inputdiv">
            <input type="submit" value="Agregar">
            <a href="areas.php">Volver a la lista de áreas</a>
        </div>
    </form>

    <?php include 'assets/footer.html'; ?>
    <div id="footer"></div>
</body>
</html>
