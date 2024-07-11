<?php
include 'assets/header.php';

if (!isset($_SESSION['userName']) || $_SESSION['userType'] !== 'Personal') {
    $errorMessage = "No tienes permiso para acceder a esta página.";
} else {
    $userName = $_SESSION['userName'];

    if ($userName !== "DR. Roberto") {
        $errorMessage = "No tienes permiso para ver todas las áreas.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Área</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php if (isset($errorMessage)): ?>
        <div class="error"><?php echo $errorMessage; ?></div>
    <?php else: ?>
        <div id="header"></div>

    <h1>Agregar Nueva Área</h1>
    <form id="agregarAreaForm" action="procesar_agregar_area.php" method="post">
        <label for="nombre">Nombre del Área:</label>
        <input type="text" id="nombre" name="nombre" required pattern="[A-Za-z\s]+" title="Solo letras y espacios permitidos">
        <div class="inputdiv">
            <input type="submit" value="Agregar">
            <a href="areas.php">Volver a la lista de áreas</a>
        </div>
    </form>
    <?php endif; ?>

    <script>
    document.getElementById('agregarAreaForm').addEventListener('submit', function(event) {
        const nombreInput = document.getElementById('nombre');
        const nombreValue = nombreInput.value.trim();

        if (nombreValue === '') {
            alert('El nombre del área es obligatorio.');
            event.preventDefault();
            return;
        }

        // Expresión regular que acepta letras, espacios y acentos
        const nombrePattern = /^[A-Za-z\u00C0-\u00FF\s]+$/;

        if (!nombrePattern.test(nombreValue)) {
            alert('El nombre del área solo puede contener letras, espacios y acentos.');
            event.preventDefault();
            return;
        }

        if (nombreValue.length < 2) {
            alert('El nombre del área debe tener al menos 2 caracteres.');
            event.preventDefault();
        }
    });
</script>
    <?php include 'assets/footer.html'; ?>
    <div id="footer"></div>
</body>
</html>
