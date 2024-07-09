<?php
include 'assets/header.php';

if (!isset($_SESSION['userName']) || $_SESSION['userType'] !== 'Personal') {
    $errorMessage = "No tienes permiso para acceder a esta página.";
} else {
    $userName = $_SESSION['userName'];

    if ($userName !== "DR. Roberto") {
        $errorMessage = "No tienes permiso para ver todas las recetas.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recetas Médicas</title>
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
        .a_excel svg {
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <?php if (isset($errorMessage)): ?>
        <div class="error"><?php echo $errorMessage; ?></div>
    <?php else: ?>
        <div id="header"></div>
        <h1>Recetas Médicas</h1>
        
        <div class="actions">
            <a href="agregar_receta_medica.php" class="button-29">Agregar Receta</a>
            <form method="GET" action="recetas.php" class="search-form">
                <input type="text" name="search" placeholder="Buscar por paciente o medicamento" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <button type="submit" class="button-29">Buscar</button>
                <button type="button" class="button-29" onclick="window.location.href='recetas.php'">Borrar</button>
            </form>
            <a href="descargar_excel.php?search=<?php echo isset($_GET['search']) ? urlencode($_GET['search']) : ''; ?>" class="button-29">Descargar 
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 48 48">
                    <defs>
                        <mask id="IconifyId1908b6f9a94f46a6f2">
                            <g fill="none" stroke-linecap="round" stroke-width="4">
                                <path stroke="#fff" stroke-linejoin="round" d="M8 15V6a2 2 0 0 1 2-2h28a2 2 0 0 1 2 2v36a2 2 0 0 1-2 2H10a2 2 0 0 1-2-2v-9"/>
                                <path stroke="#fff" d="M31 15h3m-6 8h6m-6 8h6"/>
                                <path fill="#fff" stroke="#fff" stroke-linejoin="round" d="M4 15h18v18H4z"/>
                                <path stroke="#000" stroke-linejoin="round" d="m10 21l6 6m0-6l-6 6"/>
                            </g>
                        </mask>
                    </defs>
                    <path fill="#ffffff" d="M0 0h48v48H0z" mask="url(#IconifyId1908b6f9a94f46a6f2)"/>
                </svg>
            </a>
        </div>

        <?php
        include 'includes/conexion.php';

        $search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';

        $sql = "SELECT 
                    p.nombre AS nombre_paciente, 
                    p.apellido AS apellido_paciente, 
                    pe.nombre AS nombre_personal, 
                    pe.apellido AS apellido_personal, 
                    r.fecha_emision, 
                    r.observaciones, 
                    rm.dosis, 
                    rm.id_receta,
                    m.nombre AS nombre_medicamento
                FROM 
                    Recetas_Medicas r
                JOIN 
                    Pacientes p ON r.id_paciente = p.id_paciente
                JOIN 
                    Personal pe ON r.id_personal = pe.id_personal
                JOIN 
                    Receta_Medicamento rm ON r.id_receta = rm.id_receta
                JOIN 
                    Medicamentos m ON rm.id_medicamento = m.id_medicamento";

        if (!empty($search)) {
            $sql .= " WHERE p.nombre LIKE '%$search%' 
                      OR p.apellido LIKE '%$search%' 
                      OR m.nombre LIKE '%$search%' 
                      OR pe.nombre LIKE '%$search%'
                      OR pe.apellido LIKE '%$search%'";
        }

        $resultado = $conn->query($sql);

        if ($resultado->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Paciente</th><th>Personal Médico</th><th>Fecha Emisión</th><th>Observaciones</th><th>Dosis</th><th>Medicamento</th><th>Acciones</th></tr>";
            while($fila = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($fila["nombre_paciente"]) . " " . htmlspecialchars($fila["apellido_paciente"]) . "</td>";
                echo "<td>" . htmlspecialchars($fila["nombre_personal"]) . " " . htmlspecialchars($fila["apellido_personal"]) . "</td>";
                echo "<td>" . htmlspecialchars($fila["fecha_emision"]) . "</td>";
                echo "<td>" . htmlspecialchars($fila["observaciones"]) . "</td>";
                echo "<td>" . htmlspecialchars($fila["dosis"]) . "</td>";
                echo "<td>" . htmlspecialchars($fila["nombre_medicamento"]) . "</td>";
                echo "<td>";
                echo "<a class='button-33' href='editar_receta.php?id=" . htmlspecialchars($fila["id_receta"]) . "'>Editar</a>";
                echo "<a class='button-34' href='eliminar_receta.php?id=" . htmlspecialchars($fila["id_receta"]) . "' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este registro?\")'>Eliminar</a>";
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No se encontraron recetas.";
        }

        $conn->close();
        ?>
        <?php include 'assets/footer.html'; ?>
        <div id="footer"></div>
    <?php endif; ?>
</body>
</html>
