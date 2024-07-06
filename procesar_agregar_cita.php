<?php
include 'includes/conexion.php';
$id_paciente = $_POST['id_paciente'];
$id_personal = $_POST['id_personal'];
$fecha_hora = $_POST['fecha_hora'];
$tipo = $_POST['tipo'];

$sql = "INSERT INTO citas (id_paciente, id_personal, fecha_hora, tipo) 
VALUES ('$id_paciente', '$id_personal', '$fecha_hora', '$tipo')";

if ($conn->query($sql) === TRUE) {
    echo "Nueva cita agregada exitosamente.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("Location: citas.php");
exit;

/*if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'includes/conexion.php';
    // Asegurarse de que el campo id_paciente ha sido enviado
    if (isset($_POST['id_paciente']) && !empty($_POST['id_personal'])) {
        $id_paciente = isset($_POST['id_paciente']) ? filter_var($_POST['id_paciente'], FILTER_SANITIZE_NUMBER_INT) : null;
        $id_personal = isset($_POST['id_personal']) ? filter_var($_POST['id_personal'], FILTER_SANITIZE_NUMBER_INT) : null;
        $fecha_hora = isset($_POST['fecha_hora']) ? date('Y-m-d H:i:s', strtotime($_POST['fecha_hora'])) : null;
        $tipo = isset($_POST['tipo']) ? $_POST['tipo'] : '';
            // Obtener el valor de la opción seleccionada
           /* $id_paciente = filter_var($_POST['id_paciente'], FILTER_SANITIZE_NUMBER_INT);
            $id_personal = filter_var($_POST['id_personal'], FILTER_SANITIZE_NUMBER_INT);
            $fecha_hora = date('Y-m-d H:i:s', strtotime($_POST['fecha_hora']));
            $tipo = $_POST['tipo'];*/
    
              /*  $sql = "INSERT INTO citas (id_paciente, id_personal, fecha_hora, tipo) 
                        VALUES ('$id_paciente', '$id_personal', '$fecha_hora', '$tipo')";
        
                if ($conn->query($sql) === TRUE) {
                    header("Location: citas.php");
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
        
            $conn->close();
        
    }else {
        echo "No se ha seleccionado ningún paciente.";
    }
} else {
    echo "Método de solicitud no válido.";
}*/
?>



