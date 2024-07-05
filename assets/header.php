<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centro de Salud</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="contacto">
        <a class="ubicacion" href="#">Calle. Aguascalientes #797, Moroleón, Gto. C.P 38870</a>
        <h2>Urgencias 4451 00 13 82</h2>
    </div>
    <header>
        <nav>
            <ul>
                <h1>Centro de Salud</h1>
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
                <li><a href="medicamentos.php">Medicamentos</a></li>
                <li><a href="citas.php">Citas</a></li>
                <li><a href="contacto.php">Contacto</a></li>
                <?php if (isset($_SESSION['userName'])): ?>
                    <li><a href="#"><?php echo htmlspecialchars($_SESSION['userName']); ?></a></li>
                <?php else: ?>
                    <li><a href="login.php">Iniciar Sesión</a></li>
                <?php endif; ?>
                <li><a href="#"><label for="usuariotipo"><?php echo isset($_SESSION['userType']) ? htmlspecialchars($_SESSION['userType']) : ''; ?></label></a>
                    <div class="dropdown-content">
                        <a href="">Ver mi perfil</a>
                        <a href="logout.php">Cerrar sesión</a>
                    </div>
                </li>
            </ul>
        </nav>
    </header>
</body>
</html>
