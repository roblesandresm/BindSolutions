<!-- CONTENIDO GESTION DE USUARIOS -->
<main class="main col-10">
    <div class="row">
        <div class="col">
            <h1>Administrar usuarios</h1>
        </div>
        <div class="col">
            <ul class="breadcrumb">
                <li style="margin-right: 10px;"><a href="inicio"><i class="fas fa-home"></i>Inicio</a></li>
                <li>Administrador usuarios</li>
            </ul>
        </div>
    </div>
    <div class="row action-buttons">
        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modalAgregarUsuario">Crear usuario</button>
    </div>
    <table class="table dt-responsive table-hover tablas-pos">
        <thead>
            <tr>
                <th scope="col" style="width: 10px;">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Username</th>
                <th scope="col">Perfil</th>
                <th scope="col">Estado</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $item = null;
            $valor = null;
            $usuarios = ControllerUsuarios::ctrMostrarUsuario($item, $valor);

            foreach ($usuarios as $key => $value) {
                    
            ?>
                <tr>
                    <th scope="row"><?php echo $value['id']; ?></th>
                    <td><?php echo $value['nombre']; ?></td>
                    <td><?php echo $value['username']; ?></td>
                    <td><?php echo $value['tipo']; ?></td>
                    <?php
                        if ($value['estado'] != 0) {
                            echo '<td><button class="btn btn-success btn-sm btnActivar" idUsuario='.$value["id"].' estadoUsuario="0">Activado</button></td>';
                        } else {
                            echo '<td><button class="btn btn-danger btn-sm btnActivar" idUsuario='.$value["id"].' estadoUsuario="1">Desactivado</button></td>';
                        }
                    ?>
                    <td>
                        <div class="btn-group">
                            <button class="btn btn-warning btn-sm btnEditarUsuario" idUsuario="<?php echo $value['id']; ?>" data-toggle="modal" data-target="#modalEditarUsuario"><i class="fas fa-pencil-alt"></i></button>
                            <button class="btn btn-danger btn-sm"><i class="fas fa-times"></i></button>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <!--=========================
    =   MODAL CREAR USUARIO 
    ==========================-->
    <div class="modal fade" id="modalAgregarUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" role="form" enctype="multipart/form-data">
                    <div class="modal-header" style="background: #3c8dbc; color: white;">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar usuario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!--Entrada para el nombre  -->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="nuevoNombre"><i class="fas fa-user"></i></label>
                                </div>
                                <input class="form-control input-lg" type="text" id="nuevoNombre" name="nuevoNombre" placeholder="Ingresar nombre" require>
                            </div>
                        </div>
                        <!-- Entreda para el username -->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="nuevoUsuario"><i class="fas fa-key"></i></label>
                                </div>
                                <input class="form-control input-lg" type="text" id="nuevoUsuario" name="nuevoUsuario" placeholder="Ingresar usuario" require>
                            </div>
                        </div>
                        <!-- Entreda para el password -->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="nuevoPassword"><i class="fas fa-lock"></i></label>
                                </div>
                                <input class="form-control input-lg" type="password" id="nuevoPassword" name="nuevoPassword" placeholder="Ingresar una contraseña" require>
                            </div>
                        </div>
                        <!-- Entreda para el tipo de usuario -->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="nuevoTipo"><i class="fas fa-users"></i></label>
                                </div>
                                <select name="nuevoTipo" class="form-control input-lg" id="nuevoTipo">
                                    <option value="">-- Seleccionar perfil --</option>
                                    <option value="administrador">administrador</option>
                                    <option value="socio">socio</option>
                                    <option value="vendedor">vendedor</option>
                                </select>
                            </div>
                        </div>
                        <!-- Entrada para foto de usuario -->
                        <div class="form-group">
                            <div class="panel">SUBIR FOTO</div>
                            <input type="file" name="nuevaFoto" class="nuevaFoto">
                            <p class="help-block">Peso maximo de la foto 2 mb</p>
                            <img src="views/img/usuarios/default/anonymous.png"  class="img-tumbneil previsualizar" alt="imagen usuario por defecto" width="100px">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Crear usuario</button>
                    </div>
                    <?php 
                        $crearUsuario = new ControllerUsuarios();
                        $crearUsuario->ctrCrearUsuario();
                    ?>
                </form>
            </div>
        </div>
    </div>

    <!--======================
    =   MODAL EDITAR USUARIO =
    =======================-->
    <div class="modal fade" id="modalEditarUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" role="form" enctype="multipart/form-data">
                    <div class="modal-header" style="background: #3c8dbc; color: white;">
                        <h5 class="modal-title" id="exampleModalLabel">Editar usuario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!--Entrada para el nombre  -->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="editarNombre"><i class="fas fa-user"></i></label>
                                </div>
                                <input class="form-control input-lg" type="text" id="editarNombre" name="editarNombre" value="" require>
                            </div>
                        </div>

                        <!-- Entreda para el username -->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="editarUsuario"><i class="fas fa-key"></i></label>
                                </div>
                                <input class="form-control input-lg" type="text" id="editarUsuario" name="editarUsuario" value="" readonly>
                            </div>
                        </div>

                        <!-- Entreda para el password -->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="editarPassword"><i class="fas fa-lock"></i></label>
                                </div>
                                <input class="form-control input-lg" type="password" id="editarPassword" name="editarPassword" placeholder="Escriba nueva contraseña" require>
                                <input type="hidden" name="passwordActual" id="passwordActual">
                            </div>
                        </div>

                        <!-- Entreda para el tipo de usuario -->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="editarTipo"><i class="fas fa-users"></i></label>
                                </div>
                                <select name="editarTipo" class="form-control input-lg">
                                    <option value="" id="editarPerfil"></option>
                                    <option value="administrador">administrador</option>
                                    <option value="socio">socio</option>
                                    <option value="vendedor">vendedor</option>
                                </select>
                            </div>
                        </div>

                        <!-- Entrada para foto de usuario -->
                        <div class="form-group">
                            <div class="panel">SUBIR FOTO</div>
                            <input type="file" name="editarFoto" class="nuevaFoto">
                            <p class="help-block">Peso maximo de la foto 2 mb</p>
                            <img src="views/img/usuarios/default/anonymous.png"  class="img-tumbneil previsualizar" alt="imagen usuario por defecto" width="100px">
                            <input type="hidden" name="fotoActual" id="fotoActual">
                        </div>
                    </div>

                    <!--MODAL FOOTER -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Modificar usuario</button>
                    </div>

                    <!-- INSTANCIA DE CONTROLADOR PARA EDITAR USUARIO  -->
                    <?php 
                        $crearUsuario = new ControllerUsuarios();
                        $crearUsuario->ctrEditarUsuario();
                    ?>
                </form>
            </div>
        </div>
    </div>
</main>