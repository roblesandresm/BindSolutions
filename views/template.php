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
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- SweetAlert2 -->
    <script src="assets/js/sweetalert2.all.min.js"></script>
    <title><?php $title = isset($_SESSION["iniciarSesion"]) == "ok" ? $_GET["ruta"] : "iniciar sesion" ; echo $title; ?> | Dashboard </title>
  </head>
  <body>
    <?php 
        if (isset($_SESSION["iniciarSesion"]) && isset($_SESSION["iniciarSesion"]) == "ok") {
            
        include "modules/header.php";
    
    ?>

    <!-- MAIN -->
    <div class="container-fluid contenedor-principal">
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
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/js/responsive.bootstrap4.min.js"></script>
    <script src="assets/js/DataTables.responsive.min.js"></script>
    <script src="https://kit.fontawesome.com/c5430e362e.js" crossorigin="anonymous"></script>
    <script src="assets/js/app.js"></script>
    <script src="assets/js/usuarios.js"></script>
    <script src="assets/js/productos.js"></script>
</body>
</html>