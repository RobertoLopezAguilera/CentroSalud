<?php
include 'assets/header.php';

$nombre_area = isset($_GET['nombre']) ? $_GET['nombre'] : '';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var area = "<?php echo htmlspecialchars($nombre_area); ?>";
            showArea(area);
        });

        function showArea(area) {
            // Ocultar todas las áreas
            var areas = document.getElementsByClassName('area-content');
            for (var i = 0; i < areas.length; i++) {
                areas[i].style.display = 'none';
            }

            // Mostrar el área seleccionada si existe
            var selectedArea = document.getElementById(area);
            if (selectedArea) {
                selectedArea.style.display = 'block';
            } else {
                console.error("Área no encontrada: " + area);
            }
        }

       
    </script>


    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área de <?php echo htmlspecialchars($nombre_area); ?> - Hospital Centro de salud</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }

        #showcase {
            
            background: url('anestesia.jpg') no-repeat center center/cover;
            text-align: center;
            color: #000;
        }

        #showcase h1 {
           
            font-size: 55px;
            margin-bottom: 10px;
            word-wrap: break-word;
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

        .area-content {
            display: none;
        }

        /* Media Queries for Responsive Design */
        @media (max-width: 1200px) {
            .container {
                width: 90%;
            }

            #showcase h1 {
                font-size: 45px;
            }
        }

        @media (max-width: 992px) {
            .container {
                width: 95%;
            }

            #showcase h1 {
                font-size: 35px;
            }
        }

        @media (max-width: 768px) {
            #showcase {
                min-height: 300px;
            }

            #showcase h1 {
                margin-top: 80px;
                font-size: 30px;
            }

            .content {
                padding: 15px;
                margin: 10px;
                width: 95%;
            }
        }

        @media (max-width: 576px) {
            #showcase {
                min-height: 200px;
            }

            #showcase h1 {
                margin-top: 60px;
                font-size: 25px;
            }

            .content {
                padding: 10px;
                margin: 5px;
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            #showcase h1 {
                margin-top: 40px;
                font-size: 20px;
            }

            .content {
                padding: 8px;
                margin: 5px;
                width: 100%;
            }
        }



        /* espera */
        .container2 {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }

        #showcase2 {
            min-height: 400px;
            background: url('anestesia.jpg') no-repeat center center/cover;
            text-align: center;
            color: #fff;
        }

        #showcase2 h1 {
            margin-top: 100px;
            font-size: 55px;
            margin-bottom: 10px;
            word-wrap: break-word;
        }

        .content2 {
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

        .area-content2 {
            display: none;
        }

        .wait-time-box2 {
            display: inline-block;
            width: 45%;
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
            border-radius: 5px;
            background-color: #f9f9f9;
            text-align: center;
        }

        .wait-time2 {
            font-size: 24px;
            font-weight: bold;
            color: #d9534f;
        }

        .wait-label2 {
            font-size: 16px;
        }

        /* Media Queries for Responsive Design */
        @media2 (max-width: 1200px) {
            .container2 {
                width: 90%;
            }

            #showcase2 h1 {
                font-size: 45px;
            }
        }

        @media2 (max-width: 992px) {
            .container2 {
                width: 95%;
            }

            #showcase2 h1 {
                font-size: 35px;
            }
        }

        @media2 (max-width: 768px) {
            #showcase2 {
                min-height: 300px;
            }

            #showcase2 h1 {
                margin-top: 80px;
                font-size: 30px;
            }

            .content2 {
                padding: 15px;
                margin: 10px;
                width: 95%;
            }

            .wait-time-box2 {
                width: 45%;
                margin: 10px 2.5%;
            }
        }

        @media2 (max-width: 576px) {
            #showcase2 {
                min-height: 200px;
            }

            #showcase2 h1 {
                margin-top: 60px;
                font-size: 25px;
            }

            .content2 {
                padding: 10px;
                margin: 5px;
                width: 100%;
            }

            .wait-time-box2 {
                width: 100%;
                margin: 10px 0;
            }
        }

        @media2 (max-width: 480px) {
            #showcase2 h1 {
                margin-top: 40px;
                font-size: 20px;
            }

            .content2 {
                padding: 8px;
                margin: 5px;
                width: 100%;
            }
    </style>

</head>

