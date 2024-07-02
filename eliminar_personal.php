<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'includes/conexion.php';

    $id_personal = $_POST['id_personal'];

    $sql = "DELETE FROM Personal WHERE id_personal=$id_personal";

    if ($conn->query($sql) === TRUE) {
        echo "Registro eliminado correctamente.";
    } else {
        echo "Error al eliminar el registro: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Personal</title>
</head>
<body>
    <h1>Eliminar Personal</h1>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="id_personal">ID del Personal:</label><br>
        <input type="text" id="id_personal" name="id_personal"><br><br>
        <input type="submit" value="Eliminar">
    </form>
</body>
</html>
