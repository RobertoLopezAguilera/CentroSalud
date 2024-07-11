<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'includes/conexion.php';

    $id_area = $_POST['id'];
    $nombre = trim($_POST['nombre']);

    // Validación del nombre
    if (empty($nombre)) {
        $errorMessage = "El nombre del área es obligatorio.";
    } elseif (!preg_match("/^[A-Za-zÀ-ÿ\s]+$/", $nombre)) {
        $errorMessage = "El nombre del área solo puede contener letras y espacios.";
    } elseif (strlen($nombre) < 2) {
        $errorMessage = "El nombre del área debe tener al menos 2 caracteres.";
    } else {
        // Validación de nombre único
        $sql_verificar = "SELECT * FROM Areas WHERE nombre = ? AND id_area != ?";
        $stmt_verificar = $conn->prepare($sql_verificar);
        $stmt_verificar->bind_param("si", $nombre, $id_area);
        $stmt_verificar->execute();
        $resultado_verificar = $stmt_verificar->get_result();

        if ($resultado_verificar->num_rows > 0) {
            $errorMessage = "El nombre del área ya está registrado. Por favor, utiliza otro nombre.";
        } else {
            // Actualizar el área
            $sql = "UPDATE Areas SET nombre = ? WHERE id_area = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $nombre, $id_area);

            if ($stmt->execute()) {
                echo "<script>
                    alert('Área actualizada exitosamente.');
                    window.location.href = 'areas.php';
                </script>";
            } else {
                echo "<script>
                    alert('Error al actualizar el área: " . addslashes($stmt->error) . "');
                    window.history.back();
                </script>";
            }

            $stmt->close();
        }

        $stmt_verificar->close();
    }

    $conn->close();
} else {
    include 'includes/conexion.php';
    $id_area = $_GET['id'];
    $sql = "SELECT * FROM Areas WHERE id_area = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_area);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        $nombre = $fila['nombre'];
    } else {
        echo "<script>
            alert('No se encontró el área.');
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
    <title>Editar Área</title>
    <link rel="stylesheet" href="css/style.css">
    <script>
        function validarFormulario() {
            const nombreInput = document.getElementById('nombre');
            const nombreValue = nombreInput.value.trim();

            if (nombreValue === '') {
                alert('El nombre del área es obligatorio.');
                return false;
            }

            const nombrePattern = /^[A-Za-zÀ-ÿ\s]+$/;
            if (!nombrePattern.test(nombreValue)) {
                alert('El nombre del área solo puede contener letras, letras con acentos y espacios.');
                return false;
            }

            if (nombreValue.length < 2) {
                alert('El nombre del área debe tener al menos 2 caracteres.');
                return false;
            }

            return true;
        }
    </script>
</head>

<body>
    <?php include 'assets/header.php'; ?>
    <div id="header"></div>
    <h1>Editar Área</h1>
    <?php if (isset($errorMessage)): ?>
        <div class="error"><?php echo $errorMessage; ?></div>
    <?php endif; ?>
    <form id="editarAreaForm" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>"
        onsubmit="return validarFormulario()">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id_area, ENT_QUOTES, 'UTF-8'); ?>">
        <label for="nombre">Nombre del Área:</label>
        <input type="text" id="nombre" name="nombre"
            value="<?php echo htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8'); ?>" required pattern="[A-Za-z\s]+"
            title="Solo letras y espacios permitidos">
        <div class="inputdiv">
            <input type="submit" value="Actualizar">
            <a href="areas.php">Volver a la lista de áreas</a>
        </div>
    </form>
    <?php include 'assets/footer.html'; ?>
    <div id="footer"></div>
</body>

</html>