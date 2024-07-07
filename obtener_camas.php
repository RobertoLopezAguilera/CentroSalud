<?php
include 'includes/conexion.php';

$id_habitacion = intval($_GET['id_habitacion']);
$sql_camas = "SELECT id_cama, numero_cama FROM Camas WHERE id_habitacion = ?";
$stmt_camas = $conn->prepare($sql_camas);
$stmt_camas->bind_param("i", $id_habitacion);
$stmt_camas->execute();
$resultado_camas = $stmt_camas->get_result();

$camas = [];
while($cama = $resultado_camas->fetch_assoc()) {
    $camas[] = $cama;
}

echo json_encode(['camas' => $camas]);

$stmt_camas->close();
$conn->close();
?>
