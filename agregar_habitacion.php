<?php
include 'assets/header.php';

if (!isset($_SESSION['userName']) || $_SESSION['userType'] !== 'Personal') {
    $errorMessage = "No tienes permiso para acceder a esta página.";
    header("Location: login.php");
    exit;
} else {
    $userName = $_SESSION['userName'];
}

$errorMessage = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : '';
unset($_SESSION['error_message']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Habitación</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div id="header"></div>

    <h1>Agregar Habitación</h1>

    <?php if (!empty($errorMessage)): ?>
        <div class="error"><?php echo $errorMessage; ?></div>
    <?php endif; ?>

    <form id="agregarHabitacionForm" action="procesar_agregar_habitacion.php" method="post">
        <label for="numero">Número:</label>
        <input type="number" id="numero" name="numero" required><br>
        <label for="tipo">Tipo:</label>
        <select id="tipo" name="tipo" required>
            <option value="Individual">Individual</option>
            <option value="Doble">Doble</option>
            <option value="Triple">Triple</option>
        </select><br>
        <label for="estado">Estado:</label>
        <input type="text" id="estado" name="estado" required><br>
        <label for="costo">Costo:</label>
        <input type="number" step="0.01" id="costo" name="costo" required><br>
        <label for="id_area">Área:</label>
        <select id="id_area" name="id_area" required>
            <?php
            include 'includes/conexion.php';
            $sql = "SELECT * FROM Areas";
            $resultado = $conn->query($sql);
            while ($fila = $resultado->fetch_assoc()) {
                echo "<option value='" . $fila["id_area"] . "'>" . $fila["nombre"] . "</option>";
            }
            ?>
        </select><br>
        <div class="inputdiv">
            <input type="submit" value="Agregar">
            <a href="habitaciones.php">Volver a la lista de habitaciones</a>
        </div>
    </form>

    <script>
        document.getElementById('agregarHabitacionForm').addEventListener('submit', function(event) {
            const numeroInput = document.getElementById('numero');
            const costoInput = document.getElementById('costo');
            const numeroValue = parseInt(numeroInput.value);
            const costoValue = parseFloat(costoInput.value);

            if (numeroValue <= 0) {
                alert('El número de la habitación debe ser un valor positivo.');
                event.preventDefault();
                return;
            }

            if (costoValue <= 0 || costoValue > 30000) {
                alert('El costo debe ser un valor positivo y no puede superar los 30,000.');
                event.preventDefault();
            }
        });
    </script>

    <?php include 'assets/footer.html'; ?>
    <div id="footer"></div>
</body>
</html>
<?php
include 'assets/header.php';

if (!isset($_SESSION['userName']) || $_SESSION['userType'] !== 'Personal') {
    $errorMessage = "No tienes permiso para acceder a esta página.";
    header("Location: login.php");
    exit;
} else {
    $userName = $_SESSION['userName'];
}

$errorMessage = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : '';
unset($_SESSION['error_message']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Habitación</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div id="header"></div>

    <h1>Agregar Habitación</h1>

    <?php if (!empty($errorMessage)): ?>
        <div class="error"><?php echo $errorMessage; ?></div>
    <?php endif; ?>

    <form id="agregarHabitacionForm" action="procesar_agregar_habitacion.php" method="post">
        <label for="numero">Número:</label>
        <input type="number" id="numero" name="numero" required><br>
        <label for="tipo">Tipo:</label>
        <select id="tipo" name="tipo" required>
            <option value="Individual">Individual</option>
            <option value="Doble">Doble</option>
            <option value="Triple">Triple</option>
        </select><br>
        <label for="estado">Estado:</label>
        <select id="estado" name="estado" required>
            <option value="Disponible">Disponible</option>
            <option value="Ocupada">Ocupada</option>
        </select><br>
        <label for="costo">Costo:</label>
        <input type="number" step="0.01" id="costo" name="costo" required><br>
        <label for="id_area">Área:</label>
        <select id="id_area" name="id_area" required>
            <?php
            include 'includes/conexion.php';
            $sql = "SELECT * FROM Areas";
            $resultado = $conn->query($sql);
            while ($fila = $resultado->fetch_assoc()) {
                echo "<option value='" . $fila["id_area"] . "'>" . $fila["nombre"] . "</option>";
            }
            ?>
        </select><br>
        <div class="inputdiv">
            <input type="submit" value="Agregar">
            <a href="habitaciones.php">Volver a la lista de habitaciones</a>
        </div>
    </form>

    <script>
        document.getElementById('agregarHabitacionForm').addEventListener('submit', function(event) {
            const numeroInput = document.getElementById('numero');
            const costoInput = document.getElementById('costo');
            const numeroValue = parseInt(numeroInput.value);
            const costoValue = parseFloat(costoInput.value);

            if (numeroValue <= 0) {
                alert('El número de la habitación debe ser un valor positivo.');
                event.preventDefault();
                return;
            }

            if (costoValue <= 0 || costoValue > 30000) {
                alert('El costo debe ser un valor positivo y no puede superar los 30,000.');
                event.preventDefault();
            }
        });
    </script>

    <?php include 'assets/footer.html'; ?>
    <div id="footer"></div>
</body>
</html>
