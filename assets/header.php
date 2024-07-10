<?php
session_start();

$userName = isset($_SESSION['userName']) ? $_SESSION['userName'] : '';
$userType = isset($_SESSION['userType']) ? $_SESSION['userType'] : '';
$userId = '';

if ($userName && $userType === 'Personal') {
    include 'includes/conexion.php';

    $sql = "SELECT id_personal FROM Personal WHERE nombre='$userName' LIMIT 1";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();
        $userId = $row['id_personal'];
    }

    $conn->close();
}
?>
<style>

header {
  width: 100%;
  background-color: #227adf;
  display: flex;
  justify-content: center;
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
  margin-top: 0;
  padding: 0;
  display: flex;
  align-items: center;
}

header ul li {
    display: flex;
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
<div class="contacto">
  <a class="ubicacion" href="https://www.google.com/maps/search/?api=1&query=Calle+Aguascalientes+797+Morole%C3%B3n+Gto+C.P+38870" target="_blank">
    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24"><g fill="none" stroke="#4f46e5" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" color="#4f46e5"><path d="M18 18c1.245.424 2 .982 2 1.593C20 20.923 16.418 22 12 22s-8-1.078-8-2.407c0-.611.755-1.169 2-1.593m9-8.5a3 3 0 1 1-6 0a3 3 0 0 1 6 0"/><path d="M12 2c4.059 0 7.5 3.428 7.5 7.587c0 4.225-3.497 7.19-6.727 9.206a1.55 1.55 0 0 1-1.546 0C8.003 16.757 4.5 13.827 4.5 9.587C4.5 5.428 7.941 2 12 2"/></g></svg>
    Calle. Aguascalientes #797, Moroleón, Gto. C.P 38870
  </a>
  <h2>Urgencias 4451 00 13 82</h2>
</div>
<header>
    <nav>
        <ul>
            <h1>Centro de Salud
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="40" viewBox="0 0 640 512"><path fill="#ffffff" d="M192 48c0-26.5 21.5-48 48-48h160c26.5 0 48 21.5 48 48v464h-80v-80c0-26.5-21.5-48-48-48s-48 21.5-48 48v80h-80zM48 96h112v416H48c-26.5 0-48-21.5-48-48V320h80c8.8 0 16-7.2 16-16s-7.2-16-16-16H0v-64h80c8.8 0 16-7.2 16-16s-7.2-16-16-16H0v-48c0-26.5 21.5-48 48-48m544 0c26.5 0 48 21.5 48 48v48h-80c-8.8 0-16 7.2-16 16s7.2 16 16 16h80v64h-80c-8.8 0-16 7.2-16 16s7.2 16 16 16h80v144c0 26.5-21.5 48-48 48H480V96zM312 64c-8.8 0-16 7.2-16 16v24h-24c-8.8 0-16 7.2-16 16v16c0 8.8 7.2 16 16 16h24v24c0 8.8 7.2 16 16 16h16c8.8 0 16-7.2 16-16v-24h24c8.8 0 16-7.2 16-16v-16c0-8.8-7.2-16-16-16h-24V80c0-8.8-7.2-16-16-16z"/></svg>
            </h1>
            <li><a href="index.php">Inicio</a></li>
            <li class="dropdown">
                <a href="#">Áreas</a>
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
            <li><a href="medicamentos.php">Servicios 24/7</a></li>
            <li><a href="carrusel_medicamentos.php">Medicamentos</a></li>
            <li><a href="agendar_cita.php">Citas</a></li>
            <li><a href="medicamentos.php">Contacto</a></li>
            <?php if ($userName && $userType): ?>
                <li class="dropdown">
                    <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 256 256"><path fill="#ffffff" d="M152 80a12 12 0 0 1 12-12h80a12 12 0 0 1 0 24h-80a12 12 0 0 1-12-12m92 36h-80a12 12 0 0 0 0 24h80a12 12 0 0 0 0-24m0 48h-56a12 12 0 0 0 0 24h56a12 12 0 0 0 0-24m-88.38 25a12 12 0 1 1-23.24 6c-5.72-22.23-28.24-39-52.38-39s-46.66 16.76-52.38 39a12 12 0 1 1-23.24-6c5.38-20.9 20.09-38.16 39.11-48a52 52 0 1 1 73 0c19.04 9.85 33.75 27.11 39.13 48M80 132a28 28 0 1 0-28-28a28 28 0 0 0 28 28"/></svg>  
                      <?php echo htmlspecialchars($userType) . ': ' . htmlspecialchars($userName); ?>
                    </a>
                    <div class="dropdown-content">
                        <a href="#">Ver mi perfil</a>
                        <a href="logout.php">Cerrar sesión</a>
                    </div>
                </li>
            <?php else: ?>
                <li><a href="login.php">Ingresar</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
