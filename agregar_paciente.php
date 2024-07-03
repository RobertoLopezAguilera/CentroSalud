<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Paciente</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
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
        <button class="button-29" type="submit">Agregar Área</button>
    </form>
</body>
</html>