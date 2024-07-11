<?php
include 'includes/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_paciente = isset($_POST['id_paciente']) ? filter_var($_POST['id_paciente'], FILTER_SANITIZE_NUMBER_INT) : null;
    $id_personal = isset($_POST['id_personal']) ? filter_var($_POST['id_personal'], FILTER_SANITIZE_NUMBER_INT) : null;
    $fecha_hora = isset($_POST['fecha_hora']) ? date('Y-m-d H:i:s', strtotime($_POST['fecha_hora'])) : null;
    $tipo = isset($_POST['tipo']) ? $_POST['tipo'] : '';

    if (!empty($id_paciente) && !empty($id_personal) && !empty($fecha_hora) && !empty($tipo)) {
        $sql = "INSERT INTO citas (id_paciente, id_personal, fecha_hora, tipo) 
                VALUES ('$id_paciente', '$id_personal', '$fecha_hora', '$tipo')";

        if ($conn->query($sql) === TRUE) {
            // Redirigir según el tipo de usuario
            session_start();
            if ($_SESSION['userType'] === 'Personal') {
                header('Location: vistaPer_index.php');
                exit;
            } else {
                echo "<script>alert('Nueva cita agregada exitosamente.'); window.location.href='vistaPac_index.php';</script>";
            }
        } else {
            echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Todos los campos son obligatorios.'); window.history.back();</script>";
    }

    $conn->close();
} else {
    echo "<script>alert('Método de solicitud no válido.'); window.history.back();</script>";
}
?>
