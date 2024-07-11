<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centro de Salud - Inicio</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-weight: bold;
        }
        .grid-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }
        .grid-item {
            padding: 20px;
            border: 1px solid #ccc;
        }
        .grid-content img {
            width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <?php include 'assets/header.php'; ?>
    <div id="header"></div>
    <div>
        <h1>Aquí puedes encontrar información sobre nuestros servicios y más.</h1>
        <!-- Agrega más contenido según sea necesario -->
    </div>

    <!-- Carrusel de imágenes -->
<div class="carousel-container">
    <!-- Carrusel de imágenes -->
    <div class="carousel" id="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active" onclick="moveCarousel(0)">
                <h2 style="text-align: center;">Vive una vida saludable</h2>
                <img src="imagen1.jpg" alt="imagen 1">
            </div>
            <div class="carousel-item" onclick="moveCarousel(1)">
                <h2 style="text-align: center;">Tu entorno mas técnologimante saludable</h2>
                <img src="imagen2.jpg" alt="imagen 2">
            </div>
            <div class="carousel-item active" onclick="moveCarousel(2)">
            <h2 style="text-align: center;">Conoce a nuestros mejores doctores</h2>
                <img src="imagen3.jpg" alt="imagen 3">
            </div>
            <div class="carousel-item" onclick="moveCarousel(3)">
            <h2 style="text-align: center;">Atención todos los días de la semana 24Hrs</h2>
                <img src="imagen4.jpg" alt="imagen 4">
            </div>
            <div class="carousel-item active" onclick="moveCarousel(4)">
            <h2 style="text-align: center;">Visitas a las escuelas públicas</h2>
                <img src="imagen5.jpg" alt="imagen 5">
            </div>
            
            <!-- Agrega más imágenes según sea necesario -->
        </div>
        <div class="carousel-control prev" onclick="moveCarousel(-1)">&#10094;</div>
        <div class="carousel-control next" onclick="moveCarousel(1)">&#10095;</div>
    </div>

    <!-- Imagen adicional "simi.png" -->
    <div class="additional-image">
    <div class="tenor-gif-embed" data-postid="2631097182996150331" data-share-method="host" data-aspect-ratio="1" data-width="100%"><a href="https://tenor.com/view/baile-doctor-simi-dr-simi-feliz-domingo-reaccionan-gif-2631097182996150331">Baile Doctor Simi Dr Simi GIF</a>from <a href="https://tenor.com/search/baile+doctor+simi-gifs">Baile Doctor Simi GIFs</a></div> <script type="text/javascript" async src="https://tenor.com/embed.js"></script>
    </div>
</div>

    
<div class="grid-container"id="inicio">
    <div class="grid-item">
        <div class="grid-content">
            <img src="images/foto1.jpg" alt="Foto 1">
            
        </div>
    </div>
    <div class="grid-item">
    <div class="grid-content">
        <h1 style="text-align: center;">¡Bienvenido! </h1> 
        <p><strong>Estás dando el primer paso hacia una vida saludable: la información.</strong></p>
        <p><strong>Una vida saludable es un estilo de vida en el que disminuimos los riesgos de estar gravemente enfermo, así como de morir tempranamente.<br>La Organización Mundial de la Salud identifica varios pasos para una vida saludable. Estos están basados en la alimentación, la higiene y el deporte.</strong></p>
        <p><strong>*.-Dormir en los horarios adecuados.</strong> El buen descanso nocturno y aprovechar la luz solar revitaliza nuestro organismo.</p>
        <p><strong>*.-Evitar el sedentarismo</strong> (¡estar todo el día mirando series no es lo más saludable!)</p>
        <p><strong>*.-Asiste al médico regularmente.</strong> Una vez al año, cada dos años, cada 6 meses, tu médico te lo dirá cuando es necesario verte la próxima vez.</p>
        <p><strong>*.-Alimentarse con una nutrición variada</strong>, con mayor cantidad de frutas y vegetales, que de carne animal, y aún menos de alimentos prefabricados o industriales.</p>
        <p><strong>*.-Mantener el peso corporal dentro de los límites saludables</strong> (Índice de Masa Corporal entre 18.5 y 25).</p>
        <p><strong>*.-Realizar actividad física diariamente</strong>, de manera enérgica, si es posible todos los días.</p>
        <p><strong>*.-Reemplazar grasas saturadas por grasas no saturadas.</strong></p>
        <p><strong>*.-Consumir alimentos bajos en grasas, bajos en azúcares, bajos en sal.</strong></p>
    </div>
</div>
<div class="grid-item" id="tec">
    <div class="grid-content">
        <h1 style="text-align: center;">Ayuda a tu salud usando tu smartphone </h1>
        <p>En la era digital actual, los teléfonos móviles y las smart bands han revolucionado la forma en que gestionamos nuestra salud diaria. Estos dispositivos no solo actúan como herramientas de comunicación, sino que también integran una variedad de aplicaciones diseñadas para monitorear y mejorar nuestro bienestar. Desde la medición de pasos y la monitorización del ritmo cardíaco hasta el seguimiento del sueño y la gestión de la actividad física, estas tecnologías ofrecen datos precisos y accesibles sobre nuestra salud en tiempo real. Además, las smart bands, sincronizadas con aplicaciones móviles dedicadas, permiten a los usuarios establecer metas de salud personalizadas y recibir notificaciones que promueven hábitos de vida más saludables, convirtiéndose así en aliados indispensables en nuestro cuidado personal.</p>
        <p><strong>Estos son unas smartbands que te pueden ayudar a mantener tu salud:</strong></p>
        <p><strong>Fitbit:</strong> Conocido por sus wearables como el Fitbit Charge o Versa, que monitorean pasos, ritmo cardíaco, sueño y más. Sincronizables con la aplicación móvil Fitbit.</p>
        <p><strong>Apple Watch:</strong> Ofrece funciones avanzadas de salud como electrocardiograma (ECG), detección de caídas, seguimiento de actividad física y de sueño. Sincronizable con la app Health en dispositivos iOS.</p>
        <p><strong>Samsung Galaxy Watch:</strong> Disponible en varias ediciones, incluyendo funciones de seguimiento de ejercicio, monitorización de ritmo cardíaco y sueño, conectividad con la app Samsung Health.</p>
        <p><strong>Garmin:</strong> Ofrece smartwatches y dispositivos específicos para deportes como el Garmin Forerunner y Vivoactive, que monitorizan el rendimiento deportivo, el sueño y más, sincronizables con Garmin Connect.</p>
        <p><strong>Xiaomi Mi Band:</strong> Una smart band económica que monitoriza pasos, frecuencia cardíaca, sueño y ofrece recordatorios sedentarios, conectable con la app Mi Fit.</p>
        <p><strong>Withings:</strong> Ofrece dispositivos como el Steel HR y Pulse HR, que monitorizan la actividad física, ritmo cardíaco y sueño, conectables con la app Health Mate.</p>
    </div>
</div>
<div class="grid-item">
    <div class="grid-content">
        <img src="images/foto2.jpg" alt="Foto 2">
    </div>
</div>
<div class="grid-item" id="conocenos">
    <div class="grid-content">
        <img src="images/foto3.jpg" alt="Foto 3">
        <p>Información de la foto 5</p>
    </div>
</div>
<div class="grid-item">
    <div class="grid-content">
        <h1 style="text-align: center;">Conocenos</h1>
        <p>En el Centro de Salud, nuestros doctores son reconocidos por su dedicación y experiencia en diversas especialidades médicas, garantizando atención de alta calidad para todos nuestros pacientes. Uno de nuestros destacados especialistas es el <strong>Dr. Martín Sánchez</strong>, cardiólogo de renombre internacional. Con más de dos décadas de experiencia en el tratamiento de enfermedades cardiovasculares, el Dr. Sánchez ha liderado investigaciones pioneras en el campo de la prevención de infartos y la rehabilitación cardíaca.</p>
        <p>Graduado con honores de la Facultad de Medicina de la Universidad Nacional, el Dr. Sánchez completó su residencia en Cardiología en el prestigioso Hospital Central. Sus estudios especializados se centran en técnicas avanzadas de imagen cardíaca y terapias innovadoras para pacientes con enfermedades del corazón. Es autor de numerosas publicaciones en revistas médicas de alto impacto y ha impartido conferencias en congresos internacionales sobre avances en cardiología preventiva.</p>  
        <p>El compromiso del Dr. Sánchez con el bienestar cardiovascular de nuestros pacientes se refleja en su enfoque compasivo y su capacidad para personalizar el tratamiento según las necesidades individuales. Su equipo multidisciplinario en el Centro de Salud trabaja incansablemente para proporcionar diagnósticos precisos, tratamientos efectivos y cuidados integrales que mejoran la calidad de vida de quienes confían en nuestros servicios médicos.</p>
    </div>
</div>
<div class="grid-item" id="24hrs">
    <div class="grid-content">
        <h1 style="text-align: center;">Atencion 24Hrs los 7 dias de la semana </h1>
        <p>En el Centro de Salud, entendemos la importancia de brindar atención médica continua y de calidad a nuestros pacientes. Por ello, estamos orgullosos de ofrecer servicios de atención las 24 horas del día, los 7 días de la semana. Nuestro compromiso es estar siempre disponibles para atender emergencias médicas, así como para proporcionar consultas y cuidados continuos a cualquier hora del día o de la noche.</p>
    </div>
</div>
<div class="grid-item">
    <div class="grid-content">
        <img src="images/foto4.jpg" alt="Foto 4">
    </div>
</div>
<div class="grid-item" id="visitas">
    <div class="grid-content">
        <img src="images/nino-con-doctor.jpg" alt="Foto 5">
    </div>
</div>
<div class="grid-item">
    <div class="grid-content">
        <h1 style="text-align: center;">Posible visita a tu escuela</h1>
        <p>El Centro de Salud se complace en ofrecer servicios de salud preventiva directamente en las escuelas de nuestra comunidad. Creemos que la educación en salud es fundamental para el bienestar de los estudiantes y para promover hábitos saludables desde una edad temprana. Nuestro programa de visitas escolares está diseñado para proporcionar evaluaciones de salud preventivas y educación sobre temas clave de salud adaptados a las necesidades específicas de cada grupo de edad.</p>
        <p><strong>Para organizar una visita del Centro de Salud a su escuela, se requiere lo siguiente:</strong></p>
        <p><strong>Coordinación Previa:</strong> Comuníquese con nuestro equipo administrativo para programar la visita y discutir los temas específicos que le gustaría abordar en la sesión educativa.</p>
        <p><strong>Espacio Adecuado:</strong> Necesitaremos un espacio adecuado dentro de la escuela para llevar a cabo las evaluaciones de salud y la sesión educativa, preferiblemente una sala que pueda acomodar cómodamente a los estudiantes y al personal médico.</p>
        <p><strong>Autorización Parental:</strong> Es fundamental obtener el consentimiento informado de los padres o tutores de los estudiantes participantes antes de la visita. Proporcionaremos formularios de consentimiento para que los padres los firmen antes de la fecha programada.</p>
        <p><strong>Colaboración con el Personal Escolar:</strong> Trabajaremos estrechamente con el personal educativo y administrativo de la escuela para asegurarnos de cumplir con todas las normativas y horarios establecidos.</p>  
        <p>Durante la visita, nuestros profesionales de la salud realizarán evaluaciones básicas como chequeos de presión arterial, control de peso y altura, y proporcionarán información educativa sobre temas relevantes como la nutrición, la higiene personal y la importancia del ejercicio físico. Estamos comprometidos en ayudar a educar y promover un estilo de vida saludable entre los estudiantes, fomentando así comunidades más saludables y conscientes.</p>
    </div>
</div>

    <?php include 'assets/footer.html'; ?>
    <div id="footer"></div>
<script>
        let currentIndex = 0;

        function moveCarousel(direction) {
            const carouselInner = document.querySelector('.carousel-inner');
            const totalItems = document.querySelectorAll('.carousel-item').length;

            currentIndex = (currentIndex + direction + totalItems) % totalItems;
            const translateX = -currentIndex * 100 / totalItems;

            carouselInner.style.transform = `translateX(${translateX}%)`;
        }

        setInterval(() => {
            moveCarousel(1);
        }, 5000);

        function moveImage(direction) {
        const items = document.querySelectorAll('.image-item');
        items[currentIndex].classList.remove('active');
        currentIndex = (currentIndex + direction + items.length) % items.length;
        items[currentIndex].classList.add('active');
}

    // Opcional: cambio automático cada 5 segundos
    setInterval2(() => {
        moveImage(1);
    }, 5000);
</script>


</body>
</html>
