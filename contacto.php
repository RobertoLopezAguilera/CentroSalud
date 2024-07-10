<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>

    <style>
        .principal {
            display: flex;
            justify-content: center;
            align-items: left;
            width: 100%;
            height: 100%;

            background-image: url("https://www.versatilis.com.br/wp-content/uploads/2023/05/sala-de-espera-da-clinica-scaled.jpg");
            background-repeat: no-repeat;
            background-size: cover;
        }

        .principal h1 {
            color: black;
            text-shadow: -1px -1px 0 rgb(255, 255, 255),
                1px -1px 0 rgb(255, 255, 255),
                -1px 1px 0 rgb(255, 255, 255),
                1px 1px 0 rgb(255, 255, 255);
        }

        .informacion {
            display: flex;
            justify-content: center;
            align-items: rigth;
            flex-direction: column;
        }
    </style>
</head>

<body>

    <?php include 'assets/header.php'; ?>
    <div id="header"></div>
    <div class="principal">
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24">
                <g fill="none" stroke="#4f46e5" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    color="#4f46e5">
                    <path
                        d="M18 18c1.245.424 2 .982 2 1.593C20 20.923 16.418 22 12 22s-8-1.078-8-2.407c0-.611.755-1.169 2-1.593m9-8.5a3 3 0 1 1-6 0a3 3 0 0 1 6 0" />
                    <path
                        d="M12 2c4.059 0 7.5 3.428 7.5 7.587c0 4.225-3.497 7.19-6.727 9.206a1.55 1.55 0 0 1-1.546 0C8.003 16.757 4.5 13.827 4.5 9.587C4.5 5.428 7.941 2 12 2" />
                </g>
            </svg>
            Calle. Aguascalientes #797, Moroleón, Gto. C.P 38870
            </a>
            <h2>Urgencias 4451 00 13 82</h2>
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 48 48">
                <g fill="none">
                    <path d="M0 0h48v48H0z" />
                    <path fill="#4f46e5" fill-rule="evenodd"
                        d="M34 4c-5.523 0-10 4.477-10 10v9a1 1 0 0 0 1 1h9c5.523 0 10-4.477 10-10S39.523 4 34 4m-8 10a8 8 0 1 1 8 8h-8zM7 11.778c0-.426.352-.778.778-.778H14c.425 0 .778.352.778.778c0 2.326.372 4.562 1.06 6.652a.78.78 0 0 1-.198.8l-4.425 4.425l.33.647c2.656 5.222 6.934 9.48 12.15 12.152l.648.332l4.426-4.426a.77.77 0 0 1 .782-.187l.01.003a21.3 21.3 0 0 0 6.661 1.064c.426 0 .778.352.778.778v6.204a.783.783 0 0 1-.778.778C20.082 41 7 27.919 7 11.778M7.778 9A2.783 2.783 0 0 0 5 11.778C5 29.023 18.977 43 36.222 43A2.783 2.783 0 0 0 39 40.222v-6.204a2.783 2.783 0 0 0-2.778-2.778a19.3 19.3 0 0 1-6.028-.961a2.77 2.77 0 0 0-2.839.667l-3.389 3.389a25.94 25.94 0 0 1-10.302-10.3l3.39-3.39a2.78 2.78 0 0 0 .691-2.82l-.002-.007l-.002-.007a19.2 19.2 0 0 1-.963-6.033A2.783 2.783 0 0 0 14 9zM29 13h4V9h2v4h4v2h-4v4h-2v-4h-4z"
                        clip-rule="evenodd" />
                </g>
            </svg>
        </div>

        <div class="informacion">
            <h2>
                ¿Te gustaría información acerca de alguno<br> de nuestros tratamientos o especialidades?<br>
                Déjanos tus datos y nos<br> contactaremos contigo a la brevedad.
            </h2>
            <h3>
                Contamos con servicio de urgencias, tomografías y laboratorio 24 hrs.
            </h3>
        </div>
    </div>


    <?php include 'assets/footer.html'; ?>
    <div id="footer"></div>
</body>

</html>