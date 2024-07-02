<?php
include 'includes/conexion.php';

$nombre_equipo = $_POST['nombre_equipo'];
$estado = $_POST['estado'];
$id_habitacion = $_POST['id_habitacion'];
$img = NULL;

if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
    $img = file_get_contents($_FILES['img']['tmp_name']);
}

$sql = "INSERT INTO Equipos_Medicos (nombre_equipo, estado, id_habitacion, img) VALUES (?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("siib", $nombre_equipo, $estado, $id_habitacion, $img);
$stmt->send_long_data(3, $img);

if ($stmt->execute()) {
    echo "Equipo médico agregado correctamente.";
} else {
    echo "Error al agregar el equipo médico: " . $stmt->error;
}

$stmt->close();
$conn->close();

header("Location: equipos.php");
exit();
?>
