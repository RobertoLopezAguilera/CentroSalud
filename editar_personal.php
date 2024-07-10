<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'includes/conexion.php';

    $id_personal = $_POST['id_personal'];
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $tipo_personal = trim($_POST['tipo_personal']);
    $especialidad = trim($_POST['especialidad']);
    $correo = trim($_POST['correo']);
    $telefono = trim($_POST['telefono']);

    $sql_verificar = "SELECT * FROM Personal WHERE correo = ? AND id_personal != ?";
    $stmt_verificar = $conn->prepare($sql_verificar);
    $stmt_verificar->bind_param("si", $correo, $id_personal);
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

    $sql = "UPDATE Personal SET nombre=?, apellido=?, tipo_personal=?, especialidad=?, correo=?, telefono=? WHERE id_personal=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $nombre, $apellido, $tipo_personal, $especialidad, $correo, $telefono, $id_personal);

    if ($stmt->execute()) {
        echo "<script>
            alert('Datos del personal actualizados exitosamente.');
            window.location.href = 'personal.php';
        </script>";
    } else {
        echo "<script>
            alert('Error al actualizar los datos: " . addslashes($stmt->error) . "');
            window.history.back();
        </script>";
    }

    $stmt->close();
    $conn->close();
} else {
    $id_personal = $_GET['id'];
    include 'includes/conexion.php';
    $sql = "SELECT * FROM Personal WHERE id_personal=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_personal);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        $nombre = $fila['nombre'];
        $apellido = $fila['apellido'];
        $tipo_personal = $fila['tipo_personal'];
        $especialidad = $fila['especialidad'];
        $correo = $fila['correo'];
        $telefono = $fila['telefono'];
    } else {
        echo "<script>
            alert('No se encontró el registro.');
            window.history.back();
        </script>";
        exit; 
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Personal</title>
    <link rel="stylesheet" href="css/style.css">
    <script>
        function validarFormulario() {
            var nombre = document.getElementById("nombre").value.trim();
            var apellido = document.getElementById("apellido").value.trim();
            var tipoPersonal = document.getElementById("tipo_personal").value.trim();
            var correo = document.getElementById("correo").value.trim();
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

            if (!correo.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
                alert("Por favor, ingrese un correo electrónico válido.");
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
    <h1>Editar Datos de Personal</h1>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return validarFormulario()">
        <input type="hidden" name="id_personal" value="<?php echo $id_personal; ?>">
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8'); ?>" required><br><br>
        <label for="apellido">Apellido:</label><br>
        <input type="text" id="apellido" name="apellido" value="<?php echo htmlspecialchars($apellido, ENT_QUOTES, 'UTF-8'); ?>" required><br><br>
        <label for="tipo_personal">Tipo de Personal:</label><br>
        <input type="text" id="tipo_personal" name="tipo_personal" value="<?php echo htmlspecialchars($tipo_personal, ENT_QUOTES, 'UTF-8'); ?>" required><br><br>
        <label for="especialidad">Especialidad:</label><br>
        <input type="text" id="especialidad" name="especialidad" value="<?php echo htmlspecialchars($especialidad, ENT_QUOTES, 'UTF-8'); ?>"><br><br>
        <label for="correo">Correo Electrónico:</label><br>
        <input type="email" id="correo" name="correo" value="<?php echo htmlspecialchars($correo, ENT_QUOTES, 'UTF-8'); ?>" required><br><br>
        <label for="telefono">Teléfono:</label><br>
        <input type="text" id="telefono" name="telefono" value="<?php echo htmlspecialchars($telefono, ENT_QUOTES, 'UTF-8'); ?>" required><br><br>
        <div class="inputdiv">
            <input type="submit" value="Actualizar">
            <a href="personal.php">Volver a la lista de personal</a>
        </div>
    </form>
    <?php include 'assets/footer.html'; ?>
    <div id="footer"></div>
</body>
</html>
