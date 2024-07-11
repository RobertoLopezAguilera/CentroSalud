<?php
include 'includes/conexion.php';
include 'assets/header.php';

$numero = intval($_POST['numero']);
$tipo = $_POST['tipo'];
$estado = $_POST['estado'];
$costo = floatval($_POST['costo']);
$id_area = intval($_POST['id_area']);

// Verificar si el número de habitación ya está registrado
$sql_verificar_numero = "SELECT * FROM Habitaciones WHERE numero = '$numero'";
$resultado = $conn->query($sql_verificar_numero);

if ($resultado->num_rows > 0) {
    // Mostrar mensaje de error si el número ya existe
    $_SESSION['error_message'] = "El número de la habitación ya está registrado.";
    header("Location: agregar_habitacion.php");
    exit;
} else {
    // Insertar los datos en la base de datos
    $sql_insertar = "INSERT INTO Habitaciones (numero, tipo, estado, costo, id_area) VALUES ('$numero', '$tipo', '$estado', '$costo', '$id_area')";

    if ($conn->query($sql_insertar) === TRUE) {
        header("Location: habitaciones.php");
        exit;
    } else {
        echo "Error: " . $sql_insertar . "<br>" . $conn->error;
    }
}

$conn->close();
?>
