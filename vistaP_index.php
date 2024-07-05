<?php
session_start();

if (!isset($_SESSION['userName'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'assets/header.php'; ?>
    <div id="header"></div>
    <a href="vista_Personal/pacientes_Personal.php">Mis pacientes</a>
    <?php include 'assets/footer.html'; ?>
    <div id="footer"></div>
</body>
</html>