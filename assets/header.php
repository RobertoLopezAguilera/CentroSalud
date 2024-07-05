<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>

      header {
        width: 100%;
        background-color: #227adf;
        display: flex;
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
        align-items: center
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
      .contacto{
          padding-top:0.5rem;
          display: flex;
      }
      .ubicaion{

      }
    </style>
</head>
<body>
    <div class="contacto">
    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24"><g fill="none" stroke="#227adf" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" color="#227adf"><path d="M18.91 18c.915 1.368 1.301 2.203.977 2.9q-.06.128-.14.247c-.575.853-2.06.853-5.03.853H9.283c-2.97 0-4.454 0-5.029-.853a2 2 0 0 1-.14-.247c-.324-.697.062-1.532.976-2.9M15 9.5a3 3 0 1 1-6 0a3 3 0 0 1 6 0"/><path d="M12 2c4.059 0 7.5 3.428 7.5 7.587c0 4.225-3.497 7.19-6.727 9.206a1.55 1.55 0 0 1-1.546 0C8.003 16.757 4.5 13.827 4.5 9.587C4.5 5.428 7.941 2 12 2"/></g></svg>
    <a class="ubicacion" href="#">Calle. Aguascalientes #797, Moroleón, Gto. C.P 38870</a>
    <h2>Urgencias 4451 00 13 82</h2>
    </div>
<header>
    <nav>
        <ul>
        <h1>Centro de Salud 
    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 16 16"><g fill="#ffffff"><path d="M8.5 5.034v1.1l.953-.55l.5.867L9 7l.953.55l-.5.866l-.953-.55v1.1h-1v-1.1l-.953.55l-.5-.866L7 7l-.953-.55l.5-.866l.953.55v-1.1zM13.25 9a.25.25 0 0 0-.25.25v.5c0 .138.112.25.25.25h.5a.25.25 0 0 0 .25-.25v-.5a.25.25 0 0 0-.25-.25zM13 11.25a.25.25 0 0 1 .25-.25h.5a.25.25 0 0 1 .25.25v.5a.25.25 0 0 1-.25.25h-.5a.25.25 0 0 1-.25-.25zm.25 1.75a.25.25 0 0 0-.25.25v.5c0 .138.112.25.25.25h.5a.25.25 0 0 0 .25-.25v-.5a.25.25 0 0 0-.25-.25zm-11-4a.25.25 0 0 0-.25.25v.5c0 .138.112.25.25.25h.5A.25.25 0 0 0 3 9.75v-.5A.25.25 0 0 0 2.75 9zm0 2a.25.25 0 0 0-.25.25v.5c0 .138.112.25.25.25h.5a.25.25 0 0 0 .25-.25v-.5a.25.25 0 0 0-.25-.25zM2 13.25a.25.25 0 0 1 .25-.25h.5a.25.25 0 0 1 .25.25v.5a.25.25 0 0 1-.25.25h-.5a.25.25 0 0 1-.25-.25z"/><path d="M5 1a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1a1 1 0 0 1 1 1v4h3a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V8a1 1 0 0 1 1-1h3V3a1 1 0 0 1 1-1zm2 14h2v-3H7zm3 0h1V3H5v12h1v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1zm0-14H6v1h4zm2 7v7h3V8zm-8 7V8H1v7z"/></g></svg>
    </h1>
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
            <li><a href="medicamentos.php">Servicios24/7</a></li>
            <li><a href="medicamentos.php">Medicamentos</a></li>
            <li><a href="citas.php">Citas</a></li>
            <li><a href="medicamentos.php">Contacto</a></li>
            <li><a href="login.php">Ingresar</a></li>
            <li><a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 256 256"><path fill="#ffffff" d="M152 80a12 12 0 0 1 12-12h80a12 12 0 0 1 0 24h-80a12 12 0 0 1-12-12m92 36h-80a12 12 0 0 0 0 24h80a12 12 0 0 0 0-24m0 48h-56a12 12 0 0 0 0 24h56a12 12 0 0 0 0-24m-88.38 25a12 12 0 1 1-23.24 6c-5.72-22.23-28.24-39-52.38-39s-46.66 16.76-52.38 39a12 12 0 1 1-23.24-6c5.38-20.9 20.09-38.16 39.11-48a52 52 0 1 1 73 0c19.04 9.85 33.75 27.11 39.13 48M80 132a28 28 0 1 0-28-28a28 28 0 0 0 28 28"/></svg>
                </a>
                <div class="dropdown-content">
                    <a href="">Ver mi perfil</a>
                    <a href="">Cerrar sesion</a>
                </div>
            </li>
        </ul>
    </nav>
</header>
</body>
</html>