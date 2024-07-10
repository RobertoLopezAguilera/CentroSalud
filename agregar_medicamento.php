<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Agregar Medicamento</title>
    <script>
        function validarFormulario() {
            var nombre = document.getElementById("nombre").value.trim();
            var descripcion = document.getElementById("descripcion").value.trim();
            var stock = document.getElementById("stock").value;
            var precio = document.getElementById("precio").value;
            var fechaCaducidad = document.getElementById("fecha_caducidad").value;

            if (nombre === "") {
                alert("Por favor, ingrese el nombre del medicamento.");
                return false;
            }

            if (descripcion === "") {
                alert("Por favor, ingrese una descripción.");
                return false;
            }

            if (stock <= 0) {
                alert("El stock debe ser mayor a 0.");
                return false;
            }

            if (precio <= 0) {
                alert("El precio debe ser mayor a 0.");
                return false;
            }

            if (fechaCaducidad === "") {
                alert("Por favor, ingrese una fecha de caducidad.");
                return false;
            }

            var fechaActual = new Date();
            var fechaCaducidadDate = new Date(fechaCaducidad);
            if (fechaCaducidadDate <= fechaActual) {
                alert("La fecha de caducidad debe ser posterior a la fecha actual.");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
    <?php include 'assets/header.php'; ?>
    <div id="header"></div>

    <h1>Agregar Medicamento</h1>
    <form action="procesar_agregar_medicamento.php" method="post" onsubmit="return validarFormulario()">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br>
        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" required></textarea><br>
        <label for="stock">Stock:</label>
        <input type="number" id="stock" name="stock" required><br>
        <label for="precio">Precio:</label>
        <input type="number" step="0.01" id="precio" name="precio" required><br>
        <label for="fecha_caducidad">Fecha de Caducidad:</label>
        <input type="datetime-local" id="fecha_caducidad" name="fecha_caducidad" required><br>
        <div class="inputdiv">
            <input type="submit" value="Agregar">
            <a href="medicamentos.php">Volver a la lista de medicamentos</a>
        </div>
    </form>

    <?php include 'assets/footer.html'; ?>
    <div id="footer"></div>
</body>
</html>
