<?php
if (isset($_GET['id']) && !empty($_GET['id'])) {
    include 'includes/conexion.php';
    
    $id_receta = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    $sql_delete_receta = "DELETE FROM Recetas_Medicas WHERE id_receta = ?";
    $sql_delete_receta_medicamento = "DELETE FROM Receta_Medicamento WHERE id_receta = ?";
    
    $stmt_rm = $conn->prepare($sql_delete_receta_medicamento);
    $stmt_rm->bind_param('i', $id_receta);
    $stmt_rm->execute();

    if ($stmt_rm->affected_rows > 0) {
        $stmt_receta = $conn->prepare($sql_delete_receta);
        $stmt_receta->bind_param('i', $id_receta);
        $stmt_receta->execute();

        if ($stmt_receta->affected_rows > 0) {
            echo "<p>Receta médica eliminada correctamente.</p>";
        } else {
            echo "<p>Error al eliminar la receta médica.</p>";
        }
        $stmt_receta->close();
    } else {
        echo "<p>Error al eliminar la receta de medicamentos.</p>";
    }

    $stmt_rm->close();
    $conn->close();
    header("Location: recetas.php");
    exit();
} else {
    header("Location: recetas.php");
    exit();
}
?>
