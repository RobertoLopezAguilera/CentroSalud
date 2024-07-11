<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expedientes Médicos</title>
    <link rel="stylesheet" href<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expedientes Médicos</title>
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
    <?php include 'assets/header.php'; ?>
    <div id="header"></div>

    <h1>Expedientes Médicos</h1>
    <div class="actions">
        <a href="agregar_expediente.php" class="button-29">Agregar Expediente Médico</a>
        <form method="GET" action="expedientes_medicos.php" class="search-form">
            <input type="text" name="search" placeholder="Buscar por nombre" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            <button type="submit" class="button-29">Buscar</button>
            <button type="button" class="button-29" onclick="window.location.href='expedientes_medicos.php'">Borrar</button>
        </form>
        <a href="descargar_excel_expedientes.php?search=<?php echo isset($_GET['search']) ? urlencode($_GET['search']) : ''; ?>" class="button-29">Descargar Excel</a>
    </div>
    <?php
    include 'includes/conexion.php';

    // Verifica la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    $search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
    $sql = "SELECT 
                Pacientes.nombre,
                Pacientes.apellido,
                Expedientes_Medicos.id_expediente,
                Expedientes_Medicos.historial_medico,
                Expedientes_Medicos.alergias,
                Expedientes_Medicos.medicamentos_actuales,
                Expedientes_Medicos.antecedentes_familiares,
                Expedientes_Medicos.otras_notas
            FROM 
                Expedientes_Medicos
            INNER JOIN 
                Pacientes ON Expedientes_Medicos.id_paciente = Pacientes.id_paciente
            WHERE (Pacientes.nombre LIKE '%$search%' OR Pacientes.apellido LIKE '%$search%');";

    $resultado = $conn->query($sql);
    if ($resultado->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Nombre</th><th>Apellido</th><th>Historial Médico</th><th>Alergias</th><th>Medicamentos Actuales</th><th>Antecedentes Familiares</th><th>Otras Notas</th><th>Acciones</th></tr>";
        while($fila = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($fila["nombre"]) . "</td>";
            echo "<td>" . htmlspecialchars($fila["apellido"]) . "</td>";
            echo "<td>" . htmlspecialchars($fila["historial_medico"]) . "</td>";
            echo "<td>" . htmlspecialchars($fila["alergias"]) . "</td>";
            echo "<td>" . htmlspecialchars($fila["medicamentos_actuales"]) . "</td>";
            echo "<td>" . htmlspecialchars($fila["antecedentes_familiares"]) . "</td>";
            echo "<td>" . htmlspecialchars($fila["otras_notas"]) . "</td>";
            echo "<td>";
            echo "<a class='button-33' href='editar_expediente.php?id=" . htmlspecialchars($fila["id_expediente"]) . "'>Editar</a>";
            echo "<a class='button-34' href='eliminar_expediente.php?id=" . htmlspecialchars($fila["id_expediente"]) . "' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este registro?\")'>Eliminar</a>";
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
="css/style.css">
</head>
<body>
    <?php include 'assets/header.php'; ?>
    <div id="header"></div>

    <h1>Expedientes Médicos</h1>
    <a href="agregar_expediente.php" class="button-29">Agregar Expediente Médico</a>
    <?php
    include 'includes/conexion.php';
    $sql = "SELECT 
                Pacientes.nombre,
                Pacientes.apellido,
                Expedientes_Medicos.id_expediente,
                Expedientes_Medicos.historial_medico,
                Expedientes_Medicos.alergias,
                Expedientes_Medicos.medicamentos_actuales,
                Expedientes_Medicos.antecedentes_familiares,
                Expedientes_Medicos.otras_notas
            FROM 
                Expedientes_Medicos
            INNER JOIN 
                Pacientes ON Expedientes_Medicos.id_paciente = Pacientes.id_paciente";
    $resultado = $conn->query($sql);
    if ($resultado->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Nombre</th><th>Apellido</th><th>Historial Médico</th><th>Alergias</th><th>Medicamentos Actuales</th><th>Antecedentes Familiares</th><th>Otras Notas</th><th>Acciones</th></tr>";
        while($fila = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $fila["nombre"] . "</td>";
            echo "<td>" . $fila["apellido"] . "</td>";
            echo "<td>" . $fila["historial_medico"] . "</td>";
            echo "<td>" . $fila["alergias"] . "</td>";
            echo "<td>" . $fila["medicamentos_actuales"] . "</td>";
            echo "<td>" . $fila["antecedentes_familiares"] . "</td>";
            echo "<td>" . $fila["otras_notas"] . "</td>";
            echo "<td>";
            echo "<a class='button-33' href='editar_expediente.php?id=" . $fila["id_expediente"] . "'>Editar</a>";
            echo "<a class='button-34' href='eliminar_expediente.php?id=" . $fila["id_expediente"] . "' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este registro?\")'>Eliminar</a>";
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
