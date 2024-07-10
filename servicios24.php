<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<style>
        
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }
        .centered-image {
            text-align: center;
            margin-bottom: 20px;
        }

        .centered-image img {
            max-width: 100%;
            height: auto;
        }

        .content {
        font-family: Arial, sans-serif;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 100%;
        margin: 20px auto;
        box-sizing: border-box;
        word-wrap: break-word;
    }
    </style>
<body>
    <?php include 'assets/header.php'; ?>
    <div id="header"></div>

    <section id="showcase">
        <div class="container">
            <div class="centered-image">
                <img src="images/foto4.jpg" alt="Imagen 1">
            </div>
        </div>
    </section>

    <div class="container" >
        <div class="content">
            <h2>Servicios 24/7</h2>
            <p>
                En el Hospital Centro de salud, entendemos que las emergencias y la necesidad de atención médica pueden surgir en cualquier momento del día o la noche. Por eso, ofrecemos una variedad de servicios médicos y consultas disponibles las 24 horas del día, los 7 días de la semana.
            </p>

            <h3>Tipos de Atenciones Disponibles</h3>
            <ul>
                <li>Emergencias médicas.</li>
                <li>Consulta médica general.</li>
                <li>Atención especializada según disponibilidad de especialistas.</li>
                <li>Apoyo psicológico y emocional.</li>
                <li>Consulta de laboratorio para resultados urgentes.</li>
                <li>Consulta de radiología para estudios diagnósticos rápidos.</li>
                <li>Entrega de medicamentos esenciales.</li>
                <li>Asesoramiento telefónico para dudas médicas urgentes.</li>
            </ul>

            <h3>Procedimiento de Atención</h3>
            <p>
                Nuestro equipo médico está capacitado para manejar situaciones de emergencia y urgencia con profesionalismo y eficiencia. Al llegar al hospital, serás atendido por personal especializado que evaluará tu situación y te guiará hacia la atención adecuada según tus necesidades.
            </p>

            <h3>Contacto</h3>
            <p>
                Para más detalles sobre nuestros servicios 24/7 o en caso de emergencia, por favor contacta con nuestro servicio de atención al paciente:
            </p>
            <ul>
                <li>Teléfono de Emergencias: 1234567890</li>
                <li>Correo Electrónico: contacto@centrodesalud.com</li>
                <li>Dirección: Calle Falsa 123
</li>
            </ul>
        </div>
    </div>




    <?php include 'assets/footer.html'; ?>
    <div id="footer"></div>
    <div id="footer"></div>
</body>
</html>