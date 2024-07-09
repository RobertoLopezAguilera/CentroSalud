<?php
include 'assets/header.php';

if (!isset($_SESSION['userName']) || $_SESSION['userType'] !== 'Personal') {
    $errorMessage = "No tienes permiso para acceder a esta página.";
} else {
    $userName = $_SESSION['userName'];

    if ($userName !== "DR. Roberto") {
        $errorMessage = "No tienes permiso para ver todos los medicamentos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicamentos</title>
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
        <h1>Lista de medicamentos</h1>
        
        <div class="actions">
            <a href="agregar_medicamento.php" class="button-29">Agregar Medicamento</a>
            
            <form method="GET" action="medicamentos.php" class="search-form">
                <input type="text" name="search" placeholder="Buscar por nombre o descripción" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <button type="submit" class="button-29">Buscar</button>
                <button type="button" class="button-29" onclick="window.location.href='medicamentos.php'">Borrar</button>
            </form>
            
            <a href="descargar_medicamentos.php?search=<?php echo isset($_GET['search']) ? urlencode($_GET['search']) : ''; ?>" class="button-29">Descargar 
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

        $sql = "SELECT * FROM Medicamentos";
        
        if (!empty($search)) {
            $sql .= " WHERE nombre LIKE '%$search%' OR descripcion LIKE '%$search%'";
        }

        $resultado = $conn->query($sql);

        if ($resultado->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Nombre</th><th>Descripción</th><th>Stock</th><th>Precio</th><th>Fecha de Caducidad</th><th>Acciones</th></tr>";
            while($fila = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($fila["id_medicamento"]) . "</td>";
                echo "<td>" . htmlspecialchars($fila["nombre"]) . "</td>";
                echo "<td>" . htmlspecialchars($fila["descripcion"]) . "</td>";
                echo "<td>" . htmlspecialchars($fila["stock"]) . "</td>";
                echo "<td>" . htmlspecialchars($fila["precio"]) . "</td>";
                echo "<td>" . htmlspecialchars($fila["fecha_caducidad"]) . "</td>";
                echo "<td>";
                echo "<a class='button-33' href='editar_medicamento.php?id=" . htmlspecialchars($fila["id_medicamento"]) . "'>Editar</a>";
                echo "<a class='button-34' href='eliminar_medicamento.php?id=" . htmlspecialchars($fila["id_medicamento"]) . "' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este registro?\")'>Eliminar</a>";
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
