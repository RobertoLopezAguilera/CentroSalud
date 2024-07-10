<?php
include 'assets/header.php';
//session_start(); // Asegúrate de iniciar la sesión

if (!isset($_SESSION['userName']) || $_SESSION['userType'] !== 'Personal') {
    $errorMessage = "No tienes permiso para acceder a esta página.";
} else {
    $userName = $_SESSION['userName'];

    if ($userName !== "DR. Roberto") {
        $errorMessage = "No tienes permiso para ver todas las habitaciones.";
    }
}
$id_habitacion = isset($_GET['id_habitacion']) ? intval($_GET['id_habitacion']) : 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Agregar Cita</title>
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
            text-shadow: -1px -1px 0 rgb(255 255 255),
                1px -1px 0 rgb(255 255 255),
                -1px 1px 0 rgb(255 255 255),
                1px 1px 0 rgb(255 255 255);
        }

        .formulario {
            background-color: rgba(177, 174, 175, 0.8);
            /* Color de fondo con opacidad */
            padding: 50px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            /* Ajusta el ancho según sea necesario */
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
   

    <div class="principal">
        <h1>Agendar Citas</h1>
        <form class="formulario" action="procesar_agregar_cita.php" method="post">

            <?php if (!isset($errorMessage)): ?>
                <label for="id_paciente">Paciente:</label>
                <select id="id_paciente" name="id_paciente" required>
                    <?php
                    include 'includes/conexion.php';
                    $sql = "SELECT id_paciente, CONCAT(nombre, ' ', apellido) as nombre_paciente FROM pacientes";
                    $resultado = $conn->query($sql);
                    while ($fila = $resultado->fetch_assoc()) {
                        echo "<option value='" . $fila["id_paciente"] . "'>" . $fila["nombre_paciente"] . "</option>";
                    }
                    ?>
                </select><br>
            <?php else: ?>
                <div class="error"></div>
            <?php endif; ?>

            <label for="id_personal">Medico:</label>
            <select id="id_personal" name="id_personal" required>
                <?php
                include 'includes/conexion.php';
                $sql = "SELECT id_personal, CONCAT(nombre, ' ', apellido) as nombre_personal FROM personal";
                $resultado = $conn->query($sql);
                while ($fila = $resultado->fetch_assoc()) {
                    echo "<option value='" . $fila["id_personal"] . "'>" . $fila["nombre_personal"] . "</option>";
                }
                ?>
            </select><br>

            <label for="fecha_hora">Fecha de cita:</label>
            <input type="datetime-local" id="fecha_hora" name="fecha_hora" required><br>

            <label for="tipo">Tipo de cita:</label>
            <input type="text" id="tipo" name="tipo" required><br>

            <div class="inputdiv">
                <input type="submit" value="Agregar">
                <?php if (!isset($errorMessage)): ?>
                    <a href="citas.php">Volver a la lista de citas</a>
                <?php else: ?>
                    <div class="error"></div>
                <?php endif; ?>
            </div>
        </form>
    </div>

    <?php include 'assets/footer.html'; ?>
    <div id="footer"></div>
</body>

</html>