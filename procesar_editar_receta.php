<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'includes/conexion.php';

    $id_receta = filter_var($_POST['id_receta'], FILTER_SANITIZE_NUMBER_INT);
    $id_personal = filter_var($_POST['id_personal'], FILTER_SANITIZE_NUMBER_INT);
    $fecha_emision = $_POST['fecha_emision']; 
    $observaciones = $_POST['observaciones'];
    $dosis = $_POST['dosis'];
    $id_medicamento = filter_var($_POST['id_medicamento'], FILTER_SANITIZE_NUMBER_INT);

    $sql_update = "UPDATE Recetas_Medicas
                   SET id_personal = ?, fecha_emision = ?, observaciones = ?
                   WHERE id_receta = ?";
    
    $sql_update_rm = "UPDATE Receta_Medicamento
                      SET dosis = ?, id_medicamento = ?
                      WHERE id_receta = ?";

    $stmt_update = $conn->prepare($sql_update);

    if ($stmt_update) {
        $stmt_update->bind_param('issi', $id_personal, $fecha_emision, $observaciones, $id_receta);
        $stmt_update->execute();

        if ($stmt_update->affected_rows > 0) {
            $stmt_update_rm = $conn->prepare($sql_update_rm);

            if ($stmt_update_rm) {
                $stmt_update_rm->bind_param('sii', $dosis, $id_medicamento, $id_receta);
                $stmt_update_rm->execute();
                if ($stmt_update_rm->affected_rows > 0) {
                    echo "<p>Receta médica actualizada correctamente.</p>";
                } else {
                    echo "<p>Error al actualizar la receta de medicamentos.</p>";
                }
            } else {
                echo "<p>Error al preparar la consulta de actualización de medicamentos.</p>";
            }
            $stmt_update_rm->close();
        } else {
            echo "<p>Error al actualizar la receta médica.</p>";
        }
        $stmt_update->close();
    } else {
        echo "<p>Error al preparar la consulta de actualización.</p>";
    }

    $conn->close();

} else {
    header("Location: recetas.php");
    exit();
}
?>
