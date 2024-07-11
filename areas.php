<?php
include 'assets/header.php';

if (!isset($_SESSION['userName']) || $_SESSION['userType'] !== 'Personal') {
    $errorMessage = "No tienes permiso para acceder a esta página.";
} else {
    $userName = $_SESSION['userName'];

    if ($userName !== "DR. Roberto") {
        $errorMessage = "No tienes permiso para ver todas las áreas.";
    }
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Áreas del Hospital</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .search-form {
            display: flex;
            align-items: center;
        }
        .search-form input[type="text"] {
            margin-right: 10px;
        }
        .button-29 {
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <?php if (isset($errorMessage)): ?>
        <div class="error"><?php echo $errorMessage; ?></div>
    <?php else: ?>
        <div id="header"></div>
        <h1>Áreas del Hospital</h1>
        
        <div class="actions">
            <a href="agregar_area.php" class="button-29">Agregar Área</a>
            <form method="GET" action="areas.php" class="search-form">
                <input type="text" name="search" placeholder="Buscar por nombre" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <button type="submit" class="button-29">Buscar</button>
                <button type="button" class="button-29" onclick="window.location.href='areas.php'">Borrar</button>
            </form>
            <a href="descargar_excel_areas.php?search=<?php echo isset($_GET['search']) ? urlencode($_GET['search']) : ''; ?>" class="button-29">Descargar Excel</a>
        </div>

        <?php
        include 'includes/conexion.php';

        $search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';

        $sql = "SELECT * FROM Areas";

        if (!empty($search)) {
            $sql .= " WHERE nombre LIKE '%$search%'";
        }

        $resultado = $conn->query($sql);

        if ($resultado->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Nombre</th><th>Acciones</th></tr>";
            while($fila = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($fila["id_area"]) . "</td>";
                echo "<td>" . htmlspecialchars($fila["nombre"]) . "</td>";
                echo "<td>";
                echo "<a class='button-33' href='editar_area.php?id=" . htmlspecialchars($fila["id_area"]) . "'>Editar</a>";
                echo "<a class='button-34' href='eliminar_area.php?id=" . htmlspecialchars($fila["id_area"]) . "' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este registro?\")'>Eliminar</a>";
                echo "<a class='button-29' href='habitaciones.php?id_area=" . htmlspecialchars($fila["id_area"]) . "'>Ver Habitaciones</a>";

                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No se encontraron áreas.";
        }

        $conn->close();
        ?>
        <?php include 'assets/footer.html'; ?>
        <div id="footer"></div>
    <?php endif; ?>
</body>
</html>