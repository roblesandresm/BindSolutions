<?php 
    session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS CDN -->
    <!--
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    -->
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title><?php $title = isset($_GET["ruta"]) ? $_GET["ruta"] : "Inicio" ; echo $title; ?> | Dashboard </title>
  </head>
  <body>
    <?php 
        if (isset($_SESSION["iniciarSesion"]) && isset($_SESSION["iniciarSesion"]) == "ok") {
            
        include "modules/header.php";
    
    ?>

    <!-- MAIN -->
    <div class="container-fluid">
        <div class="row">
            <?php

                /**
                 * SIDEBAR
                 */
                include "modules/sidebar.php";

                /**
                 * CONTENT
                */
                if (isset($_GET["ruta"])) {
                    if ($_GET["ruta"] == "inicio" ||
                        $_GET["ruta"] == "usuarios" ||
                        $_GET["ruta"] == "productos" ||
                        $_GET["ruta"] == "eventos" ||
                        $_GET["ruta"] == "puntos-venta" ||
                        $_GET["ruta"] == "inventarios" ||
                        $_GET["ruta"] == "ventas" ||
                        $_GET["ruta"] == "salir"
                    ) {
                        include "modules/".$_GET["ruta"].".php";
                    } else {
                        include "modules/404.php";
                    }
                } else {
                    include "modules/inicio.php";
                }
            ?>
        </div>
    </div>
    <?php } else {
        include "modules/login.php";
    }
    
    ?>


    <!-- Sources hosting -->
    <script src="assets/js/jquery-3.6.0.slim.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/c5430e362e.js" crossorigin="anonymous"></script>
    
    <!-- CDN: jQuery and Bootstrap Bundle (includes Popper) -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    -->
  </body>
</html>