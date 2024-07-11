<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'includes/conexion.php';

    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $tipo_personal = trim($_POST['tipo_personal']);
    $especialidad = trim($_POST['especialidad']);
    $correo = trim($_POST['correo']);
    $contraseña = sha1(trim($_POST['contraseña']));
    $telefono = trim($_POST['telefono']);

    $sql_verificar = "SELECT * FROM Personal WHERE correo = ?";
    $stmt_verificar = $conn->prepare($sql_verificar);
    $stmt_verificar->bind_param("s", $correo);
    $stmt_verificar->execute();
    $resultado_verificar = $stmt_verificar->get_result();

    if ($resultado_verificar->num_rows > 0) {
        echo "<script>
            alert('El correo ya está registrado. Por favor, utiliza otro correo.');
            window.history.back();
        </script>";
        exit;
    }

    $stmt_verificar->close();

    $sql = "INSERT INTO Personal (nombre, apellido, tipo_personal, especialidad, correo, contraseña, telefono)
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $nombre, $apellido, $tipo_personal, $especialidad, $correo, $contraseña, $telefono);

    if ($stmt->execute()) {
        echo "<script>
            alert('Nuevo personal agregado exitosamente.');
            window.location.href = 'personal.php';
        </script>";
    } else {
        echo "<script>
            alert('Error al agregar el personal: " . addslashes($stmt->error) . "');
            window.history.back();
        </script>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            background: 
                url("Equipos_Medicos/images.png") left no-repeat,
                url("Equipos_Medicos/images.png") right no-repeat;
            margin: 0;
        }
    </style>
    <title>Agregar Personal</title>
    <script>
        function validarFormulario() {
            var nombre = document.getElementById("nombre").value.trim();
            var apellido = document.getElementById("apellido").value.trim();
            var tipoPersonal = document.getElementById("tipo_personal").value.trim();
            var correo = document.getElementById("correo").value.trim();
            var contraseña = document.getElementById("contraseña").value.trim();
            var telefono = document.getElementById("telefono").value.trim();

            if (nombre === "") {
                alert("Por favor, ingrese el nombre.");
                return false;
            }

            if (apellido === "") {
                alert("Por favor, ingrese el apellido.");
                return false;
            }

            if (tipoPersonal === "") {
                alert("Por favor, ingrese el tipo de personal.");
                return false;
            }

            var letrasEspacios = /^[a-zA-Z\s]+$/;
            if (!nombre.match(letrasEspacios) || !apellido.match(letrasEspacios) || !tipoPersonal.match(letrasEspacios)) {
                alert('El nombre y apellido deben contener solo letras y espacios.');
                return false;
            }

            if (!correo.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
                alert("Por favor, ingrese un correo electrónico válido.");
                return false;
            }

            if (contraseña === "") {
                alert("Por favor, ingrese una contraseña.");
                return false;
            }

            if (!telefono.match(/^\d+$/)) {
                alert("Por favor, ingrese un número de teléfono válido.");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
    <?php include 'assets/header.php'; ?>
    <div id="header"></div>

    <h1>Agregar Personal</h1>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return validarFormulario()">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" required>

        <label for="tipo_personal">Tipo de Personal:</label>
        <input type="text" id="tipo_personal" name="tipo_personal" required><br>

        <label for="especialidad">Especialidad:</label>
        <select id="especialidad" name="especialidad">
            <?php
            include 'includes/conexion.php';
            $sql_areas = "SELECT nombre FROM areas WHERE nombre != 'espera'";
            $result_areas = $conn->query($sql_areas);
            while ($row = $result_areas->fetch_assoc()) {
                echo "<option value='".$row['nombre']."'>".$row['nombre']."</option>";
            }
            $conn->close();
            ?>
        </select><br>

        <label for="correo">Correo:</label>
        <input type="email" id="correo" name="correo" required><br>

        <label for="contraseña">Contraseña:</label>
        <input type="password" id="contraseña" name="contraseña" required><br>

        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="telefono" required><br>

        <div class="inputdiv">
            <input type="submit" value="Agregar">
            <a href="personal.php">Volver a la lista de personal</a>
        </div>
    </form>
    
    <?php include 'assets/footer.html'; ?>
    <div id="footer"></div>
</body>
</html>
