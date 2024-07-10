<?php
include 'includes/conexion.php';

$numero_cama = $_POST['numero_cama'];
$estado = $_POST['estado'];
$id_habitacion = $_POST['id_habitacion'];

// Verificar si el número de cama ya existe en la misma habitación
$sql_check = "SELECT * FROM camas WHERE numero_cama = ? AND id_habitacion = ?";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("ii", $numero_cama, $id_habitacion);
$stmt_check->execute();
$result_check = $stmt_check->get_result();

if ($result_check->num_rows > 0) {
    $conn->close();
    echo "<script>
            alert('El número de cama ya existe en esta habitación.');
            window.location.href = 'agregar_cama.php?id_habitacion=$id_habitacion';
          </script>";
    exit();
} else {
    $sql = "INSERT INTO camas (numero_cama, estado, id_habitacion) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isi", $numero_cama, $estado, $id_habitacion);

    if ($stmt->execute()) {
        $conn->close();
        header("Location: camas.php?id_habitacion=$id_habitacion");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
