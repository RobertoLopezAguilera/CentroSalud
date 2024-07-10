<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Medicamento</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'assets/header.php'; ?>
    <div id="header"></div>
    <h1>Editar Medicamento</h1>
    <?php
    include 'includes/conexion.php';
    $id = $_GET['id'];
    $sql = "SELECT * FROM Medicamentos WHERE id_medicamento = $id";
    $resultado = $conn->query($sql);
    $fila = $resultado->fetch_assoc();
    ?>
    <form id="editarMedicamentoForm" action="procesar_editar_medicamento.php" method="post" onsubmit="return validarFormulario()">
        <input type="hidden" name="id" value="<?php echo $fila['id_medicamento']; ?>">
        
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo $fila['nombre']; ?>" required><br>
        
        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" required><?php echo $fila['descripcion']; ?></textarea><br>
        
        <label for="stock">Stock:</label>
        <input type="number" id="stock" name="stock" value="<?php echo $fila['stock']; ?>" required><br>
        
        <label for="precio">Precio:</label>
        <input type="number" step="0.01" id="precio" name="precio" value="<?php echo $fila['precio']; ?>" required><br>
        
        <label for="fecha_caducidad">Fecha de Caducidad:</label>
        <input type="date" id="fecha_caducidad" name="fecha_caducidad" value="<?php echo $fila['fecha_caducidad']; ?>" required><br>
        
        <div class="inputdiv">
            <input type="submit" value="Actualizar">
            <a href="medicamentos.php">Volver a la lista de medicamentos</a>
        </div>
    </form>

    <script>
        function validarFormulario() {
            var nombre = document.getElementById('nombre').value.trim();
            var descripcion = document.getElementById('descripcion').value.trim();
            var stock = document.getElementById('stock').value;
            var precio = document.getElementById('precio').value;
            var fechaCaducidad = document.getElementById('fecha_caducidad').value;

            if (nombre === '') {
                alert('Por favor, ingrese el nombre del medicamento.');
                return false;
            }

            if (descripcion === '') {
                alert('Por favor, ingrese la descripción del medicamento.');
                return false;
            }

            if (stock === '' || isNaN(stock) || parseInt(stock) < 0) {
                alert('Por favor, ingrese un stock válido.');
                return false;
            }

            if (precio === '' || isNaN(precio) || parseFloat(precio) < 0) {
                alert('Por favor, ingrese un precio válido.');
                return false;
            }

            if (fechaCaducidad === '') {
                alert('Por favor, ingrese la fecha de caducidad.');
                return false;
            }

            return true;
        }
    </script>

    <?php include 'assets/footer.html'; ?>
    <div id="footer"></div>
</body>
</html>
