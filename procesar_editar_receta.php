<?php
// Verificación de que se han recibido los datos del formulario mediante POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Incluir archivo de conexión a la base de datos
    include 'includes/conexion.php';

    // Obtener y sanitizar los datos del formulario
    $id_receta = filter_var($_POST['id_receta'], FILTER_SANITIZE_NUMBER_INT);
    $id_personal = filter_var($_POST['id_personal'], FILTER_SANITIZE_NUMBER_INT);
    $fecha_emision = $_POST['fecha_emision']; // No se necesita sanitización para campos de fecha y texto
    $observaciones = $_POST['observaciones'];
    $dosis = $_POST['dosis'];
    $id_medicamento = filter_var($_POST['id_medicamento'], FILTER_SANITIZE_NUMBER_INT);

    // Consulta SQL para actualizar la receta médica
    $sql_update_receta = "UPDATE Recetas_Medicas
                          SET id_personal = ?, fecha_emision = ?, observaciones = ?
                          WHERE id_receta = ?";
    
    // Consulta SQL para actualizar la receta de medicamentos
    $sql_update_medicamento = "UPDATE Receta_Medicamento
                               SET dosis = ?, id_medicamento = ?
                               WHERE id_receta = ?";

    // Preparar y ejecutar la consulta de actualización de Recetas_Medicas
    $stmt_receta = $conn->prepare($sql_update_receta);

    if ($stmt_receta) {
        $stmt_receta->bind_param('issi', $id_personal, $fecha_emision, $observaciones, $id_receta);
        $stmt_receta->execute();

        // Verificar si la actualización fue exitosa
        if ($stmt_receta->affected_rows > 0) {
            // Preparar y ejecutar la consulta de actualización de Receta_Medicamento
            $stmt_medicamento = $conn->prepare($sql_update_medicamento);

            if ($stmt_medicamento) {
                $stmt_medicamento->bind_param('sii', $dosis, $id_medicamento, $id_receta);
                $stmt_medicamento->execute();

                // Verificar si la actualización fue exitosa
                if ($stmt_medicamento->affected_rows > 0) {
                    echo "<p>Receta médica actualizada correctamente.</p>";
                } else {
                    echo "<p>Error al actualizar la receta de medicamentos.</p>";
                }
            } else {
                echo "<p>Error al preparar la consulta de actualización de medicamentos.</p>";
            }
            $stmt_medicamento->close();
        } else {
            echo "<p>Error al actualizar la receta médica.</p>";
        }
        $stmt_receta->close();
    } else {
        echo "<p>Error al preparar la consulta de actualización.</p>";
    }

    // Cerrar la conexión a la base de datos
    $conn->close();

    // Redirigir a la página de recetas médicas después de la actualización
    header("Location: recetas.php");
    exit();

} else {
    // Redireccionar si se intenta acceder directamente al archivo sin datos POST
    header("Location: recetas.php");
    exit();
}
?>
