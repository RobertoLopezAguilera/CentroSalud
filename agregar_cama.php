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

$id_habitacion = isset($_GET['id_habitacion']) ? intval($_GET['id_habitacion']) : 0;
$numero_habitacion = "";

if ($id_habitacion > 0) {
    include 'includes/conexion.php';
    $sql = "SELECT numero FROM Habitaciones WHERE id_habitacion = $id_habitacion";
    $resultado = $conn->query($sql);
    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        $numero_habitacion = htmlspecialchars($fila['numero']);
    }
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Cama</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php if (isset($errorMessage)): ?>
    <div class="error"><?php echo $errorMessage; ?></div>
<?php else: ?>
    <div id="header"></div>
    
    <h1>Agregar Cama</h1>
    <form id="agregarCamaForm" action="procesar_agregar_cama.php" method="post">
        <input type="hidden" name="id_habitacion" value="<?php echo $id_habitacion; ?>">

        <label for="numero_cama">Número de la cama:</label>
        <input type="text" id="numero_cama" name="numero_cama" required pattern="\d+" title="Solo se permiten números.">

        <label for="estado">Estado:</label>
        <select id="estado" name="estado" required>
            <option value="">Seleccione un estado</option>
            <option value="Disponible">Disponible</option>
            <option value="Ocupada">Ocupada</option>
            <option value="Mantenimiento">Mantenimiento</option>
        </select>

        <label for="numero_habitacion">Número de Habitación:</label>
        <input type="text" id="numero_habitacion" name="numero_habitacion" value="<?php echo $numero_habitacion; ?>" readonly>

        <div class="inputdiv">
            <input type="submit" value="Agregar">
            <a href="camas.php?id_habitacion=<?php echo $id_habitacion; ?>">Volver a la lista de camas</a>
        </div>
    </form>
<?php endif; ?>
<?php include 'assets/footer.html'; ?>
<div id="footer"></div>

<script>
    document.getElementById('agregarCamaForm').addEventListener('submit', function(event) {
        const numeroCamaInput = document.getElementById('numero_cama');
        const estadoSelect = document.getElementById('estado');
        
        const numeroCamaValue = numeroCamaInput.value.trim();
        const estadoValue = estadoSelect.value;

        if (numeroCamaValue === '' || !/^\d+$/.test(numeroCamaValue)) {
            alert('El número de la cama es obligatorio y solo puede contener números.');
            event.preventDefault();
            return;
        }

        if (estadoValue === '') {
            alert('Seleccione un estado para la cama.');
            event.preventDefault();
        }
    });
</script>
</body>
</html>
