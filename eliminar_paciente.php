<?php
include 'includes/conexion.php';

if (isset($_GET['id'])) {
    $id_paciente = $_GET['id'];

    $sql = "DELETE FROM Pacientes WHERE id_paciente = $id_paciente";

    if ($conn->query($sql) === TRUE) {
        echo "Registro eliminado correctamente.";
    } else {
        echo "Error al eliminar el registro: " . $conn->error;
    }

    $conn->close();
}
header("Location: pacientes.php");
exit();
?>