<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'includes/conexion.php';

    $id_paciente = filter_var($_POST['id_paciente'], FILTER_SANITIZE_NUMBER_INT);
    $id_area = filter_var($_POST['id_area'], FILTER_SANITIZE_NUMBER_INT);
    $nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
    $apellido = filter_var($_POST['apellido'], FILTER_SANITIZE_STRING);
    $fecha_nacimiento = filter_var($_POST['fecha_nacimiento'], FILTER_SANITIZE_STRING);
    $direccion = filter_var($_POST['direccion'], FILTER_SANITIZE_STRING);
    $telefono = filter_var($_POST['telefono'], FILTER_SANITIZE_STRING);
    $id_cama = filter_var($_POST['id_cama'], FILTER_SANITIZE_NUMBER_INT);

    $sql = "UPDATE pacientes p
            JOIN camas c ON p.id_cama = c.id_cama
            JOIN habitaciones h ON c.id_habitacion = h.id_habitacion
            JOIN areas a ON h.id_area = a.id_area
            SET p.nombre = ?, 
                p.apellido = ?, 
                p.fecha_nacimiento = ?, 
                p.direccion = ?, 
                p.telefono = ?,
                p.id_cama = ?
            WHERE p.id_paciente = ?";

    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('sssssii', $nombre, $apellido, $fecha_nacimiento, $direccion, $telefono, $id_cama, $id_paciente);
        if ($stmt->execute()) {
            echo "<p>Datos del paciente actualizados correctamente.</p>";
        } else {
            echo "<p>Error al actualizar los datos del paciente.</p>";
        }
        $stmt->close();
    } else {
        echo "<p>Error al preparar la consulta de actualización.</p>";
    }

    $conn->close();
} else {
    echo "<p>Acceso no autorizado.</p>";
}
?>
