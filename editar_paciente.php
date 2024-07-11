<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Paciente</title>
    <link rel="stylesheet" href="css/style.css">
    <script>
        function validarFormulario() {
            var nombre = document.getElementById('nombre').value.trim();
            var apellido = document.getElementById('apellido').value.trim();
            var fechaNacimiento = document.getElementById('fecha_nacimiento').value.trim();
            var direccion = document.getElementById('direccion').value.trim();
            var telefono = document.getElementById('telefono').value.trim();
            var curp = document.getElementById('curp').value.trim();
            var contraseña = document.getElementById('contraseñaPaciente').value.trim();

            // Validación para nombre y apellido: solo letras y espacios
            var letrasEspacios = /^[a-zA-Z\s]+$/;
            if (!nombre.match(letrasEspacios) || !apellido.match(letrasEspacios)) {
                alert('El nombre y apellido deben contener solo letras y espacios.');
                return false;
            }

            // Validación para CURP: longitud 18 y letras mayúsculas
            var curpRegex = /^[A-Z0-9]{18}$/;
            if (!curp.match(curpRegex)) {
                alert('La CURP debe tener exactamente 18 caracteres alfanuméricos en mayúsculas.');
                return false;
            }

            var telRegex = /^[0-9]{10}$/;
            if (!telefono.match(telRegex)) {
                alert('El telefono debe tener exactamente 10 caracteres númericos.');
                return false;
            }

            // Validación de fecha de nacimiento: debe ser válida y mayor de 16 años
            var hoy = new Date();
            var fechaNac = new Date(fechaNacimiento);
            var edad = hoy.getFullYear() - fechaNac.getFullYear();
            var mes = hoy.getMonth() - fechaNac.getMonth();
            if (mes < 0 || (mes === 0 && hoy.getDate() < fechaNac.getDate())) {
                edad--;
            }
            if (edad < 16) {
                alert('Debes tener al menos 16 años para registrarte como paciente.');
                return false;
            }

            return true;
        }

        document.getElementById('registroForm').addEventListener('submit', function(event) {
            if (!validarFormulario()) {
                event.preventDefault();
            }
        });
    </script>
</head>
<body>
    <?php include 'assets/header.php'; ?>
    <div id="header"></div>
    <h1>Editar Paciente</h1>
    <?php
    include 'includes/conexion.php';
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }
    $id_paciente = intval($_GET['id']);

    $sql_paciente = "SELECT * FROM pacientes WHERE id_paciente = ?";
    $stmt_paciente = $conn->prepare($sql_paciente);
    $stmt_paciente->bind_param("i", $id_paciente);
    $stmt_paciente->execute();
    $resultado_paciente = $stmt_paciente->get_result();
    
    if ($resultado_paciente->num_rows > 0) {
        $paciente = $resultado_paciente->fetch_assoc();
    } else {
        echo "No se encontró el paciente.";
        exit;
    }

    $sql_areas = "SELECT id_area, nombre FROM Areas";
    $resultado_areas = $conn->query($sql_areas);
    if (!$resultado_areas) {
        echo "Error al obtener las áreas: " . $conn->error;
        exit;
    }
    ?>
    <form id="registroForm" action="procesar_editar_paciente.php" method="post" onsubmit="return validarFormulario();">
        <input type="hidden" name="id_paciente" value="<?php echo htmlspecialchars($paciente['id_paciente']); ?>">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($paciente['nombre']); ?>" required>
        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" value="<?php echo htmlspecialchars($paciente['apellido']); ?>" required>
        <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo htmlspecialchars($paciente['fecha_nacimiento']); ?>" required>
        <label for="direccion">Dirección:</label>
        <input type="text" id="direccion" name="direccion" value="<?php echo htmlspecialchars($paciente['direccion']); ?>" required>
        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="telefono" maxlength="10" minlength="10" value="<?php echo htmlspecialchars($paciente['telefono']); ?>" required>
        <label for="curp">CURP:</label>
        <input type="text" id="curp" name="curp" value="<?php echo htmlspecialchars($paciente['CURP']); ?>" required>
        <label for="id_area">Área:</label>

        <select id="id_area" name="id_area" required onchange="cargarHabitaciones(this.value)">
    <option value="">Seleccione un área</option>
    <?php while($area = $resultado_areas->fetch_assoc()) { ?>
        <option value="<?php echo htmlspecialchars($area['id_area']); ?>" <?php if (isset($paciente['id_area']) && $area['id_area'] == $paciente['id_area']) echo 'selected'; ?>>
            <?php echo htmlspecialchars($area['nombre']); ?>
        </option>
    <?php } ?>
</select>


        <label for="id_habitacion">Habitación:</label>
        <select id="id_habitacion" name="id_habitacion" required onchange="cargarCamas(this.value)">
            <option value="">Seleccione una habitación</option>
        </select>

        <label for="id_cama">Cama:</label>
        <select id="id_cama" name="id_cama" required>
            <option value="">Seleccione una cama</option>
        </select>

        <div class="inputdiv">
            <input type="submit" value="Actualizar">
            <a href="pacientes.php">Volver a la lista de pacientes</a>
        </div>
    </form>

    <script>
        function cargarHabitaciones(id_area) {
            if (id_area) {
                fetch('obtener_habitaciones.php?id_area=' + id_area)
                    .then(response => response.json())
                    .then(data => {
                        let habitacionesSelect = document.getElementById('id_habitacion');
                        habitacionesSelect.innerHTML = '<option value="">Seleccione una habitación</option>';
                        data.habitaciones.forEach(habitacion => {
                            habitacionesSelect.innerHTML += `<option value="${habitacion.id_habitacion}">${habitacion.numero}</option>`;
                        });
                    })
                    .catch(error => {
                        console.error('Error al cargar habitaciones:', error);
                    });
            }
        }

        function cargarCamas(id_habitacion) {
            if (id_habitacion) {
                fetch('obtener_camas.php?id_habitacion=' + id_habitacion)
                    .then(response => response.json())
                    .then(data => {
                        let camasSelect = document.getElementById('id_cama');
                        camasSelect.innerHTML = '<option value="">Seleccione una cama</option>';
                        data.camas.forEach(cama => {
                            camasSelect.innerHTML += `<option value="${cama.id_cama}">${cama.numero_cama}</option>`;
                        });
                    })
                    .catch(error => {
                        console.error('Error al cargar camas:', error);
                    });
            }
        }
    </script>

    <?php
    $stmt_paciente->close();
    $conn->close();
    ?>

    <?php include 'assets/footer.html'; ?>
    <div id="footer"></div>
</body>
</html>
