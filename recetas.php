<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recetas Médicas</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'assets/header.php'; ?>
<div id="header"></div>
    <h1>Recetas Médicas</h1>
    <a href="" class="button-29">Agregar Receta</a>
    <?php
    include 'includes/conexion.php';

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

    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Paciente</th><th>Personal Médico</th><th>Fecha Emisión</th><th>Observaciones</th><th>Dosis</th><th>Medicamento</th><th>Acciones</th></tr>";
        while($fila = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $fila["nombre_paciente"] . " " . $fila["apellido_paciente"] . "</td>";
            echo "<td>" . $fila["nombre_personal"] . " " . $fila["apellido_personal"] . "</td>";
            echo "<td>" . $fila["fecha_emision"] . "</td>";
            echo "<td>" . $fila["observaciones"] . "</td>";
            echo "<td>" . $fila["dosis"] . "</td>";
            echo "<td>" . $fila["nombre_medicamento"] . "</td>";
            echo "<td>";
            echo "<a class='button-33' href='editar_receta.php?id=" . $fila["id_receta"] . "'>Editar</a>";
            echo "<a class='button-34' href='eliminar_receta.php?id=" . $fila["id_receta"] . "' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este registro?\")'>Eliminar</a>";
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
</body>
</html>
