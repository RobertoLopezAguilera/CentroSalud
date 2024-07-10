<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Paciente</title>
    <link rel="stylesheet" href="css/style.css">

    <style>
		.principal {
			display: flex;
			justify-content: center;
			align-items: center;
			width: 100%;
			height: 100%;
			flex-direction: column;
			background-image: url("https://www.versatilis.com.br/wp-content/uploads/2023/05/sala-de-espera-da-clinica-scaled.jpg");
			background-repeat: no-repeat;
			background-size: cover;
		}

		.principal h1 {
			color: black;
			text-shadow: -1px -1px 0 rgb(255, 255, 255),
				1px -1px 0 rgb(255, 255, 255),
				-1px 1px 0 rgb(255, 255, 255),
				1px 1px 0 rgb(255, 255, 255);
		}

        .formulario{
            background-color: rgba(177, 174, 175, 0.8); /* Color de fondo con opacidad */
            padding: 50px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px; /* Ajusta el ancho según sea necesario */
        }

        .formulario label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .formulario input[type="text"],
        .formulario input[type="date"],
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
            color: white;
            text-decoration: none;
        }
	</style>
</head>
<body>
    <?php include 'assets/header.php'; ?>
    <div id="header"></div>
    <div class="principal">
    <h1>Registro</h1>
    <form class="formulario" action="procesar_agregar_paciente.php" method="post">
        
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br>
        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" required><br>
        <label for="fech_nac">Fecha de Nacimiento:</label>
        <input type="date" id="fech_nac" name="fech_nac" required><br>
        <label for="direccion">Direccion:</label>
        <input type="text" id="direccion" name="direccion" required><br>
        <label for="telefono">Telefono:</label>
        <input type="text" id="telefono" name="telefono" required><br>
        <label for="curp">CURP:</label>
        <input type="text" id="curp" name="curp" required><br>
        <label for="contrasenia">Contrasena:</label>
        <input type="password" id="contrasenia" name="contrasenia" required><br>
        <div class="inputdiv">
            <a href="vistaPac.php">Crear cuenta</a>
            <a href="index.php">Cancelar</a>
        </div>
    </form>

    </div>

    <?php include 'assets/footer.html'; ?>
    <div id="footer"></div>
</body>
</html>