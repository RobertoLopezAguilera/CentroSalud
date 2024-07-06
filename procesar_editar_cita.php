<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'includes/conexion.php';

    // Obtener y sanitizar los datos del formulario
    $id_cita = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $id_paciente = filter_var($_POST['id_paciente'], FILTER_SANITIZE_NUMBER_INT);
    $id_personal = filter_var($_POST['id_personal'], FILTER_SANITIZE_NUMBER_INT);
    $fecha_hora = filter_var($_POST['fecha_hora'], FILTER_SANITIZE_STRING);
    $tipo = filter_var($_POST['tipo'], FILTER_SANITIZE_STRING);

    // Verificar que todos los campos están presentes y no están vacíos
    if (!empty($id_cita)) {
        if(!empty($id_paciente)){
        if(!empty($id_personal)){
        
            // Preparar la consulta SQL con los valores entrecomillados adecuadamente
        $sql = "UPDATE citas SET 
        id_paciente = '$id_paciente', 
        id_personal = '$id_personal', 
        fecha_hora = '$fecha_hora', 
        tipo = '$tipo' 
        WHERE id_cita = '$id_cita'";

        // Ejecutar la consulta y manejar el resultado
        if ($conn->query($sql) === TRUE) {
        header("Location: citas.php");
        exit();
        } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
}

        } else {
        echo "Todos los campos son obligatorios.";
    }
    }else{
        echo "Seleccione un paciente valido";
    }
    }else{
        echo "Selecione una cita valida";
    }
    
    $conn->close();
}

/*include 'includes/conexion.php';
    $id_cita = filter_var($_POST['id_cita'], FILTER_SANITIZE_NUMBER_INT);
    $id_paciente = filter_var($_POST['id_paciente'], FILTER_SANITIZE_NUMBER_INT);
    $id_personal = filter_var($_POST['id_personal'], FILTER_SANITIZE_NUMBER_INT);
    $fecha_hora = filter_var($_POST['fecha_hora'], FILTER_SANITIZE_STRING);
    $tipo = filter_var($_POST['tipo'], FILTER_SANITIZE_STRING);

    $sql = "UPDATE citas SET 
            id_paciente = '$id_paciente', 
            id_personal = '$id_personal', 
            fecha_hora = '$fecha_hora', 
            tipo = '$tipo' 
            WHERE id_cita = '$id_cita'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Cita actualizada exitosamente.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
    header("Location: citas.php");
    exit;*/
?>
