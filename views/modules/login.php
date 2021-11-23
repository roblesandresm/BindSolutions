<div id="login">
    <h3 class="text-center text-white pt-5">BindSolutions</h3>
    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div id="login-box" class="col-md-12">
                    <form id="login-form" class="form" action="" method="post">
                        <h3 class="text-center text-info">Inicio de sesion</h3>
                        <div class="form-group">
                            <label for="username" class="text-info">Username:</label><br>
                            <input type="text" name="ingUsuario" id="username" class="form-control" placeholder="Nombre de usuario" require>
                        </div>
                        <div class="form-group">
                            <label for="password" class="text-info">Password:</label><br>
                            <input type="password" name="ingPassword" id="password" class="form-control" placeholder="Contraseña" require>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" class="btn btn-info btn-md" value="Iniciar sesion">
                        </div>

                        <?php
                            $login = new ControllerUsuarios();
                            $login->ctrIngresoUsuario();
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>