<?php
session_start();

if (!isset($_SESSION['userId'])) {
    header("Location: app/views/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Turnitos</title>
    <link rel="stylesheet" href="node_modules\bulma\css\versions\bulma-no-dark-mode.css">
    <link rel="shortcut icon" href="https://img.icons8.com/officel/100/football.png" type="image/x-icon">
</head>

<body>
    <div class="container">

    </div>
    <?php
    $view = isset($_GET['view']) ? $_GET['view'] : "reservations";

    if (is_file("app/views/$view.php")) {
        include "app/components/nav.php";

        include "app/views/$view.php";
    } else include "app/views/404.php";
    ?>


    <script src="public/js/index.js"></script>
</body>

</html>