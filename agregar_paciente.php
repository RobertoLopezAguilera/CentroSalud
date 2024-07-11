<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Paciente</title>
    <link rel="stylesheet" href="css/style.css">

    <style>
        body {
            background: 
                url("https://www.versatilis.com.br/wp-content/uploads/2023/05/sala-de-espera-da-clinica-scaled.jpg") left no-repeat,
                url("https://www.versatilis.com.br/wp-content/uploads/2023/05/sala-de-espera-da-clinica-scaled.jpg") right no-repeat;
            margin: 0;
        }
    </style>
    <script>
        function validarEdad() {
            var fechaNacimiento = document.getElementById('fech_nac').value;
            var hoy = new Date();
            var fechaNac = new Date(fechaNacimiento);
            var edad = hoy.getFullYear() - fechaNac.getFullYear();
            var mes = hoy.getMonth() - fechaNac.getMonth();

            if (mes < 0 || (mes === 0 && hoy.getDate() < fechaNac.getDate())) {
                edad--;
            }

            if (edad < 16) {
                alert('Debes tener al menos 16 años para registrarte como paciente.');
                return false;
            }

            return true;
        }

        document.getElementById('registroForm').addEventListener('submit', function(event) {
            if (!validarEdad()) {
                event.preventDefault(); // Detener el envío del formulario si no se cumple la validación
            }
        });
    </script>
</head>
<body>
    <?php include 'assets/header.php'; ?>
    <div id="header"></div>
    <div class="principal">
        <h1>Registro</h1>
        <?php
        // Verificar si hay un mensaje de error para mostrar
        if (isset($_SESSION['error_message'])) {
            echo "<script>alert('" . $_SESSION['error_message'] . "');</script>";
            unset($_SESSION['error_message']); // Limpiar el mensaje de error
        }
        ?>
        <form id="registroForm" class="formulario" action="procesar_agregar_paciente.php" method="post" onsubmit="return validarEdad();">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required><br>
            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" required><br>
            <label for="fech_nac">Fecha de Nacimiento:</label>
            <input type="date" id="fech_nac" name="fech_nac" required><br>
            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion" required><br>
            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono" required><br>
            <label for="curp">CURP:</label>
            <input type="text" id="curp" name="curp" required><br>
            <label for="contraseñaPaciente">Contraseña:</label>
            <input type="password" id="contraseñaPaciente" name="contraseñaPaciente" required><br>
            <input type="hidden" id="userType" name="userType" value="Paciente" required><br>
            <div class="inputdiv">
                <input type="submit" value="Crear cuenta" id="submitBtn">
                <a href="index.php">Cancelar</a>
            </div>
        </form>
    </div>

    <?php include 'assets/footer.html'; ?>
    <div id="footer"></div>
</body>
</html>
