<?php
include 'assets/header.php';
//session_start(); // Asegúrate de iniciar la sesión

if (!isset($_SESSION['userName']) || $_SESSION['userType'] !== 'Paciente') {
    $errorMessage = "No tienes permiso para acceder a esta página.";
} else {
    $userName = $_SESSION['userName'];
    $idPaciente = $_SESSION['userId'];
    $perfilPaciente = isset($_GET['perfil']) ? $_GET['perfil'] : 0; // Obtener el valor del perfilPaciente de la URL o establecer a 0 por defecto
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
        <a href="vistaPac_index.php" class="button-29">Ver mi información</a>
        <div class="opciones">
            <a href="vistaPac_index.php?perfil=1&id=<?php echo $idPaciente; ?>" class="button-29">Ver mis citas</a>
            <a href="vistaPac_index.php?perfil=2&id=<?php echo $idPaciente; ?>" class="button-29">Ver mis facturas</a>
            <a href="vistaPac_index.php?perfil=3&id=<?php echo $idPaciente; ?>" class="button-29">Ver mi expediente</a>
        </div>
        <?php
        include 'includes/conexion.php';

        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        if ($perfilPaciente == 1) {
            $sql = "SELECT c.id_cita,
                CONCAT(p.nombre, ' ', p.apellido) AS paciente_completo,
                CONCAT(m.nombre, ' ', m.apellido) AS medico_completo,
                c.fecha_hora,
                c.tipo
            FROM citas c
            JOIN pacientes p ON c.id_paciente = p.id_paciente
            JOIN personal m ON c.id_personal = m.id_personal
            WHERE p.id_paciente = ?";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $idPaciente);
            $stmt->execute();
            $resultado = $stmt->get_result();

            if ($resultado->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>Paciente</th><th>Médico</th><th>Fecha de cita</th><th>Tipo de cita</th></tr>";
                while ($fila = $resultado->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($fila["paciente_completo"]) . "</td>";
                    echo "<td>" . htmlspecialchars($fila["medico_completo"]) . "</td>";
                    echo "<td>" . htmlspecialchars($fila["fecha_hora"]) . "</td>";
                    echo "<td>" . htmlspecialchars($fila["tipo"]) . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "No se encontró información.";
            }

        } elseif ($perfilPaciente == 2) {
            // Aquí puedes agregar la consulta para mostrar las facturas del paciente
            $sql = "SELECT f.id_paciente, 
                CONCAT(p.nombre, ' ', p.apellido) AS paciente_completo,
                f.fecha_emision, 
                f.total, 
                CASE 
                    WHEN f.pagada = 1 THEN 'LIQUIDADA'
                    ELSE 'ADEUDO'
                END AS estado_pagada
            FROM facturas f
            JOIN pacientes p ON f.id_paciente = p.id_paciente
            WHERE p.id_paciente = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $idPaciente);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Paciente</th><th>Fecha</th><th>Total</th><th>Estatus</th></tr>";
            while ($fila = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($fila["paciente_completo"]) . "</td>";
                echo "<td>" . htmlspecialchars($fila["fecha_emision"]) . "</td>";
                echo "<td>" . htmlspecialchars($fila["total"]) . "</td>";
                echo "<td>" . htmlspecialchars($fila["estado_pagada"]) . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No se encontró información.";
        }
        } elseif ($perfilPaciente == 3) {
            // Aquí puedes agregar la consulta para mostrar el expediente del paciente
            $sql = "SELECT CONCAT(p.nombre, ' ', p.apellido) AS paciente_completo,
            e.historial_medico,
            e.alergias,
            e.medicamentos_actuales,
            e.antecedentes_familiares,
            e.otras_notas
            from pacientes p  
            JOIN expedientes_medicos e ON e.id_paciente = p.id_paciente
            where e.id_paciente=?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $idPaciente);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Paciente</th><th>Historial Medico</th><th>Alergias</th><th>Medicamentos Actuales</th><th>Antecedentes Familiares</th><th>Otras Notas</th></tr>";
            while ($fila = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($fila["paciente_completo"]) . "</td>";
                echo "<td>" . htmlspecialchars($fila["historial_medico"]) . "</td>";
                echo "<td>" . htmlspecialchars($fila["alergias"]) . "</td>";
                echo "<td>" . htmlspecialchars($fila["medicamentos_actuales"]) . "</td>";
                echo "<td>" . htmlspecialchars($fila["antecedentes_familiares"]) . "</td>";
                echo "<td>" . htmlspecialchars($fila["otras_notas"]) . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No se encontró información.";
        }
        } else {
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
                pacientes.id_paciente = ?";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $idPaciente);
            $stmt->execute();
            $resultado = $stmt->get_result();

            if ($resultado->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>Nombre</th><th>Apellido</th><th>Fecha de Nacimiento</th><th>Dirección</th><th>Teléfono</th><th>Habitación</th></tr>";
                while ($fila = $resultado->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($fila["nombre"]) . "</td>";
                    echo "<td>" . htmlspecialchars($fila["apellido"]) . "</td>";
                    echo "<td>" . htmlspecialchars($fila["fecha_nacimiento"]) . "</td>";
                    echo "<td>" . htmlspecialchars($fila["direccion"]) . "</td>";
                    echo "<td>" . htmlspecialchars($fila["telefono"]) . "</td>";
                    echo "<td>" . htmlspecialchars($fila["numero_habitacion"]) . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "No se encontró información.";
            }
        }
        $stmt->close();
        $conn->close();
        ?>
    <?php endif; ?>
    <?php include 'assets/footer.html'; ?>
    <div id="footer"></div>
</body>

</html>
