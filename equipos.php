<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipos Médicos</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'assets/header.html'; ?>
    <div id="header"></div>

    <h1>Equipos Médicos</h1>
    <a href="agregar_equipo.php" class="button-29">Agregar Equipo</a>
    <?php
    include 'includes/conexion.php';

    $sql = "SELECT Equipos_Medicos.id_equipo, Equipos_Medicos.nombre_equipo, Equipos_Medicos.estado, Habitaciones.numero AS numero_habitacion, Areas.nombre AS nombre_area, Equipos_Medicos.img 
            FROM Equipos_Medicos 
            JOIN Habitaciones ON Equipos_Medicos.id_habitacion = Habitaciones.id_habitacion 
            JOIN Areas ON Habitaciones.id_area = Areas.id_area";

    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Nombre del Equipo</th><th>Estado</th><th>Habitación</th><th>Área</th><th>Imagen</th><th>Acciones</th></tr>";
        while($fila = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $fila["id_equipo"] . "</td>";
            echo "<td>" . $fila["nombre_equipo"] . "</td>";
            echo "<td>" . ($fila["estado"] ? 'Operativo' : 'No operativo') . "</td>";
            echo "<td>" . $fila["numero_habitacion"] . "</td>";
            echo "<td>" . $fila["nombre_area"] . "</td>";
            if ($fila["img"]) {
                echo "<td><img src='data:image/jpeg;base64," . base64_encode($fila["img"]) . "' alt='Imagen del Equipo' width='100' height='100'></td>";
            } else {
                echo "<td>No hay imagen</td>";
            }
            echo "<td>";
            echo "<a class='button-33' href='editar_equipo.php?id=" . $fila["id_equipo"] . "'>Editar</a> ";
            echo "<a class='button-34' href='eliminar_equipo.php?id=" . $fila["id_equipo"] . "' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este registro?\")'>Eliminar</a>";

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
