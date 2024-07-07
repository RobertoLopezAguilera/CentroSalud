<?php
include 'includes/conexion.php';

$id_area = intval($_GET['id_area']);
$sql_habitaciones = "SELECT id_habitacion, numero FROM Habitaciones WHERE id_area = ?";
$stmt_habitaciones = $conn->prepare($sql_habitaciones);
$stmt_habitaciones->bind_param("i", $id_area);
$stmt_habitaciones->execute();
$resultado_habitaciones = $stmt_habitaciones->get_result();

$habitaciones = [];
while($habitacion = $resultado_habitaciones->fetch_assoc()) {
    $habitaciones[] = $habitacion;
}

echo json_encode(['habitaciones' => $habitaciones]);

$stmt_habitaciones->close();
$conn->close();
?>
