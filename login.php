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

<style>
		.principal {
			display: flex;
			justify-content: center;
			align-items: center;
			width: 100%;
			height: 100%;
			flex-direction: column;
			background-image: url("https://www.nosequeestudiar.net/site/assets/files/1695520/medicina-medico-estetoscopio.jpg");
			background-repeat: no-repeat;
			background-size: cover;
		}

		.principal h1 {
			color: white;
			text-shadow: -1px -1px 0 rgb(0,0,0),
				1px -1px 0 rgb(0,0,0),
				-1px 1px 0 rgb(0,0,0),
				1px 1px 0 rgb(0,0,0);
		}

        .formulario{
            background-color: rgba(121, 200, 245, 0.8); /* Color de fondo con opacidad */
            padding: 50px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px; 
         }

        .formulario label {
            color: white;
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .formulario input[type="text"],
        .formulario input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .formulario input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .formulario input[type="submit"]:hover {
            background-color: #45a049;
        }

        .inputdiv a {
            display: inline-block;
            margin-top: 10px;
            color: #4CAF50;
            text-decoration: none;
        }
	</style>
</head>
<body>
<?php include 'assets/header.php'; ?>
<div id="header"></div>

    <div class="principal">
    <h1>Iniciar Sesion</h1>
    <form class="formulario" action="procesar_login.php" method="post">
        <label for="userType">Tipo de Usuario:</label>
        <select id="userType" name="userType" onchange="toggleFields()" required>
        <option value="Personal">Personal</option>    
        <option value="Paciente">Paciente</option>
            
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

        <button class="button-29" type="submit">Login</button>
        <button class="button-29" type="submit">Registarse</button>
    </form>
    </div>
    
    <?php include 'assets/footer.html'; ?>
    <div id="footer"></div>
</body>
</html>
