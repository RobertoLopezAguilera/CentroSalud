<?php
include 'assets/header.php';

if (!isset($_SESSION['userName']) || $_SESSION['userType'] !== 'Personal') {
    $errorMessage = "No tienes permiso para acceder a esta página.";
} else {
    $userName = $_SESSION['userName'];

    if ($userName !== "DR. Roberto") {
        $errorMessage = "No tienes permiso para ver todos los equipos médicos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipos Médicos</title>
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
        <h1>Equipos Médicos</h1>

        <div class="actions">
            <a href="agregar_equipo.php" class="button-29">Agregar Equipo</a>
            <form method="GET" action="equipos.php" class="search-form">
                <input type="text" name="search" placeholder="Buscar por nombre de equipo o área" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <button type="submit" class="button-29">Buscar</button>
                <button type="button" class="button-29" onclick="window.location.href='equipos.php'">Borrar</button>
            </form>
            <a href="descargar_equipos.php?search=<?php echo isset($_GET['search']) ? urlencode($_GET['search']) : ''; ?>" class="button-29">Descargar Excel</a>
        </div>

        <?php
        include 'includes/conexion.php';

        $sql = "SELECT Equipos_Medicos.id_equipo, Equipos_Medicos.nombre_equipo, Equipos_Medicos.estado, Habitaciones.numero AS numero_habitacion, Areas.nombre AS nombre_area, Equipos_Medicos.img 
                FROM Equipos_Medicos 
                JOIN Habitaciones ON Equipos_Medicos.id_habitacion = Habitaciones.id_habitacion 
                JOIN Areas ON Habitaciones.id_area = Areas.id_area";

        if (!empty($_GET['search'])) {
            $search = $conn->real_escape_string($_GET['search']);
            $sql .= " WHERE Equipos_Medicos.nombre_equipo LIKE '%$search%' OR Areas.nombre LIKE '%$search%'";
        }

        $resultado = $conn->query($sql);

        if ($resultado->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Nombre del Equipo</th><th>Estado</th><th>Habitación</th><th>Área</th><th>Imagen</th><th>Acciones</th></tr>";
            while($fila = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $fila["id_equipo"] . "</td>";
                echo "<td>" . htmlspecialchars($fila["nombre_equipo"]) . "</td>";
                echo "<td>" . ($fila["estado"] ? 'Operativo' : 'No operativo') . "</td>";
                echo "<td>" . htmlspecialchars($fila["numero_habitacion"]) . "</td>";
                echo "<td>" . htmlspecialchars($fila["nombre_area"]) . "</td>";
                if ($fila["img"]) {
                    echo "<td><img src='data:image/jpeg;base64," . base64_encode($fila["img"]) . "' alt='Imagen del Equipo' width='100' height='100'></td>";
                } else {
                    echo "<td>No hay imagen</td>";
                }
                echo "<td>";
                echo "<a class='button-33' href='editar_equipo.php?id=" . $fila["id_equipo"] . "'>Editar</a> ";
                echo "<a class='button-34' href='eliminar_equipo.php?id=" . $fila["id_equipo"] . "' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este registro?\")'>Eliminar</a>";
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No se encontraron resultados";
        }

        $conn->close();
        ?>

    <?php endif; ?>
    <?php include 'assets/footer.html'; ?>
    <div id="footer"></div>
</body>
</html>