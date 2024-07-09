<?php
include 'includes/conexion.php';

$search = isset($_GET['search']) ? $_GET['search'] : '';

$sql = "SELECT * FROM Medicamentos";

if (!empty($search)) {
    $search = $conn->real_escape_string($search);
    $sql .= " WHERE nombre LIKE '%$search%' OR descripcion LIKE '%$search%'";
}

$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="medicamentos.xls"');
    header('Cache-Control: max-age=0');

    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Nombre</th><th>Descripción</th><th>Stock</th><th>Precio</th><th>Fecha de Caducidad</th></tr>";
    while ($fila = $resultado->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($fila["id_medicamento"]) . "</td>";
        echo "<td>" . htmlspecialchars($fila["nombre"]) . "</td>";
        echo "<td>" . htmlspecialchars($fila["descripcion"]) . "</td>";
        echo "<td>" . htmlspecialchars($fila["stock"]) . "</td>";
        echo "<td>" . htmlspecialchars($fila["precio"]) . "</td>";
        echo "<td>" . htmlspecialchars($fila["fecha_caducidad"]) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No se encontraron resultados para la descarga.";
}

$conn->close();
?>