<body>

    

    <div class="container">
        <div id="Anestesiologia" class="content area-content">
            <section id="showcase">
                <div class="container">
                    <h1>Area de <?php echo htmlspecialchars($nombre_area); ?></h1>

                </div>
            </section>
            <p>
                ¡Bienvenidos al área de Anestesiología del Hospital Centro de salud!
                Nuestra misión es proporcionar cuidados anestésicos de alta calidad y garantizar la seguridad y
                comodidad de nuestros pacientes durante procedimientos quirúrgicos, diagnósticos y terapéuticos.
            </p>

            <h2>Nuestro Equipo</h2>
            <p>
                Contamos con un equipo de anestesiólogos altamente capacitados y experimentados, comprometidos con la
                excelencia en el cuidado del paciente. Nuestro personal está especializado en diversas subespecialidades
                de la anestesiología, incluyendo:
            </p>
            <ul>
                <li>Anestesia general</li>
                <li>Anestesia regional</li>
                <li>Anestesia para procedimientos ambulatorios</li>
                <li>Manejo del dolor</li>
                <li>Anestesia pediátrica</li>
                <li>Anestesia obstétrica</li>
            </ul>

            <h2>Servicios Ofrecidos</h2>
            <p>En el área de Anestesiología, ofrecemos una amplia gama de servicios para atender las necesidades
                específicas de cada paciente:</p>
            <ul>
                <li>
                    <strong>Evaluación Preanestésica:</strong> Una consulta detallada antes de su procedimiento para
                    evaluar su estado de salud y planificar el tipo de anestesia más adecuado.
                </li>
                <li>
                    <strong>Anestesia Intraoperatoria:</strong> Proporcionamos diferentes tipos de anestesia, adaptadas
                    a las necesidades específicas de cada intervención quirúrgica.
                </li>
                <li>
                    <strong>Manejo del Dolor:</strong> Estrategias efectivas para el control del dolor postoperatorio,
                    asegurando una recuperación cómoda y segura.
                </li>
                <li>
                    <strong>Anestesia Ambulatoria:</strong> Servicios de anestesia para procedimientos que no requieren
                    hospitalización prolongada.
                </li>
                <li>
                    <strong>Sedación para Procedimientos Diagnósticos:</strong> Sedación segura y efectiva para
                    procedimientos como endoscopias, colonoscopias y resonancias magnéticas.
                </li>
            </ul>

            <h2>Tecnologías Avanzadas</h2>
            <p>
                Utilizamos tecnologías de última generación para proporcionar el mejor cuidado posible, incluyendo:
            </p>
            <ul>
                <li>Monitoreo avanzado durante la cirugía para asegurar la estabilidad y seguridad del paciente.</li>
                <li>Técnicas de anestesia regional guiadas por ultrasonido para mayor precisión y efectividad.</li>
                <li>Protocolos de manejo del dolor multimodal para minimizar el uso de opioides y mejorar la
                    recuperación.</li>
            </ul>

            <h2>Preguntas Frecuentes</h2>
            <p><strong>¿Qué es la evaluación preanestésica?</strong></p>
            <p>
                Es una consulta con un anestesiólogo antes de su procedimiento para revisar su historial médico,
                realizar un examen físico y planificar su cuidado anestésico.
            </p>
            <p><strong>¿Cómo se controla el dolor después de la cirugía?</strong></p>
            <p>
                Utilizamos una combinación de medicamentos y técnicas de manejo del dolor adaptadas a las necesidades
                individuales de cada paciente para asegurar una recuperación cómoda.
            </p>
            <p><strong>¿Es seguro recibir anestesia?</strong></p>
            <p>
                La anestesia moderna es muy segura. Nuestro equipo de anestesiólogos está altamente capacitado y utiliza
                las tecnologías más avanzadas para garantizar su seguridad.
            </p>

            <h2>Contacto</h2>
            <p>Si tiene alguna pregunta o necesita más información sobre nuestros servicios de anestesiología, no dude
                en contactarnos:</p>
            <ul>
                <li>Teléfono: 4455896565</li>
                <li>Correo Electrónico: jefaso@gmail.com</li>
                <li>Dirección: Direccion falsa123</li>
            </ul>

            <h2>Testimonios</h2>
            <p>"Tuve una cirugía reciente y el equipo de anestesiología fue increíble. Me explicaron todo con detalle y
                se aseguraron de que estuviera cómodo y seguro en todo momento." - Doña Teresa</p>

        </div>
        <div id="Cuidados intensivos" class="content area-content">
            <section id="showcase">
                <div class="container">
                    <h1>Area de <?php echo htmlspecialchars($nombre_area); ?></h1>

                </div>
            </section>
            <p>
                ¡Bienvenidos al área de Cuidados Intensivos del Hospital Centro de salud!
                Nuestro equipo altamente capacitado se dedica a proporcionar cuidados especializados a pacientes que
                requieren monitoreo intensivo y atención médica continua.
            </p>

            <h2>Nuestro Equipo</h2>
            <p>
                Contamos con un equipo multidisciplinario compuesto por médicos intensivistas, enfermeras especializadas
                y personal de apoyo, todos comprometidos con la recuperación de nuestros pacientes.
            </p>
            <ul>
                <li>Cuidados intensivos para pacientes críticos</li>
                <li>Monitoreo avanzado las 24 horas del día</li>
                <li>Manejo especializado de ventilación mecánica</li>
                <li>Tratamientos personalizados según la condición del paciente</li>
            </ul>

            <h2>Servicios Ofrecidos</h2>
            <p>
                En el área de Cuidados Intensivos, nos dedicamos a proporcionar atención médica avanzada y continua a
                nuestros pacientes:
            </p>
            <ul>
                <li>
                    <strong>Monitoreo Constante:</strong> Vigilancia continua de signos vitales y funciones orgánicas.
                </li>
                <li>
                    <strong>Tratamientos Especializados:</strong> Protocolos médicos adaptados a cada caso para
                    optimizar la recuperación.
                </li>
                <li>
                    <strong>Manejo Avanzado de Equipos:</strong> Utilización de tecnología de punta para soporte vital y
                    monitoreo preciso.
                </li>
            </ul>

            <h2>Tecnologías Avanzadas</h2>
            <p>
                Implementamos tecnología de última generación para asegurar la mejor atención posible:
            </p>
            <ul>
                <li>Sistemas de monitoreo hemodinámico avanzado</li>
                <li>Equipos de soporte vital completo</li>
                <li>Software especializado en la gestión de datos clínicos</li>
            </ul>

            <h2>Preguntas Frecuentes</h2>
            <p><strong>¿Qué es el cuidado intensivo?</strong></p>
            <p>
                Es una unidad especializada donde se proporciona atención médica continua y avanzada a pacientes
                críticamente enfermos.
            </p>
            <p><strong>¿Cómo se maneja la ventilación mecánica?</strong></p>
            <p>
                Nuestro equipo especializado maneja cuidadosamente la ventilación mecánica según las necesidades de cada
                paciente para asegurar una oxigenación adecuada.
            </p>
            <p><strong>¿Cuál es la diferencia entre cuidados intensivos y cuidados generales?</strong></p>
            <p>
                Los cuidados intensivos están diseñados para pacientes que requieren monitoreo constante y tratamientos
                especializados debido a su condición crítica, mientras que los cuidados generales atienden a pacientes
                con condiciones menos graves.
            </p>

            <h2>Contacto</h2>
            <p>
                Si necesita más información sobre nuestros servicios de Cuidados Intensivos, no dude en contactarnos:
            </p>
            <ul>
                <li>Teléfono: 4454212356</li>
                <li>Correo Electrónico: 123456hot@gmail.com</li>
                <li>Dirección: Direccion falsa123</li>
            </ul>

            <h2>Testimonios</h2>
            <p>
                "El equipo de Cuidados Intensivos fue increíblemente atento y profesional durante la recuperación de mi
                [familiar/paciente]. Nos sentimos muy seguros y bien cuidados." - Patricia
            </p>
        </div>
        <div id="Pediatria" class="content area-content">
            <section id="showcase">
                <div class="container">
                    <h1>Area de <?php echo htmlspecialchars($nombre_area); ?></h1>

                </div>
            </section>
            <p>
                ¡Bienvenidos al área de Pediatría del Hospital Centro de salud!
                Nos especializamos en el cuidado de la salud de niños y adolescentes, proporcionando atención médica
                integral y personalizada.
            </p>

            <h2>Nuestro Equipo</h2>
            <p>
                Contamos con un equipo de pediatras y enfermeras especializados en el cuidado infantil, comprometidos
                con el bienestar y desarrollo de cada niño.
            </p>
            <ul>
                <li>Consultas pediátricas generales</li>
                <li>Especialistas en diversas áreas pediátricas (neonatología, gastroenterología pediátrica, neurología
                    pediátrica, entre otros)</li>
                <li>Enfermería pediátrica con enfoque en cuidados infantiles</li>
                <li>Atención psicológica y emocional adaptada a niños y adolescentes</li>
            </ul>

            <h2>Servicios Ofrecidos</h2>
            <p>
                En el área de Pediatría, ofrecemos una amplia gama de servicios diseñados para el bienestar integral de
                los más pequeños:
            </p>
            <ul>
                <li>
                    <strong>Consultas Preventivas:</strong> Revisiones periódicas para monitorear el crecimiento y
                    desarrollo de los niños.
                </li>
                <li>
                    <strong>Tratamientos Especializados:</strong> Manejo de enfermedades infantiles comunes y raras, con
                    enfoque en la atención personalizada.
                </li>
                <li>
                    <strong>Consulta Pediátrica Online:</strong> Servicios de telemedicina para consultas pediátricas
                    sin necesidad de desplazarse al hospital.
                </li>
                <li>
                    <strong>Programas de Vacunación:</strong> Calendarios de vacunación actualizados según las
                    recomendaciones nacionales e internacionales.
                </li>
            </ul>

            <h2>Tecnologías Avanzadas</h2>
            <p>
                Implementamos tecnologías avanzadas para garantizar diagnósticos precisos y tratamientos efectivos:
            </p>
            <ul>
                <li>Equipos médicos pediátricos adaptados a las necesidades específicas de los niños.</li>
                <li>Sistemas de información clínica integrada para un manejo eficiente de datos de pacientes
                    pediátricos.</li>
                <li>Tecnología de imagenología infantil para estudios diagnósticos no invasivos y seguros.</li>
            </ul>

            <h2>Preguntas Frecuentes</h2>
            <p><strong>¿Cuándo debo llevar a mi hijo al pediatra?</strong></p>
            <p>
                Es recomendable llevar a su hijo al pediatra regularmente para chequeos de rutina y vacunaciones.
                Además, debe consultar al pediatra si nota síntomas preocupantes como fiebre persistente, cambios en el
                comportamiento o problemas de salud.
            </p>
            <p><strong>¿Qué debo hacer si mi hijo tiene una enfermedad contagiosa?</strong></p>
            <p>
                Si su hijo tiene una enfermedad contagiosa, siga las recomendaciones del pediatra para el tratamiento y
                medidas preventivas. Asegúrese de mantenerlo aislado según sea necesario para evitar la propagación a
                otros niños.
            </p>
            <p><strong>¿Cómo puedo preparar a mi hijo para una consulta pediátrica?</strong></p>
            <p>
                Explique a su hijo de manera comprensible y tranquilizadora qué esperar durante la consulta. Lleve
                consigo cualquier registro médico relevante y asegúrese de hacer preguntas al pediatra si tiene alguna
                preocupación.
            </p>

            <h2>Contacto</h2>
            <p>
                Si desea más información sobre nuestros servicios de Pediatría, no dude en ponerse en contacto con
                nosotros:
            </p>
            <ul>
                <li>Teléfono: 4457894512</li>
                <li>Correo Electrónico: yapasemeprofe@mail.com</li>
                <li>Dirección: Direccion falsa123</li>
            </ul>

            <h2>Testimonios</h2>
            <p>
                "El equipo de Pediatría del Hospital Centro de salud ha sido increíble con nuestros hijos. Siempre nos
                sentimos bien atendidos y sabemos que están en buenas manos." - Juan
            </p>
        </div>
        <div id="Medicina Interna" class="content area-content">
            <section id="showcase">
                <div class="container">
                    <h1>Area de <?php echo htmlspecialchars($nombre_area); ?></h1>

                </div>
            </section>
            <p>
                ¡Bienvenidos al área de Medicina Interna del Hospital Centro de salud!
                Nos especializamos en el diagnóstico, tratamiento y manejo de enfermedades complejas en adultos,
                ofreciendo atención médica integral y personalizada.
            </p>

            <h2>Nuestro Equipo</h2>
            <p>
                Contamos con un equipo de médicos internistas altamente capacitados y especializados en diversas áreas
                de la medicina interna, comprometidos con el bienestar y salud de nuestros pacientes.
            </p>
            <ul>
                <li>Internistas generales y especialistas en subespecialidades médicas.</li>
                <li>Enfermeras especializadas en cuidados intensivos y manejo de enfermedades crónicas.</li>
                <li>Profesionales de apoyo médico para garantizar un tratamiento integral.</li>
            </ul>

            <h2>Servicios Ofrecidos</h2>
            <p>
                En el área de Medicina Interna, ofrecemos una amplia gama de servicios diseñados para el manejo efectivo
                de enfermedades complejas:
            </p>
            <ul>
                <li>
                    <strong>Diagnóstico y Tratamiento:</strong> Evaluación exhaustiva y tratamiento personalizado para
                    enfermedades como diabetes, hipertensión, enfermedades cardíacas, entre otras.
                </li>
                <li>
                    <strong>Manejo de Enfermedades Crónicas:</strong> Programas de manejo integral para pacientes con
                    condiciones médicas crónicas, promoviendo la salud a largo plazo.
                </li>
                <li>
                    <strong>Consulta Médica Especializada:</strong> Consultas periódicas con internistas especializados
                    para el seguimiento de condiciones complejas.
                </li>
                <li>
                    <strong>Emergencias Médicas:</strong> Atención inmediata y manejo de emergencias médicas que
                    requieren hospitalización y cuidados intensivos.
                </li>
            </ul>

            <h2>Tecnologías Avanzadas</h2>
            <p>
                Implementamos tecnologías médicas avanzadas para diagnósticos precisos y tratamiento efectivo de
                enfermedades internas:
            </p>
            <ul>
                <li>Equipos de diagnóstico por imagen de última generación para estudios diagnósticos no invasivos.</li>
                <li>Sistemas de información clínica integrada para un manejo eficiente de datos médicos.</li>
                <li>Tecnología de telemedicina para consultas médicas a distancia y seguimiento de pacientes.</li>
            </ul>

            <h2>Preguntas Frecuentes</h2>
            <p><strong>¿Qué es un internista y cuándo debo consultar uno?</strong></p>
            <p>
                Un internista es un médico especializado en el manejo integral de enfermedades en adultos. Debe
                consultar a un internista si tiene condiciones médicas complejas que requieren diagnóstico y tratamiento
                especializado.
            </p>
            <p><strong>¿Cómo puedo prevenir enfermedades crónicas?</strong></p>
            <p>
                La prevención de enfermedades crónicas incluye llevar un estilo de vida saludable, mantener un peso
                adecuado, hacer ejercicio regularmente, evitar el tabaco y consumir una dieta balanceada.
            </p>
            <p><strong>¿Qué debo hacer si tengo una emergencia médica?</strong></p>
            <p>
                En caso de una emergencia médica, debe acudir de inmediato al hospital o llamar a los servicios de
                emergencia locales para recibir atención médica urgente.
            </p>

            <h2>Contacto</h2>
            <p>
                Para más información sobre nuestros servicios de Medicina Interna, no dude en contactarnos:
            </p>
            <ul>
                <li>Teléfono: 4454658978</li>
                <li>Correo Electrónico: andeleprofe-lepago@gmail.com</li>
                <li>Dirección: DIreccion falsa123</li>
            </ul>

            <h2>Testimonios</h2>
            <p>
                "El equipo de Medicina Interna del Hospital Centro de salud ha sido fundamental en mi tratamiento.
                Siempre me siento bien cuidado y confiado en su experiencia." - Matilda
            </p>
        </div>
        <div id="Cardiologia" class="content area-content">
            <section id="showcase">
                <div class="container">
                    <h1>Area de <?php echo htmlspecialchars($nombre_area); ?></h1>

                </div>
            </section>
            <p>
                ¡Bienvenidos al área de Cardiología del Hospital Centro de salud!
                Nos especializamos en el diagnóstico y tratamiento de enfermedades del corazón, ofreciendo atención
                médica avanzada y personalizada para nuestros pacientes.
            </p>

            <h2>Nuestro Equipo</h2>
            <p>
                Contamos con un equipo de cardiólogos altamente capacitados y especializados en diversas áreas de la
                cardiología, comprometidos con la salud cardiovascular de nuestros pacientes.
            </p>
            <ul>
                <li>Cardiólogos generales y especialistas en subespecialidades como arritmias, insuficiencia cardíaca y
                    cardiología intervencionista.</li>
                <li>Enfermeras especializadas en cuidados cardíacos y rehabilitación cardiovascular.</li>
                <li>Tecnólogos en cardiología para pruebas diagnósticas y monitoreo de pacientes.</li>
            </ul>

            <h2>Servicios Ofrecidos</h2>
            <p>
                En el área de Cardiología, ofrecemos una amplia gama de servicios diseñados para el diagnóstico preciso
                y el tratamiento efectivo de enfermedades cardíacas:
            </p>
            <ul>
                <li>
                    <strong>Consulta Cardiológica:</strong> Evaluación exhaustiva y consultas periódicas con cardiólogos
                    para el manejo de condiciones cardíacas crónicas y agudas.
                </li>
                <li>
                    <strong>Pruebas Diagnósticas:</strong> Realización de pruebas no invasivas como electrocardiogramas
                    (ECG), ecocardiogramas y pruebas de esfuerzo para diagnóstico y monitoreo cardíaco.
                </li>
                <li>
                    <strong>Intervenciones Cardíacas:</strong> Procedimientos cardíacos intervencionistas como
                    angioplastia coronaria y colocación de stents para restaurar el flujo sanguíneo al corazón.
                </li>
                <li>
                    <strong>Rehabilitación Cardíaca:</strong> Programas de rehabilitación cardiovascular para la
                    recuperación después de eventos cardíacos como infartos y cirugías cardíacas.
                </li>
            </ul>

            <h2>Tecnologías Avanzadas</h2>
            <p>
                Implementamos tecnologías avanzadas para el diagnóstico y tratamiento de enfermedades cardíacas:
            </p>
            <ul>
                <li>Equipos de imagen cardíaca de última generación para diagnósticos precisos.</li>
                <li>Tecnología de cateterismo cardíaco para intervenciones cardíacas mínimamente invasivas.</li>
                <li>Sistemas de monitoreo cardíaco avanzado para la gestión remota de pacientes con enfermedades
                    cardíacas.</li>
            </ul>

            <h2>Preguntas Frecuentes</h2>
            <p><strong>¿Qué es un electrocardiograma (ECG) y cuándo se realiza?</strong></p>
            <p>
                Un ECG es una prueba que registra la actividad eléctrica del corazón. Se realiza para diagnosticar
                condiciones cardíacas como arritmias, problemas de ritmo cardíaco y daño cardíaco.
            </p>
            <p><strong>¿Qué debo hacer si tengo síntomas de un ataque cardíaco?</strong></p>
            <p>
                Si experimenta síntomas como dolor en el pecho, dificultad para respirar o palpitaciones, debe buscar
                atención médica de emergencia de inmediato llamando al servicio de emergencias local.
            </p>
            <p><strong>¿Es seguro someterse a una angioplastia coronaria?</strong></p>
            <p>
                La angioplastia coronaria es un procedimiento seguro y efectivo para abrir arterias bloqueadas en el
                corazón. Nuestro equipo de cardiología intervencionista está altamente capacitado para realizar este
                procedimiento con seguridad.
            </p>

            <h2>Contacto</h2>
            <p>
                Para más información sobre nuestros servicios de Cardiología, no dude en contactarnos:
            </p>
            <ul>
                <li>Teléfono: 443562587</li>
                <li>Correo Electrónico: con70-meconformo@gmail.com</li>
                <li>Dirección: Direccion falsa123</li>
            </ul>

            <h2>Testimonios</h2>
            <p>
                "El equipo de Cardiología del Hospital Centro de salud me proporcionó un tratamiento excepcional. Estoy
                agradecido por su atención y profesionalismo." - Lucho
            </p>
        </div>
        <div id="Rehabilitacion" class="content area-content">
            <section id="showcase">
                <div class="container">
                    <h1>Area de <?php echo htmlspecialchars($nombre_area); ?></h1>

                </div>
            </section>
            <p>
                ¡Bienvenidos al área de Rehabilitación del Hospital Centro de salud!
                Nuestro objetivo es ayudar a nuestros pacientes a recuperar su funcionalidad física y mejorar su calidad
                de vida a través de programas de rehabilitación especializados y personalizados.
            </p>

            <h2>Nuestro Equipo</h2>
            <p>
                Contamos con un equipo multidisciplinario de profesionales de la salud dedicados a la rehabilitación,
                incluyendo:
            </p>
            <ul>
                <li>Fisioterapeutas especializados en diferentes técnicas de rehabilitación física.</li>
                <li>Terapeutas ocupacionales para ayudar a los pacientes a recuperar habilidades para la vida diaria.
                </li>
                <li>Logopedas para rehabilitación del habla y lenguaje en pacientes con condiciones neurológicas.</li>
                <li>Psicólogos clínicos que apoyan el bienestar emocional durante el proceso de rehabilitación.</li>
            </ul>

            <h2>Servicios Ofrecidos</h2>
            <p>
                En el área de Rehabilitación, proporcionamos una variedad de servicios diseñados para abordar las
                necesidades individuales de nuestros pacientes:
            </p>
            <ul>
                <li>
                    <strong>Rehabilitación Física:</strong> Programas de fisioterapia personalizados para recuperar la
                    movilidad y fuerza después de lesiones ortopédicas o cirugías.
                </li>
                <li>
                    <strong>Rehabilitación Neurológica:</strong> Terapias especializadas para pacientes con enfermedades
                    neurológicas como ACV, lesiones cerebrales y esclerosis múltiple.
                </li>
                <li>
                    <strong>Rehabilitación Cardíaca:</strong> Programas de ejercicio supervisado y educación para
                    pacientes que se están recuperando de eventos cardíacos.
                </li>
                <li>
                    <strong>Rehabilitación Respiratoria:</strong> Terapias para mejorar la función pulmonar en pacientes
                    con enfermedades respiratorias crónicas.
                </li>
            </ul>

            <h2>Tecnologías y Métodos Avanzados</h2>
            <p>
                Utilizamos tecnologías avanzadas y métodos probados en rehabilitación para mejorar los resultados de
                nuestros pacientes:
            </p>
            <ul>
                <li>Tecnologías de rehabilitación asistida por robot para mejorar la precisión y eficiencia de los
                    movimientos terapéuticos.</li>
                <li>Terapias de realidad virtual para rehabilitación neurológica y recuperación funcional.</li>
                <li>Evaluaciones biomecánicas y análisis de marcha para personalizar los programas de rehabilitación
                    física.</li>
            </ul>

            <h2>Preguntas Frecuentes</h2>
            <p><strong>¿Cuánto tiempo dura un programa de rehabilitación física?</strong></p>
            <p>
                La duración del programa varía según la condición del paciente y los objetivos de rehabilitación.
                Nuestros fisioterapeutas diseñan planes individuales basados en las necesidades específicas de cada
                paciente.
            </p>
            <p><strong>¿Qué beneficios ofrece la rehabilitación neurológica?</strong></p>
            <p>
                La rehabilitación neurológica puede mejorar la movilidad, la independencia funcional y la calidad de
                vida en pacientes con lesiones cerebrales o enfermedades neurológicas crónicas.
            </p>
            <p><strong>¿Es seguro realizar terapia de ejercicio después de una cirugía ortopédica?</strong></p>
            <p>
                Sí, nuestros programas de rehabilitación postoperatoria están diseñados para promover una recuperación
                segura y efectiva, minimizando el riesgo de complicaciones.
            </p>

            <h2>Contacto</h2>
            <p>
                Para más información sobre nuestros servicios de Rehabilitación, no dude en contactarnos:
            </p>
            <ul>
                <li>Teléfono: 443562587</li>
                <li>Correo Electrónico: con70-meconformo@gmail.com</li>
                <li>Dirección: Direccion falsa123</li>
            </ul>

            <h2>Testimonios</h2>
            <p>
                "Gracias al equipo de Rehabilitación del Hospital Centro de salud, he podido recuperar mi movilidad y
                volver a disfrutar de actividades que creía imposibles." - Leopoldo
            </p>
        </div>
        <div id="Laboratorista" class="content area-content">
            <section id="showcase">
                <div class="container">
                    <h1>Area de <?php echo htmlspecialchars($nombre_area); ?></h1>

                </div>
            </section>
            <p>
                ¡Bienvenidos al área de Laboratorista del Hospital Centro de salud!
                Nuestro laboratorio está dedicado a proporcionar resultados precisos y confiables para apoyar el
                diagnóstico médico y el tratamiento de nuestros pacientes.
            </p>

            <h2>Nuestro Equipo</h2>
            <p>
                Contamos con un equipo de laboratoristas altamente capacitados y especializados en diversas áreas de
                análisis clínico y diagnóstico, incluyendo:
            </p>
            <ul>
                <li>Química clínica.</li>
                <li>Hematología.</li>
                <li>Microbiología.</li>
                <li>Genética.</li>
                <li>Inmunología.</li>
                <li>Patología.</li>
            </ul>

            <h2>Servicios Ofrecidos</h2>
            <p>
                En el área de Laboratorista, proporcionamos una amplia gama de servicios para satisfacer las necesidades
                de diagnóstico de nuestros pacientes:
            </p>
            <ul>
                <li>
                    <strong>Análisis de Sangre:</strong> Exámenes para evaluar la salud general, incluyendo conteo
                    sanguíneo completo, niveles de glucosa, lípidos y más.
                </li>
                <li>
                    <strong>Análisis de Orina:</strong> Pruebas para detectar problemas de salud como infecciones del
                    tracto urinario o problemas renales.
                </li>
                <li>
                    <strong>Pruebas de Función Hepática y Renal:</strong> Evaluaciones para monitorear la salud de
                    órganos vitales como el hígado y los riñones.
                </li>
                <li>
                    <strong>Biopsias y Análisis de Tejidos:</strong> Evaluaciones patológicas para diagnosticar
                    enfermedades como el cáncer y otras condiciones.
                </li>
                <li>
                    <strong>Pruebas Especiales:</strong> Incluyen pruebas genéticas, pruebas de alergia, y más,
                    dependiendo de las necesidades clínicas del paciente.
                </li>
            </ul>

            <h2>Tecnologías Avanzadas</h2>
            <p>
                Utilizamos equipos de última generación y técnicas avanzadas para garantizar resultados precisos y
                rápidos:
            </p>
            <ul>
                <li>Analizadores automatizados para pruebas bioquímicas y hematológicas.</li>
                <li>Técnicas de biología molecular para análisis genéticos y diagnóstico de enfermedades hereditarias.
                </li>
                <li>Microscopía avanzada para análisis microscópicos detallados de muestras de tejido y fluidos
                    corporales.</li>
            </ul>

            <h2>Preguntas Frecuentes</h2>
            <p><strong>¿Cuánto tiempo tardan en estar listos los resultados de los análisis?</strong></p>
            <p>
                El tiempo varía según el tipo de prueba realizada. Los resultados de análisis sencillos como el conteo
                sanguíneo pueden estar disponibles en horas, mientras que pruebas más complejas pueden tardar varios
                días.
            </p>
            <p><strong>¿Qué debo hacer antes de realizar un análisis de sangre?</strong></p>
            <p>
                Generalmente se recomienda ayunar por varias horas antes de ciertos análisis de sangre. Tu médico te
                dará instrucciones específicas según el tipo de prueba que necesites.
            </p>
            <p><strong>¿Qué sucede si mis resultados muestran algo anormal?</strong></p>
            <p>
                Si tus resultados son anormales, tu médico te explicará qué significan y te guiará en las opciones de
                tratamiento o seguimiento necesarias.
            </p>

            <h2>Contacto</h2>
            <p>
                Para más información sobre nuestros servicios de Laboratorista, por favor contáctenos:
            </p>
            <ul>
                <li>Teléfono: 443562587</li>
                <li>Correo Electrónico: con70-meconformo@gmail.com</li>
                <li>Dirección: Direccion falsa123</li>
            </ul>

            <h2>Testimonios</h2>
            <p>
                "Estoy muy agradecido con el laboratorio del Hospital Centro de salud. Gracias a sus pruebas precisas,
                pude recibir el tratamiento adecuado a tiempo." - Leo
            </p>
        </div>
        <div id="General" class="content area-content">
            <section id="showcase">
                <div class="container">
                    <h1>Area de <?php echo htmlspecialchars($nombre_area); ?></h1>

                </div>
            </section>
            <p>
                ¡Bienvenidos al Centro de Salud! Nos dedicamos a proporcionar atención médica de alta calidad y a garantizar la seguridad y comodidad de nuestros pacientes.
            </p>

            <h2>Visión</h2>
            <p>
                Ser un centro de salud líder reconocido por su excelencia en la atención médica integral y su compromiso con el bienestar de la comunidad.
            </p>

            <h2>Propósito</h2>
            <p>
                Brindar servicios de salud accesibles y de calidad, mejorando la vida de nuestros pacientes a través de una atención centrada en la persona.
            </p>

            <h2>Misión</h2>
            <p>
                Proporcionar atención médica de alta calidad con un enfoque humanizado, utilizando tecnologías avanzadas y promoviendo un entorno de bienestar para nuestros pacientes, sus familias y nuestra comunidad.
            </p>

            <h2>Valores</h2>
            <ul>
                <li><strong>Compromiso:</strong> Estamos dedicados a la salud y el bienestar de nuestros pacientes.</li>
                <li><strong>Calidad:</strong> Ofrecemos servicios médicos de la más alta calidad.</li>
                <li><strong>Empatía:</strong> Escuchamos y entendemos las necesidades de nuestros pacientes.</li>
                <li><strong>Innovación:</strong> Utilizamos tecnologías avanzadas para mejorar la atención médica.</li>
                <li><strong>Integridad:</strong> Actuamos con ética y transparencia en todos nuestros servicios.</li>
                <li><strong>Trabajo en Equipo:</strong> Fomentamos la colaboración y el respeto entre nuestros profesionales de salud.</li>
            </ul>
        </div>

        <!-- Otras áreas aquí -->
        <div id="Anestesiologia" class="content area-content">
            <section id="showcase">
                <div class="container">
                    <h1>Area de <?php echo htmlspecialchars($nombre_area); ?></h1>

                </div>
            </section>
            <p>
                ¡Bienvenidos al área de Anestesiología del Centro de Salud!
                Nuestra misión es proporcionar cuidados anestésicos de alta calidad y garantizar la seguridad y comodidad de nuestros pacientes durante procedimientos quirúrgicos, diagnósticos y terapéuticos.
            </p>

            <h2>Nuestro Equipo</h2>
            <p>
                Contamos con un equipo de anestesiólogos altamente capacitados y experimentados, comprometidos con la excelencia en el cuidado del paciente. Nuestro personal está especializado en diversas subespecialidades de la anestesiología, incluyendo:
            </p>
            <ul>
                <li>Anestesia general</li>
                <li>Anestesia regional</li>
                <li>Anestesia para procedimientos ambulatorios</li>
                <li>Manejo del dolor</li>
                <li>Anestesia pediátrica</li>
                <li>Anestesia obstétrica</li>
            </ul>

            <h2>Servicios Ofrecidos</h2>
            <p>En el área de Anestesiología, ofrecemos una amplia gama de servicios para atender las necesidades específicas de cada paciente:</p>
            <ul>
                <li>
                    <strong>Evaluación Preanestésica:</strong> Una consulta detallada antes de su procedimiento para evaluar su estado de salud y planificar el tipo de anestesia más adecuado.
                </li>
                <li>
                    <strong>Anestesia Intraoperatoria:</strong> Proporcionamos diferentes tipos de anestesia, adaptadas a las necesidades específicas de cada intervención quirúrgica.
                </li>
                <li>
                    <strong>Manejo del Dolor:</strong> Estrategias efectivas para el control del dolor postoperatorio, asegurando una recuperación cómoda y segura.
                </li>
                <li>
                    <strong>Anestesia Ambulatoria:</strong> Servicios de anestesia para procedimientos que no requieren hospitalización prolongada.
                </li>
                <li>
                    <strong>Sedación para Procedimientos Diagnósticos:</strong> Sedación segura y efectiva para procedimientos como endoscopias, colonoscopias y resonancias magnéticas.
                </li>
            </ul>

            <h2>Tecnologías Avanzadas</h2>
            <p>
                Utilizamos tecnologías de última generación para proporcionar el mejor cuidado posible, incluyendo:
            </p>
            <ul>
                <li>Monitoreo avanzado durante la cirugía para asegurar la estabilidad y seguridad del paciente.</li>
                <li>Técnicas de anestesia regional guiadas por ultrasonido para mayor precisión y efectividad.</li>
                <li>Protocolos de manejo del dolor multimodal para minimizar el uso de opioides y mejorar la recuperación.</li>
            </ul>

            <h2>Preguntas Frecuentes</h2>
            <p><strong>¿Qué es la evaluación preanestésica?</strong></p>
            <p>
                Es una consulta con un anestesiólogo antes de su procedimiento para revisar su historial médico, realizar un examen físico y planificar su cuidado anestésico.
            </p>
            <p><strong>¿Cómo se controla el dolor después de la cirugía?</strong></p>
            <p>
                Utilizamos una combinación de medicamentos y técnicas de manejo del dolor adaptadas a las necesidades individuales de cada paciente para asegurar una recuperación cómoda.
            </p>
            <p><strong>¿Es seguro recibir anestesia?</strong></p>
            <p>
                La anestesia moderna es muy segura. Nuestro equipo de anestesiólogos está altamente capacitado y utiliza equipos de monitoreo avanzados para asegurar su seguridad en todo momento.
            </p>
        </div>


        
        <div id="Espera" class="content area-content">
            <section id="showcase">
                <div class="container">
                    <h1>Area de <?php echo htmlspecialchars($nombre_area); ?></h1>

                </div>
            </section>
            <div class="wait-time-box2">
                <div class="wait-time2">25 min</div>
                <div class="wait-label2">Tiempo de espera consulta general</div>
            </div>

            <div class="wait-time-box2">
                <div class="wait-time2">60 min</div>
                <div class="wait-label2">Tiempo de espera consulta especializada</div>
            </div>
        </div>



    </div>
</body>
<?php include 'assets/footer.html'; ?>
<div id="footer"></div>

</html>