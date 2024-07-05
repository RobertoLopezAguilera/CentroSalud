<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* Estilos generales */
body {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
  justify-content: center;
  align-items: center;
  font-family: Arial, sans-serif;
  background-color: #b7dcf5;
  margin: 0;
}

header {
  width: 100%;
  background-color: #227adf;
}

header h1 {
  color: white;
  text-align: center;
  padding: 14px 16px;
}

header nav {
  display: flex;
  justify-content: center;
}

header ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  display: flex;
}

header ul li {
  position: relative;
}

header ul li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

header ul li a:hover {
  background-color: #ddd;
  color: black;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
  list-style-type: none;
  padding: 0;
  margin: 0;
  left: 0;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {
  background-color: #81c1f5;
}

header ul li:hover .dropdown-content {
  display: block;
}

    </style>
</head>
<body>
<header>
    <h1>Centro de Salud</h1>
    <nav>
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li class="dropdown">
                <a href="#">Areas</a>
                <div class="dropdown-content">
                    <?php
                    include 'includes/conexion.php';

                    $sql_areas = "SELECT nombre FROM Areas";
                    $resultado_areas = $conn->query($sql_areas);

                    if ($resultado_areas->num_rows > 0) {
                        while ($area = $resultado_areas->fetch_assoc()) {
                            echo "<a href='area.php?nombre=" . urlencode($area['nombre']) . "'>" . htmlspecialchars($area['nombre']) . "</a>";
                        }
                    } else {
                        echo "<a href='#'>No hay áreas disponibles</a>";
                    }

                    $conn->close();
                    ?>
                </div>
            </li>
            <li><a href="equipos.php">Equipos</a></li>
            <li><a href="habitaciones.php">Habitacion</a></li>
            <li><a href="expedientes_medicos.php">Expedientes</a></li>
            <li><a href="medicamentos.php">Medicamentos</a></li>
            <li><a href="pacientes.php">Pacientes</a></li>
            <li><a href="citas.php">Citas</a></li>
        </ul>
    </nav>
</header>
</body>
</html>