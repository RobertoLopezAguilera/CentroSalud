<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
    <script>
        function toggleFields() {
            var userType = document.getElementById('userType').value;
            var personalFields = document.getElementById('personalFields');
            var pacienteFields = document.getElementById('pacienteFields');

            if (userType === 'Personal') {
                personalFields.style.display = 'block';
                pacienteFields.style.display = 'none';
            } else {
                personalFields.style.display = 'none';
                pacienteFields.style.display = 'block';
            }
        }
    </script>
</head>
<body>
<?php include 'assets/header.php'; ?>
<div id="header"></div>
    <h1>Login</h1>
    <form action="procesar_login.php" method="post">
        <label for="userType">Tipo de Usuario:</label>
        <select id="userType" name="userType" onchange="toggleFields()" required>
            <option value="Paciente">Paciente</option>
            <option value="Personal">Personal</option>
        </select><br>

        <div id="personalFields" style="display: block;">
            <label for="correo">Correo:</label>
            <input type="email" id="correo" name="correo"><br>
            <label for="contraseñaPersonal">Contraseña:</label>
            <input type="password" id="contraseñaPersonal" name="contraseñaPersonal"><br>
        </div>

        <div id="pacienteFields" style="display: none;">
            <label for="curp">CURP:</label>
            <input type="text" id="curp" name="curp"><br>
            <label for="contraseñaPaciente">Contraseña:</label>
            <input type="password" id="contraseñaPaciente" name="contraseñaPaciente"><br>
        </div>

        <button type="submit">Login</button>
    </form>
    <?php include 'assets/footer.html'; ?>
    <div id="footer"></div>
</body>
</html>
