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
    <title>Vista Personal</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .opciones {
            display: flex;
    align-content: center;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: center;
    flex-direction: row;
    max-width: 70%;
        }
    </style>
</head>
<body>
    <?php if (isset($errorMessage)): ?>
        <div class="error"><?php echo $errorMessage; ?></div>
    <?php else: ?>
        <h2>Bienvenido, <?php echo htmlspecialchars($userName); ?></h2>
        <?php if ($userName === "DR. Roberto"): ?>
            <div class = "opciones">
                <a href="recetas.php" class="button-29">Ver todas las recetas</a>
                <a href="medicamentos.php" class="button-29">Administrar medicamentos</a>
                <a href="pacientes.php" class="button-29">Administrar pacientes</a>
                <a href="areas.php" class="button-29">Administrar areas</a>
                <a href="equipos.php" class="button-29">Administrar equipos</a>
                <a href="expedientes_medicos.php" class="button-29">Ver expedientes</a>
                <a href="personal.php" class="button-29">Administrar Personal</a>
                <a href="facturas.php" class="button-29">Administrar facturas</a>
                <a href="citas.php" class="button-29">Administrar citas</a>
            </div>
            
        <?php else: ?>
            <a class="button-29" href="agregar_paciente.php">Agregar Nuevo Paciente</a>
            <a class="button-29" href="citas.php">Agenda de citas</a>
            <?php
            include 'includes/conexion.php';

            if ($conn->connect_error) {
                die("Error de conexión: " . $conn->connect_error);
            }

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
                        Medicamentos m ON rm.id_medicamento = m.id_medicamento
                    WHERE 
                        pe.nombre = ?";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $userName);
            $stmt->execute();
            $resultado = $stmt->get_result();

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

            $stmt->close();
            $conn->close();
            ?>
        <?php endif; ?>
    <?php endif; ?>
    <?php include 'assets/footer.html'; ?>
    <div id="footer"></div>
</body>
</html>
