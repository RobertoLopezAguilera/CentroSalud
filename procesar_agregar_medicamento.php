<?php
include 'includes/conexion.php';

$nombre = trim($_POST['nombre']);
$descripcion = trim($_POST['descripcion']);
$stock = intval($_POST['stock']);
$precio = floatval($_POST['precio']);
$fecha_caducidad = $_POST['fecha_caducidad'];

$errores = [];

$sql_verificar = "SELECT * FROM Medicamentos WHERE nombre = ?";
$stmt_verificar = $conn->prepare($sql_verificar);
$stmt_verificar->bind_param("s", $nombre);
$stmt_verificar->execute();
$resultado_verificar = $stmt_verificar->get_result();

if ($resultado_verificar->num_rows > 0) {
    $errores[] = "Ya existe un medicamento con el mismo nombre.";
}

$stmt_verificar->close();

if (count($errores) > 0) {
    $errores_js = json_encode($errores);
    echo "<script>
        var errores = $errores_js;
        errores.forEach(function(error) {
            alert(error);
        });
        window.history.back();
    </script>";
    exit;
}

$sql = "INSERT INTO Medicamentos (nombre, descripcion, stock, precio, fecha_caducidad) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssids", $nombre, $descripcion, $stock, $precio, $fecha_caducidad);

if ($stmt->execute()) {
    echo "<script>
        alert('Nuevo medicamento agregado exitosamente.');
        window.location.href = 'medicamentos.php';
    </script>";
} else {
    $error_insertar = $stmt->error;
    echo "<script>
        alert('Error al agregar el medicamento: " . addslashes($error_insertar) . "');
        window.history.back();
    </script>";
}

$stmt->close();
$conn->close();
?>
