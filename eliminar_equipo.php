<?php
include 'includes/conexion.php';

if (isset($_GET['id'])) {
    $id_equipo = $_GET['id'];

    $sql = "DELETE FROM Equipos_Medicos WHERE id_equipo = $id_equipo";

    if ($conn->query($sql) === TRUE) {
        echo "Registro eliminado correctamente.";
    } else {
        echo "Error al eliminar el registro: " . $conn->error;
    }

    $conn->close();
}

header("Location: equipos.php");
exit();
?>
