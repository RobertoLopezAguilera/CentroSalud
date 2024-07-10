<?php
include 'assets/header.php';

if (!isset($_SESSION['userName']) || $_SESSION['userType'] !== 'Paciente') {
    $errorMessage = "No tienes permiso para acceder a esta página.";
} else {
    $userName = $_SESSION['userName'];
    $idPaciente =$_SESSION['userId'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista Paciente</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php if (isset($errorMessage)): ?>
        <div class="error"><?php echo $errorMessage; ?></div>
    <?php else: ?>
        <h2>Bienvenido, <?php echo htmlspecialchars($userName); ?></h2>
            <a href="vistaPac_index.php" class="button-29">Ver mi informacion</a>
            <div class = "opciones">
                <a href="citas.php" class="button-29">Ver mis citas</a>
                <a href="facturas.php" class="button-29">Ver mis facturas</a>
                <a href="expedientes_medicos.php" class="button-29">Ver mi expediente</a>
            </div>
            <?php
            include 'includes/conexion.php';

            if ($conn->connect_error) {
                die("Error de conexión: " . $conn->connect_error);
            }

            $sql = "SELECT 
                pacientes.id_paciente, 
                pacientes.nombre, 
                pacientes.apellido, 
                pacientes.fecha_nacimiento, 
                pacientes.direccion, 
                pacientes.telefono, 
                habitaciones.numero AS numero_habitacion
            FROM 
                camas c
            JOIN 
                pacientes ON c.id_cama = pacientes.id_cama
            JOIN 
                habitaciones ON c.id_habitacion = habitaciones.id_habitacion
            WHERE 
                pacientes.id_paciente = $idPaciente";

            $stmt = $conn->prepare($sql);
           // $stmt->bind_param("s", $userName);
            $stmt->execute();
            $resultado = $stmt->get_result();

            if ($resultado->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>Nombre</th><th>Apellido/th><th>Fecha de Nacimiento</th><th>Direccion</th><th>Telefono</th><th>Habitacion</th><th>Acciones</th></tr>";
                while($fila = $resultado->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($fila["nombre"]) . "</td>";
                    echo "<td>" . htmlspecialchars($fila["apellido"]) . "</td>";
                    echo "<td>" . htmlspecialchars($fila["fecha_nacimiento"]) . "</td>";
                    echo "<td>" . htmlspecialchars($fila["direccion"]) . "</td>";
                    echo "<td>" . htmlspecialchars($fila["telefono"]) . "</td>";
                    echo "<td>" . htmlspecialchars($fila["numero_habitacion"]) . "</td>";
                    echo "<td>";
                    echo "<a class='button-33' href='editar_paciente.php?id=" . htmlspecialchars($fila["id_paciente"]) . "'>Editar</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "No se encontro informacion.";
            }

            $stmt->close();
            $conn->close();
            ?>
        <?php endif; ?>
    <?php include 'assets/footer.html'; ?>
    <div id="footer"></div>
</body>
</html>

