<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pacientes</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'assets/header.html'; ?>
    <div id="header"></div>
    
    <h1>Pacientes del Hospital</h1>
    <a class="button-29" href="agregar_paciente.php">Agregar Nuevo Paciente</a>
    <?php
    include 'includes/conexion.php';

    // Verifica la conexión
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
    pacientes.CURP,
    habitaciones.numero AS numero_habitacion
    FROM 
    camas c
    JOIN 
    pacientes ON c.id_cama = pacientes.id_cama
    JOIN 
    habitaciones ON c.id_habitacion = habitaciones.id_habitacion
    WHERE 
    c.id_cama = pacientes.id_cama;";

    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Nombre</th><th>Apellido</th><th>Fecha de Nacimiento</th><th>Direccion</th><th>Telefono</th><th>CURP</th><th>Habitacion</th></tr>";
        while($fila = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($fila["id_paciente"]) . "</td>";
                echo "<td>" . htmlspecialchars($fila["nombre"]) . "</td>";
                echo "<td>" . htmlspecialchars($fila["apellido"]) . "</td>";
                echo "<td>" . htmlspecialchars($fila["fecha_nacimiento"]) . "</td>";
                echo "<td>" . htmlspecialchars($fila["direccion"]) . "</td>";
                echo "<td>" . htmlspecialchars($fila["telefono"]) . "</td>";
                echo "<td>" . htmlspecialchars($fila["CURP"]) . "</td>";
                echo "<td>" . htmlspecialchars($fila["numero_habitacion"]) . "</td>";
                echo "<td>";
                echo "<a class='button-33' href='editar_paciente.php?id=" . htmlspecialchars($fila["id_paciente"]) . "'>Editar</a>";
                /*echo "<a class='button-34' href='eliminar_personal.php?id=" . htmlspecialchars($fila["id_personal"]) . "' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este registro?\")'>Eliminar</a>";*/
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