<?php
include 'includes/conexion.php';

if (isset($_GET['id'])) {
    $id_personal = $_GET['id'];

    $sql = "DELETE FROM Personal WHERE id_personal = $id_personal";

    if ($conn->query($sql) === TRUE) {
        echo "Registro eliminado correctamente.";
    } else {
        echo "Error al eliminar el registro: " . $conn->error;
    }

    $conn->close();
}
header("Location: personal.php");
exit();
?>
