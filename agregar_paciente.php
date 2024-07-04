<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Paciente</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'assets/header.html'; ?>
    <div id="header"></div>

    <h1>Agregar Paciente</h1>
    <form action="procesar_agregar_paciente.php" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br>
        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" required><br>
        <label for="fech_nac">Fecha de Nacimiento:</label>
        <input type="text" id="fech_nac" name="fech_nac" required><br>
        <label for="direccion">Direccion:</label>
        <input type="text" id="direccion" name="direccion" required><br>
        <label for="telefono">Telefono:</label>
        <input type="text" id="telefono" name="telefono" required><br>
        <label for="habitacion">Habitacion:</label>
        <input type="text" id="habitacion" name="habitacion" required><br>
        <label for="curp">CURP:</label>
        <input type="text" id="curp" name="curp" required><br>
        <label for="contrasenia">Contrasena:</label>
        <input type="text" id="contrasenia" name="contrasenia" required><br>
        <div class="inputdiv">
            <input type="submit" value="Agregar">
            <a href="pacientes.php">Volver a la lista de pacientes</a>
        </div>
    </form>

    <?php include 'assets/footer.html'; ?>
    <div id="footer"></div>
</body>
</html>