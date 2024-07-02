<?php
include 'includes/conexion.php';

$id_equipo = $_POST['id_equipo'];
$nombre_equipo = $_POST['nombre_equipo'];
$estado = $_POST['estado'];
$id_habitacion = $_POST['id_habitacion'];

if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
    $img = file_get_contents($_FILES['img']['tmp_name']);
    $sql = "UPDATE Equipos_Medicos SET nombre_equipo = ?, estado = ?, id_habitacion = ?, img = ? WHERE id_equipo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("siibi", $nombre_equipo, $estado, $id_habitacion, $img, $id_equipo);
    $stmt->send_long_data(3, $img);
} else {
    $sql = "UPDATE Equipos_Medicos SET nombre_equipo = ?, estado = ?, id_habitacion = ? WHERE id_equipo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("siis", $nombre_equipo, $estado, $id_habitacion, $id_equipo);
}

if ($stmt->execute()) {
    echo "Equipo médico actualizado correctamente.";
} else {
    echo "Error al actualizar el equipo médico: " . $stmt->error;
}

$stmt->close();
$conn->close();

header("Location: equipos.php");
exit();
?>
