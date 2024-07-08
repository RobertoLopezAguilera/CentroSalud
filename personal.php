<?php
include 'assets/header.php';

if (!isset($_SESSION['userName']) || $_SESSION['userType'] !== 'Personal') {
    $errorMessage = "No tienes permiso para acceder a esta página.";
} else {
    $userName = $_SESSION['userName'];
    if ($userName !== "DR. Roberto Lopez") {
        $errorMessage = "No tienes permiso para acceder a esta página.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'assets/header.php'; ?>
    <div id="header"></div>

    <h1>Personal Médico y Administrativo</h1>
    <a class="button-29" href="agregar_personal.php">Agregar Nuevo Personal</a>
    <?php
    include 'includes/conexion.php';

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM Personal";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Nombre</th><th>Apellido</th><th>Tipo de Personal</th><th>Especialidad</th><th>Correo</th><th>Teléfono</th><th>Acciones</th></tr>";
        while($fila = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($fila["id_personal"]) . "</td>";
            echo "<td>" . htmlspecialchars($fila["nombre"]) . "</td>";
            echo "<td>" . htmlspecialchars($fila["apellido"]) . "</td>";
            echo "<td>" . htmlspecialchars($fila["tipo_personal"]) . "</td>";
            echo "<td>" . htmlspecialchars($fila["especialidad"]) . "</td>";
            echo "<td>" . htmlspecialchars($fila["Correo"]) . "</td>";
            echo "<td>" . htmlspecialchars($fila["telefono"]) . "</td>";
            echo "<td>";
            echo "<a class='button-33' href='editar_personal.php?id=" . htmlspecialchars($fila["id_personal"]) . "'>Editar</a>";
            echo "<a class='button-34' href='eliminar_personal.php?id=" . htmlspecialchars($fila["id_personal"]) . "' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este registro?\")'>Eliminar</a>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No se encontraron resultados";
    }

    $conn->close();
    ?>

    <?php include 'assets/footer.html'; ?>
    <div id="footer"></div>
</body>
</html>