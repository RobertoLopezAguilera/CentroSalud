<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrusel de Imágenes</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="carrusel/swiper-bundle.css">
</head>
<body>
<?php include 'assets/header.php'; ?>
    <div id="header">
    </div>

    <div class = "carrusel-container">
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <?php
            $images = glob("Medicamentos/*.png");
            foreach ($images as $image) {
                echo '<div class="swiper-slide"><img src="' . $image . '" alt="Imagen" width = 1000 height = 583></div>';
            }
            ?>
        </div>
        
        <!-- Add Navigation -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
    </div>

    <!-- Link to Swiper's JS -->
    <script src="carrusel/swiper-bundle.js"></script>
    <script>
        var swiper = new Swiper('.swiper-container', {
            loop: true,
            autoplay: {
                delay: 5000,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            }
        });
    </script>
    <style>
        .carrusel-container {
            padding-top:10px;
            display: flex;
            justify-content: center;
            width: 70%;
            height: 70%;
            border-radius: 10px;
            overflow: hidden;
            padding-bottom: 10px;
            position: relative; /* Añadido para posicionar los botones */
        }

        .swiper-container {
            width: 80%;
            height: 80%;
            border-radius: 10px;
            overflow: hidden;
            position: relative; /* Añadido para posicionar los botones */
        }

        .swiper-button-next, .swiper-button-prev {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 10;
            width: 40px; /* Ancho de los botones */
            height: 40px; /* Alto de los botones */
            background-color: rgba(255, 255, 255, 0.8); /* Fondo semi-transparente */
            border-radius: 50%; /* Botones redondos */
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: background-color 0.3s ease; /* Transición de color de fondo */
        }

        .swiper-button-next:hover, .swiper-button-prev:hover {
            background-color: rgba(0, 0, 0, 0.5); /* Color de fondo al pasar el mouse */
        }

        .swiper-button-next {
            right: 10px; /* Posición a la derecha */
        }

        .swiper-button-prev {
            left: 10px; /* Posición a la izquierda */
        }

        .swiper-slide {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .swiper-slide img {
            max-width: 100%;
            max-height: 100%;
            border-radius: 10px;
            object-fit: contain;
        }

        @media (max-width: 768px) {
            .carrusel-container {
                width: 90%;
                height: auto;
            }
        }

        @media (max-width: 480px) {
            .carrusel-container {
                width: 100%;
                height: auto;
            }

            .swiper-button-next, .swiper-button-prev {
                width: 30px; /* Reducir el tamaño en pantallas más pequeñas */
                height: 30px; /* Reducir el tamaño en pantallas más pequeñas */
            }
        }


    </style>
</body>
</html>




