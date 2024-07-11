<?php
include 'assets/header.php';

if (!isset($_SESSION['userName']) || $_SESSION['userType'] !== 'Personal') {
    $errorMessage = "No tienes permiso para acceder a esta página.";
} else {
    $userName = $_SESSION['userName'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citas Médicas</title>
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
        <h1>Citas Médicas</h1>
        <div class="actions">
                <a href="agregar_cita.php" class="button-29">Agregar Cita Médica</a>
            <form method="GET" action="citas.php" class="search-form">
                <input type="text" name="search" placeholder="Buscar por paciente o médico" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <button type="submit" class="button-29">Buscar</button>
                <button type="button" class="button-29" onclick="window.location.href='citas.php'">Borrar</button>
            </form>
            <a href="descargar_excel_citas.php?search=<?php echo isset($_GET['search']) ? urlencode($_GET['search']) : ''; ?>" class="button-29">Descargar Excel</a>
        </div>
        <?php
        include 'includes/conexion.php';

        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        if ($userName === "DR. Roberto") {
            $sql = "SELECT 
                        c.id_cita,
                        CONCAT(p.nombre, ' ', p.apellido) AS paciente_completo,
                        CONCAT(m.nombre, ' ', m.apellido) AS medico_completo,
                        c.fecha_hora,
                        c.tipo
                    FROM 
                        citas c
                    JOIN 
                        pacientes p ON c.id_paciente = p.id_paciente
                    JOIN 
                        personal m ON c.id_personal = m.id_personal";
        } else {
            $sql = "SELECT 
                        c.id_cita,
                        CONCAT(p.nombre, ' ', p.apellido) AS paciente_completo,
                        CONCAT(m.nombre, ' ', m.apellido) AS medico_completo,
                        c.fecha_hora,
                        c.tipo
                    FROM 
                        citas c
                    JOIN 
                        pacientes p ON c.id_paciente = p.id_paciente
                    JOIN 
                        personal m ON c.id_personal = m.id_personal
                    WHERE 
                        m.nombre = ?";
        }

        $stmt = $conn->prepare($sql);
        
        if ($userName !== "DR. Roberto") {
            $stmt->bind_param("s", $userName);
        }

        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Paciente</th><th>Medico</th><th>Fecha de Cita</th><th>Tipo de Cita</th><th>Acciones</th></tr>";
            while($fila = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($fila["id_cita"]) . "</td>";
                echo "<td>" . htmlspecialchars($fila["paciente_completo"]) . "</td>";
                echo "<td>" . htmlspecialchars($fila["medico_completo"]) . "</td>";
                echo "<td>" . htmlspecialchars($fila["fecha_hora"]) . "</td>";
                echo "<td>" . htmlspecialchars($fila["tipo"]) . "</td>";
                echo "<td>";
                echo "<a class='button-33' href='editar_cita.php?id=" . htmlspecialchars($fila["id_cita"]) . "'>Editar</a>";
                echo "<a class='button-34' href='eliminar_cita.php?id=" . htmlspecialchars($fila["id_cita"]) . "' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este registro?\")'>Eliminar</a>";
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No se encontraron citas.";
        }

        $stmt->close();
        $conn->close();
        ?>
    <?php endif; ?>
    <?php include 'assets/footer.html'; ?>
</body>
</html>
