<header class="container-fluid">
    <div class="row justify-content-center align-content-center">
        <div class="col-8  col-xs-auto barra">
            <div class="logo">
                <a href="inicio">
                    <img src="assets/img/LOGO_BIND.png" alt="Logo de bind solutions">
                </a>
            </div>
        </div>
        <div class="col-4 col-xs-auto text-right barra">
            <ul class="navbar-nav mr-auto">
                <li>
                    <a 
                        href="#" 
                        class="px-3 text-light perfil dropdown-toggle" 
                        id="navbar-Dropdown" 
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false" 
                        role="button"
                    >
                        <?php
                            if ($_SESSION['foto'] != "") {
                                echo '<img src="'.$_SESSION['foto'].'" class="user-image"';
                            } else {
                                echo '<img src="views/img/usuarios/default/anonymous.png" class="user-image"';
                            }
                        ?>
                        <span class="hidden-xs"><?php echo $_SESSION['nombre']; ?></span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbar-dropdown">
                        <a href="salir" class="dropdown-item menu-perfil cerrar">
                            <i class="fas fa-sign-out-alt m-1"></i>Cerrar sesion
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</header>